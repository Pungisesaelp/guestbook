<?php
namespace models;

use Db;
use PDO;

class Picture
{

    public static function createPicture($path, $messageId)
    {
        $db = Db::getConnection();
        
        $sql = "INSERT INTO picture (path,message_id) VALUES (:path, :message_id)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':path', $path, PDO::PARAM_STR);
        $result->bindParam(':message_id', $messageId, PDO::PARAM_INT);
        
        $result->execute();
        
        $db = null;
        
        return true;
    }

    public static function searсhFirstPicturePAthForMessageId($messageId)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT path FROM picture WHERE message_id = :message_id  ';
        
        $result = $db->prepare($sql);
        $result->bindParam(':message_id', $messageId, PDO::PARAM_INT);
        $result->execute();
        
        $pathPicture = $result->fetch()['path'];
        
        $db = null;
        
        return $pathPicture;
    }

    public static function searсhPicturesPAthForMessageId($messageId)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT path FROM picture WHERE message_id = :message_id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':message_id', $messageId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $result->execute();
        
        $picturePathList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $picturePathList[$i]['path'] = $row['path'];
            $i ++;
        }
        
        $db = null;
        
        return $picturePathList;
    }

    public static function getTotalPictureForMessage($messageId)
    {
        $db = Db::getConnection();
        $sql = 'SELECT count(id) AS count FROM picture WHERE message_id = :message_id';
        $result = $db->prepare($sql);
        $result->bindParam(':message_id', $messageId, PDO::PARAM_INT);
        $result->execute();
        
        $count = $result->fetch()['count'];
        $db = null;
        
        return $count;
    }
}

