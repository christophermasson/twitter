<?php

class Message{
    private $pdo;

    public function __construct(){
        $this->pdo=Database::instance();
    }

    public function recentMessages($user_id){
        $stmt=$this->pdo->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageFrom`=`user_id` AND `messageID` IN (SELECT max(`messageID`) FROM `messages` WHERE `messageFrom`=`user_id`) WHERE `messageTo`=:user_id AND `messageFrom`=`user_id` GROUP BY `user_id` ORDER BY `messageID` DESC");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function messageData($otherid,$userid){
        $stmt = $this->pdo->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageFrom` = `user_id` WHERE (`messageFrom` =:messageFrom AND `messageTo` =:user_id) OR (`messageTo` =:messageFrom AND `messageFrom` =:user_id) ORDER BY `messageOn` ASC");
        $stmt->bindParam(":messageFrom", $otherid, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function notificationCount($userid){
        $stmt = $this->pdo->prepare("SELECT * FROM notification LEFT JOIN users ON notification.notificationFrom=users.user_id WHERE notification.notificationFor=:userid AND notification.notificationCount='0' AND notificationFrom !=:userid ORDER BY `notification`.notificationOn DESC");
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}
?>