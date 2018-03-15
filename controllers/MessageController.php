<?php
use models\Message;
use models\Picture;

include_once ROOT . '/models/Message.php';
include_once ROOT . '/models/Picture.php';
include_once ROOT . '/components/Pagination.php';

class MessageController
{

    public function actionAbout()
    {
        require_once (ROOT . '/views/message/about.php');
    }
    public function actionGallery($id)
    {
        $pictureList = Picture::searсhPicturesPAthForMessageId($id);
        require_once (ROOT . '/views/message/gallery.php');
    }

    public function genereteRandomWord()
    {
        $key = '';
        $array = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $c = count($array);
        for ($j = 0; $j < 10; $j ++) {
            $key .= $array[rand(0, $c)];
        }
        return $key;
    }

    public function loadPictures()
    {
        
    }
    
    
    // actionсreate
    public function actionCreate()
    {
        $title = null;
        $text = null; 
        print date("Y-m-d H:i:s");
        if (isset($_POST['submit'])) {
           $idMessage =  Message::createMessage(); 
            // /////////////////////Загрузка фотографий////////////////////////////////////////////////
            $nameMass = 'pictures'; 
            $allowed_filetypes = array(
                '.jpg',
                '.JPG',
                '.Jpg', 
                '.bmp',
                '.BMP',
                '.Bmp',
                '.png',
                '.PNG',
                '.Png'
            ); // допустимые форматы.
            $max_filesize = 524288; // Допустимый размер загружаемого файла.;
            $upload_path = 'files/'; // Директория для загрузки. 
      
            for ($i = 0; $i < sizeof($_FILES[$nameMass]['name']); $i ++) {  
                if ($_FILES[$nameMass]['name'][$i]==NULL){
                    break;
                }
                $filename = self::genereteRandomWord() . ".jpg"; 
                $ext = substr($filename, strpos($filename, '.'), strlen($filename) - 1);
                if (strlen($_FILES[$nameMass]['tmp_name'][$i]) < 1)
                    echo('Сперва укажите файл для загрузки.');
                if (! in_array($ext, $allowed_filetypes))
                    echo('Данный формат не поддерживается.');
                if (filesize($_FILES[$nameMass]['tmp_name'][$i]) > $max_filesize)
                    echo('Файл превышает допустимые значения.');
                if (! is_writable($upload_path))
                    echo('Директория закрыта от записи. обратитесь к системному администратору.');
                if (move_uploaded_file($_FILES[$nameMass]['tmp_name'][$i], $upload_path . $filename))
                    echo ('Ваш фаил успешно загружен. <a href="' . $upload_path . $filename . '">');
                    else{
                    echo 'При загрузке возникли ошибки. Попробуйте ещё раз.';
                    } 
                    Picture::createPicture($upload_path . $filename, $idMessage);
            }
        }
        
        require_once (ROOT . '/views/message/create.php');
    }

    public function actionDelete($id)
    {
        session_start();
        $_SESSION['user'];
        $user = User::getUserById($_SESSION['user']);
        Message::deleteMessage($id);
        header("Location: /cabinet");
    }

    public function actionIndex($page = 1)
    {
        $date = null;
        $firstname = null;
        $lastname = null;
        $homepage = null;
        $email = null;
        $password = null;
        $userId = null;
        $this->pushButton();
        $messageList = array();
        $messageList = Message::getMessageList($page);
        $total = Message::getTotalMessages();
        $pagination = new Pagination($total, $page, Message::SHOW_BY_DEFAULT, 'p-');
        $userId = User::checkLogged(); 
        
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
        $secret = '6LcVYUkUAAAAAHc5Yv_2pMDuWxKqfEdeCm27wXvZ';
        $response = $_POST['g-recaptcha-response'];
        $remoteip = $_SERVER['REMOTE_ADDR'];
        
        $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
        $result = json_decode($url, TRUE);
        
        return $result;
    }
}

