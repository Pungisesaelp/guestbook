<?php

/**
 * Контроллер UserController
 */
class UserController
{

    /**
     * Action для страницы "Регистрация"
     */
    public function actionRegister()
    {
        // Переменные для формы
        $login = false;
        $email = false;
        $password = false;
        $rpassword = false;
        $homepage = false;
        $firstname = false;
        $lastname = false;
        
        $result = false;
        // Обработка формы
        if (isset($_POST['signUp'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $rpassword = $_POST['rpassword'];
            $homepage = $_POST['homepage'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            // Флаг ошибок
            $errors = false;
            // Валидация полей
            if (! User::checkName($firstname)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (! User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (! User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            if (! User::checkConfirmPassword($password, $rpassword)) {
                $errors[] = 'Пароли не совпадают';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            
            if ($errors == false) {
                // Если ошибок нет
                // Регистрируем пользователя
                $result = User::register($login, $email, $password, $homepage, $firstname, $lastname);
            }
        }
        // Подключаем вид
        require_once (ROOT . '/views/user/register.php');
        return true;
    }

    /**
     * Action для страницы "Вход на сайт"
     */
    public function actionLogin()
    {
        // Переменные для формы
        $email = false;
        $password = false;
        
        // Обработка формы
        if (isset($_POST['logIn'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $email = $_POST['email'];
            $password = $_POST['password'];
            // Флаг ошибок
            $errors = false;
            // Валидация полей
            
            if (! User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);
            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);
                // Перенаправляем пользователя в закрытую часть - кабинет
                
                header("Location: /cabinet");
                
                // require_once(ROOT . '/cabinet');
            }
        }
        // Подключаем вид
        require_once (ROOT . '/views/user/login.php');
        return true;
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        // Стартуем сессию
        session_start();
        
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);
        
        // Перенаправляем пользователя на главную страницу
        header("Location: /message");
    }
}