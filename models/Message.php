<?php
namespace models;

use Db;
use PDO;
use User;

class Message
{
    const SHOW_BY_DEFAULT = 6;

    const SHOW_BY_DEFAULT_FOR_USER = 2;

    public static function getMessageItemById($id)
    {
        $id = intval($id);
        if ($id) {
            
            $db = Db::getConnection();
            $result = $db->query('SELECT * FROM message WHERE id=' . $id);
            
            $messageItem = $result->fetch();
            
            return $messageItem;
        }
    }

    public static function editMessage($id)
    {
        $text = false;
        $email = false;
        $name = false;
        $picturePath = false;
        
        $text = htmlspecialchars($_POST["text"]);
        $email = htmlspecialchars($_POST["email"]);
        $name = htmlspecialchars($_POST["name"]);
        $picturePath = htmlspecialchars($_POST["picturePath"]);
        $db = Db::getConnection();
        
        $result = $db->prepare("UPDATE message SET text = :text, email = :email, name = :name, picture_path = :picture_path WHERE id = :id");
        
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':picture_path', $picturePath, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        
        $result->execute();
        
        $db = null;
        
        return true;
    }

    public static function getMessageList($page = 1)
    {
        $page = intval($page);
        
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
        $db = Db::getConnection();
        $sql = 'SELECT id, text, title, date  FROM message limit ' . self::SHOW_BY_DEFAULT . ' OFFSET ' . $offset;
        $result = $db->prepare($sql);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $messageList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $messageList[$i]['id'] = $row['id'];
            $messageList[$i]['text'] = $row['text'];
            $messageList[$i]['title'] = $row['title'];
            $messageList[$i]['date'] = $row['date'];
            $i ++;
        }
        $db = null;
        return $messageList;
    }

    public static function getMessageListForUser($page = 1, $userId)
    {
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
        $db = Db::getConnection();
        
        $sql = 'SELECT id, user_id, text, title,date  FROM message ' . ' WHERE user_id = ' . $userId . ' limit ' . self::SHOW_BY_DEFAULT . ' OFFSET ' . $offset;
         
        $result = $db->prepare($sql);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $messageList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $messageList[$i]['id'] = $row['id'];
            $messageList[$i]['text'] = $row['text'];
            $messageList[$i]['title'] = $row['title'];
            $messageList[$i]['date'] = $row['date'];
            $i ++;
        }
        
        $db = null;
        return $messageList;
    }

    public static function createMessage()
    {
        $text = htmlspecialchars($_POST["text"]);
        $date = date("Y-m-d H:i:s");
        $title = htmlspecialchars($_POST["title"]);
        
        $db = Db::getConnection();
        
        $sql = "INSERT INTO message (text, date, title, user_id ) VALUES (:text, :date, :title,:user_id)";
        $userId = User::checkLogged(); 
        // $statement = $db->prepare("INSERT INTO message (text, email, name )
        // VALUES (':text',':email', ':name')");
        $result = $db->prepare($sql);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        
        
        
        $result->execute();
        $id = $db->lastInsertId();
        $db = null; 
        return $id;
    }

    public static function deleteMessage($id)
    {
        $db = Db::getConnection();
        
        $sql = "DELETE FROM message WHERE id=:id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        
        $db = null;
        
        return true;
    }

    public static function getTotalMessages()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT count(id) AS count FROM message');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }

    public static function getTotalMessagesForUser($userId)
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT count(id) AS count FROM message WHERE user_id = ' . $userId);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }
}

