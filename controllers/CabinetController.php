<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
use models\Message;
include_once ROOT . '/models/Message.php';

class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionUpdate($messageId)
    {
        echo "actionUpdate";
        Message::editMessage($messageId);
        // Подключаем вид
        require_once (ROOT . '/views/cabinet/index.php');
    }

    public function actionIndex($page = 1)
    {
        
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        if (! $userId) {
            header("Location: /message");
        }
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        $messageList = array();
        $messageList = Message::getMessageListForUser($page, $userId);
        $total = Message::getTotalMessagesForUser($userId);
        $pagination = new Pagination($total, $page, Message::SHOW_BY_DEFAULT_FOR_USER, 'p-');
        // Подключаем вид
        require_once (ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function actionEdit()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        // Заполняем переменные для полей формы
        $password = $user['password'];
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $email = $user['email'];
        $homepage = $user['homepage'];
        
        // Флаг результата
        $result = false;
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $password = $_POST['password'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $homepage = $_POST['homepage'];
            // Флаг ошибок
            $errors = false;
            // Валидируем значения
            if (! User::checkName($firstname)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (! User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            /**
             * Тут нужно добавить обработку полей с именем, фамилия, email, homepage
             */
            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                
                $result = User::edit($userId, $password, $firstname, $lastname, $email, $homepage);
            }
        }
        // Подключаем вид
        require_once (ROOT . '/views/cabinet/edit.php');
        return true;
    }
}
