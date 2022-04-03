<?php

namespace AtlSoftware\Models\Entity;

use PDO;
use PDOException;

trait Repository
{
    public function get()
    {
        try
        {
            $fields = \implode(",", $this->fields);
            $sql = "SELECT $fields FROM $this->table LIMIT 1000";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute();
            $res = [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($res, $row);
            }
            return $res;

        }catch(PDOException $ex)
        {
            if(app_debug)
                print_r($ex->getMessage());
            return false;
        }

    }

    public function getById($id = 0)
    {
        try
        {            
            $fields = \implode(",", $this->fields);
            $sql = "SELECT $fields FROM $this->table WHERE id = ? LIMIT  0,1";
            $stmt= $this->connection->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;

        }catch(PDOException $ex)
        {
            if(app_debug)
                print_r($ex->getMessage());
            return false;
        }
    }


    public function post($body)
    {
        try{

            $className = __CLASS__;
            $item      = new $className();
            $item->id  = 0;
            $fields    = implode(",", $this->fields);
            $values    = implode(",:", $this->fields);
            $sql = "INSERT INTO $this->table ($fields,created_at) VALUES (:$values,:created_at);";
            $stmt= $this->connection->prepare($sql);
            
            $stmt->bindParam(":id", $item->id);
            //sanitize and bind data
            foreach($this->fields as $field)
            {
                if(isset($body->$field))
                {
                    $item->$field = htmlspecialchars(strip_tags($body->$field));
                    $stmt->bindParam(":".$field, $item->$field);
                }
            }

            $datetime = date('Y-m-d H:i:s');
            $stmt->bindParam(":created_at", $datetime);
            if($stmt->execute())
                return $this->connection->lastInsertId();
            
            return false;

        }catch(PDOException $ex)
        {
            if(app_debug)
                print_r($ex->getMessage());
            
            return false;
        }
    }


    public function put($id = 0, $body)
    {
        try
        {

            $className = __CLASS__;
            $item      = new $className();
            $item->id  = $id;
            $sql = "UPDATE $this->table SET updated_at = :updated_at,";

            foreach($this->fields as $field)
            {
                if(isset($body->$field))
                {
                    $sql .= "$field = :".$field.",";
                    $item->$field = htmlspecialchars(strip_tags($body->$field));
                }
            }

            $sql = substr_replace($sql, "", -1);
            $sql .= " WHERE id = :id";
            $stmt= $this->connection->prepare($sql);

            foreach($this->fields as $field)
            {
                if(isset($body->$field))
                {
                    $stmt->bindParam(":".$field, $item->$field);
                }
            }

            $stmt->bindParam(":id", $item->id);
            $datetime = date('Y-m-d H:i:s');
            $stmt->bindParam(":updated_at", $datetime);

            if($stmt->execute())
                return true;
            
            return false;

        }catch(PDOException $ex)
        {
            if(app_debug)
                print_r($ex->getMessage());
            return false;
        }
    }

    public function delete($id = 0)
    {
        try
        {
            $sql = "DELETE FROM $this->table WHERE id = ?";
            $stmt= $this->connection->prepare($sql);
            $id  = htmlspecialchars(strip_tags($id));
            $stmt->bindParam(1, $id);

            if($stmt->execute())
                return true;
        
            return false;

        }catch(PDOException $ex)
        {
            if(app_debug)
                print_r($ex->getMessage());
            return false;
        }

    }

}