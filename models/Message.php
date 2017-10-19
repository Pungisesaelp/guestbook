<?php
namespace models;

use Db;
use PDO;

class Message
{

    const SHOW_BY_DEFAULT = 25;

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

    public static function getMessageList($page = 1)
    {
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
        $db = Db::getConnection();
        $messageList = array();
        $result = $db->query('SELECT id, text, email, name, picture_path FROM message limit ' . self::SHOW_BY_DEFAULT . ' OFFSET ' . $offset);
        $i = 0;
        while ($row = $result->fetch()) {
            $messageList[$i]['id'] = $row['id'];
            $messageList[$i]['text'] = $row['text'];
            $messageList[$i]['email'] = $row['email'];
            $messageList[$i]['name'] = $row['name'];
            $messageList[$i]['picture_path'] = $row['picture_path'];
            $i ++;
        }
        $db = null;
        return $messageList;
    }

    public static function createMessage()
    {
        $text = htmlspecialchars($_POST["text"]);
        $email = htmlspecialchars($_POST["email"]);
        $name = htmlspecialchars($_POST["name"]);
        
        $db = Db::getConnection();
        
        $statement = $db->prepare("INSERT INTO message (text, email, name )
        VALUES (':text',':email', ':name')");
        
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->execute();
        
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
}

