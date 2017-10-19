<?php
use models\Message;

include_once ROOT . '/models/Message.php';
include_once ROOT . '/components/Pagination.php';

class MessageController
{

    public function actionIndex($page=1)
    {
        $this->pushButton();     
        $messageList = array();
        $messageList = Message::getMessageList($page);
        $total = Message::getTotalMessages();
        $pagination = new Pagination($total, $page, Message::SHOW_BY_DEFAULT, 'p-');

        require_once (ROOT . '/views/message/index.php');
        return true;
    }

    public function actionView($id)
    {
        if ($id) {
            $messageItem = Message::getMessageItemByID($id);
            foreach ($messageItem as $a => $b) {
                echo "<br>" . $a . " = " . $b;
            }
            
            /* echo 'actionView'; */
        }
        
        return true;
    }
  
    
    
    
    private function pushButton()
    {
        if (isset($_POST['button'])) {
            if ($this->getReCAPTCHA()['success'] == 1) {
                Message::createMessage();
            } else {
                echo 'Error, you don\'t push CAPTCHA';
            }
        }
    }
        
    
    private function getReCAPTCHA()
    {
        $secret = '6Lf2iDMUAAAAAKaBulOx1uBOQuaggKDnCxon_AQl';
        $response = $_POST['g-recaptcha-response'];
        $remoteip = $_SERVER['REMOTE_ADDR'];
        
        $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
        $result = json_decode($url, TRUE);
        
        return $result;
    }
}

