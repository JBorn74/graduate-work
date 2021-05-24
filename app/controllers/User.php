<?php

//Контроллер пользователя
    class User extends App\ Controller {

        public function reg() { //Метод регистрации

            //Проверка вводимых данных
            $data = [];
            if(isset($_POST['login'])) {
                $user = $this->model('UserModel');
                $user->setData($_POST['login'], $_POST['email'], $_POST['pass']);
                $isValid = $user->validForm();
                if($isValid == "Верно")
                    $user->addUser();
                else
                    $data['message'] = $isValid;
            }
            $this->view('home/index', $data);
        }


        public function dashboard() { //Метод кабинета пользователя

            $user = $this->model('UserModel');

            if(isset($_POST['exit_btn'])) { //выход при нажатии на кнопку
                $user->logOut();
                exit();
            }
                if(isset($_COOKIE['email'])) //если пользователь не авторизован- л\к по адресной строке недоступен
                    $this->view('user/dashboard', $user->getUser());
                else $this->view('home/index');
        }

        public function auth() {    //Метод аунтификации

            $data = [];
            if(isset($_POST['login'])) {
                $user = $this->model('UserModel');
                $data['message'] = $user->auth(trim(filter_var($_POST['login'],FILTER_SANITIZE_STRING)) ,
                    trim(filter_var($_POST['pass'],FILTER_SANITIZE_STRING)) );
            }
            $this->view('user/auth', $data);
        }

        public function addsite(){  //метод для добавления короткой ссылки
            if (isset($_POST['short'])){
                echo 'OK';
            }
        }
        public function error404()    {
            $this->view('errors/error404');
        }
    }