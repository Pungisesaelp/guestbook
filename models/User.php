<?php

/**
 * Класс User - модель для работы с пользователями
 */
class User
{

    /**
     * Регистрация пользователя
     *
     * @param string $name
     *            <p>Имя</p>
     * @param string $email
     *            <p>E-mail</p>
     * @param string $password
     *            <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */

    public static function register($login, $email, $password, $homepage, $firstname, $lastname)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO user (login, email, password, homepage, firstname,lastname ) ' . 'VALUES (:login, :email, :password, :homepage, :firstname, :lastname)';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':homepage', $homepage, PDO::PARAM_STR);
        $result->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        
        return $result->execute();
    }

    /**
     * Редактирование данных пользователя
     *
     * @param integer $id
     *            <p>id пользователя</p>
     * @param string $login
     *            <p>Логин </p>
     * @param string $password
     *            <p>Пароль</p>
     * @param string $lastname
     *            <p>Фамилия </p>
     * @param string $firstname
     *            <p>Имя </p
     * @param string $email
     *            <p>Почта </p>
     * @param string $homepage
     *            <p>Домашняя страница </p>
     * @return boolean <p>Результат выполнения метода</p>
     */
 
    public static function edit($userId,   $password, $firstname, $lastname, $email, $homepage)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE user
            SET  password = :password, firstname = :firstname,
            lastname = :lastname, email = :email, homepage = :homepage
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT); 
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':homepage', $homepage, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     *
     * @param string $email
     *            <p>E-mail</p>
     * @param string $password
     *            <p>Пароль</p>
     * @return mixed : integer user id or false
     */
    public static function checkUserData($email, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();
        // Обращаемся к записи
        $user = $result->fetch();
        if ($user) {
            // Если запись существует, возвращаем id пользователя
            
            return $user['id'];
        }
        
        return false;
    }

    /**
     * Запоминаем пользователя
     *
     * @param integer $userId
     *            <p>id пользователя</p>
     */
    public static function auth($userId)
    
    {
        session_start();
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
        echo "Записываем в сессию = " . $_SESSION['user'] . '<br>';
    }

    /**
     * s
     * Возвращает идентификатор пользователя, если он авторизирован.<br/>
     * Иначе перенаправляет на страницу входа
     *
     * @return string <p>Идентификатор пользователя</p>
     */
    public static function checkLogged()
    {
        session_start();
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
            echo "Тут сессия: " . $_SESSION['user'];
        } else
            echo "тут не сессия";
        // header("Location: /user/login");
    }

    /**
     * Проверяет является ли пользователь гостем
     *
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Проверяет имя: не меньше, чем 2 символа
     *
     * @param string $name
     *            <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет телефон: не меньше, чем 10 символов
     *
     * @param string $phone
     *            <p>Телефон</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     *
     * @param string $password
     *            <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     *
     * @param string $email
     *            <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет не занят ли email другим пользователем
     *
     * @param type $email
     *            <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmailExists($email)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    }

    /**
     * Возвращает пользователя с указанным id
     *
     * @param integer $id
     *            <p>id пользователя</p>
     * @return array <p>Массив с информацией о пользователе</p>
     */
    public static function getUserById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }

    public static function checkConfirmPassword($password, $rpassword)
    {
        return $password == $rpassword ? true : false;
    }
}