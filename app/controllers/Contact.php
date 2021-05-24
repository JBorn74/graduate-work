<?php
//Контроллер для обратной связи и страницы о нас
    class Contact extends  App\Controller {
 //метод страницы обратной связи
        public function index() {
            $data = [];
            if(isset($_POST['name'])) {
                $mail = $this->model('ContactModel');
                $mail->setData($_POST['name'], $_POST['email'], $_POST['age'], $_POST['message']);

                $isValid = $mail->validForm();
                if($isValid == "Верно")
                    $data['message'] = $mail->mail();
                else
                    $data['message'] = $isValid;
            }

            $this->view("contact/index", $data);
        }
// метод страницы о нас
        public function about() {
            $this->view("/contact/about");
        }
    public function error404()    {
        $this->view('errors/error404');
    }
    }