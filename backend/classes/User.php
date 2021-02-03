<?php

class User{
    protected $pdo;


    public function __construct(){
        $this->pdo=Database::instance();
    }
    public function userData($user_id){
        return $this->get("users",["*"],array("user_id"=>$user_id));
        // $stmt=$this->pdo->prepare("SELECT * FROM users WHERE user_id=:userId");
        // $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
        // $stmt->execute();
        // // echo "<pre>";
        // // $stmt->debugDumpParams();
        // // echo "</pre>";
        //  $user=$stmt->fetch(PDO::FETCH_OBJ);
        //  if($stmt->rowCount() !=0){
        //      return $user;
        //  }else{
        //      return false;
        //  }
    }

    public function create($tableName,$fields=array()){
        $columns=implode(', ',array_keys($fields));
        $values=':'.implode(', :',array_keys($fields));
        // $columns=implode(', ',array_values($fields));
        $sql="INSERT INTO `{$tableName}` ({$columns}) VALUES ({$values})";
        if($stmt=$this->pdo->prepare($sql)){
            foreach($fields as $key =>$values){
                $stmt->bindValue(":".$key,$values);
            }
            $stmt->execute();
            return $this->pdo->lastInsertId();
        }
    }
           
    public function get($tableName,$columnName=array(),$fields=array()){
        $targetColumns=implode(', ',array_values($columnName));
        $columns="";
        $i=1;
        foreach($fields as $name => $value){
            $columns .= "{$name}=:{$name}";
            if($i <count($fields)){
                $columns .= " AND ";
            }
            $i++;
        }
        $sql="SELECT {$targetColumns} FROM `{$tableName}` WHERE {$columns} ";
        if($stmt=$this->pdo->prepare($sql)){
            foreach($fields as $key =>$values){
                $stmt->bindValue(":".$key,$values);
            }
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

    }
    

    public function delete($tableName,$fields=array()){
        $sql="DELETE FROM `{$tableName}`";
        $where= " WHERE ";
        foreach($fields as $name => $value){
            $sql .= "{$where} `{$name}` =:{$name}";
            $where = " AND ";
        }
        if($stmt=$this->pdo->prepare($sql)){
            foreach($fields as $name => $value){
                $stmt->bindValue(':'.$name,$value);
            }
            $stmt->execute();
        }
    }
  
    public function update($tableName,$user_id,$fields=array()){
        $columns="";
        $i=1;
        foreach($fields as $name => $value){
            $columns .= "{$name}=:{$name}";
            if($i <count($fields)){
                $columns .= " , ";
            }
            $i++;
        }
        $sql="UPDATE `{$tableName}` SET {$columns} WHERE user_id={$user_id} ";
        if($stmt=$this->pdo->prepare($sql)){
            foreach($fields as $key =>$values){
                $stmt->bindValue(":".$key,$values);
            }
            $stmt->execute();
        }

    }

    public function timeAgo($datetime){
        $time = strtotime($datetime);
        $current = time();
        $seconds = $current-$time;
        $minutes = round($seconds/60);
        $hours = round($seconds/3600);
        $months = round($seconds/2600640);

        if($seconds <= 60){
            if($seconds == 0){
                return 'Just now';

            }else{
                return ''.$seconds.'s';
            }

        }else if($minutes <= 60){
            return ''.$minutes.'m';
        }else if($hours <= 24){
            return ''.$hours.'h';
        }else if($months <= 24){
            return ''.date('M j', $time);
        }else{
            return ''.date('j M Y', $time);
        }
    }

  
}