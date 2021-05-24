<?php

    require 'DB.php';
//Класс пользователя
    class UserModel {

        private $login;
        private $email;
        private $pass;


        private $_db = null;

        public function __construct() {

            $this->_db = DB::getInstence();
        }

        public function setData($login, $email, $pass) {    //установка данных

            $this->login = trim(filter_var($login,FILTER_SANITIZE_STRING)) ;
            $this->email =trim(filter_var($email,FILTER_SANITIZE_EMAIL)) ;
            $this->pass =trim(filter_var($pass,FILTER_SANITIZE_STRING)) ;
            $this->user=[];
        }

        public function validForm() {   //проверка формы

            if(strlen($this->login) < 3)
                return "Логин слишком короткий";
            else if($this->checkUserAuthLogin($this->login) !='ok')
                return  "Пользователь с таким Login уже существует";
            else if(strlen($this->email) < 3)
                return "Email слишком короткий";
            else if($this->checkUserAuthEmail($this->email) !='ok')
                return  "Данный e-mail уже зарегистрирован";
            else if(strlen($this->pass) < 3)
                return "Пароль не менее 3 символов";

            else
                return "Верно";
        }

        public function addUser() { //добвление пользователя

            $sql = 'INSERT INTO users(login, email, pass) VALUES(:login, :email, :pass)';
            $query = $this->_db->prepare($sql);

            $pass = password_hash($this->pass, PASSWORD_DEFAULT);
            $query->execute(['login' => $this->login, 'email' => $this->email, 'pass' => $pass]);

            $this->setAuth($this->email);
        }

        public function getUser() { //Получение данных о пользователе

            $email = $_COOKIE['email'];
            $sql = "SELECT * FROM `users` WHERE `email` = :email";
            $query = $this->_db->prepare($sql);
            $query->execute(['email' => $email]);
            return $result=$query->fetch(PDO::FETCH_ASSOC);
        }

        public function logOut() {  // выход из учетной записи

            setcookie('email', $this->email, time() - 3600, '/'); // куки=1 час
            unset($_COOKIE['email']);
            header('Location: /');
        }


        public function auth($login, $pass) {   //авторизация

            $this->dataUser($login);
            if($this->user['login'] == '')
                return 'Пользователя с таким Login не существует';
            else if(password_verify($pass, $this-> user['pass']))
                $this->setAuth($this->user['email']);
            else
                return 'Вы ввели неверный пароль!';
        }

        public function setAuth($email) {   //установка куки

            setcookie('email', $email, time() + 3600, '/');
            header('Location: /home');
        }

        public function checkUserAuthLogin($login){ //проверка , существует ли пользователь с таким же именем

            $this->dataUser($login);
                if ($this-> user['login'] == '') {
                    return 'ok';
                }
        }

            public function dataUser($login){ //получение данных пользователя

                $sql = "SELECT * FROM `users` WHERE `login` = :login";
                $query = $this->_db->prepare($sql);
                $query->execute(['login' => $login]);
                return $this->user = $query->fetch(PDO::FETCH_ASSOC);

            }

         public function checkUserAuthEmail($email){ //проверка , существует ли пользователь с таким же email

            $sql = "SELECT * FROM `users` WHERE `email` = :email";
            $query = $this->_db->prepare($sql);
            $query->execute(['email' => $email]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
                  if ($user['email'] == '') {
                    return 'ok';
                }
         }
    }