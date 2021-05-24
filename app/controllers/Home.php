<?php


//Контроллер главной страницы
    class Home extends App\Controller {

        private $link;
        private $user;
        private $id_user;




        public function index($params='') {

            $data['links']=[];
            $this->link = $this -> model('LinkModel');
            $this->user = $this -> model('UserModel');
            $this->id_user = $this->user -> getUser()['id'];
            //добавление ссылки
            if(isset($_POST['short'])&& $_COOKIE['email']) {
                 $data['message']=$this->addLink();
                 }
                else{
                    $data['message']='';
                }
                //Удаление ссылки
            if(isset($_POST['deleteLink'])){
                $this->deleteLink($_POST['field']);
            }
            //Редирект ссылки
            if ($params!=''){
                $result=$this->link->existShortLink($params,$this->id_user);
                $this->redirectLink($result['long_link']);
            }

            //выводим все ссылки
            $data['links']=$this->showAllLinks();
                         if  (empty($data['links'])){ // если ссылок нет то выводим сообщение
                         $data['notlinks']='Ссылок пока еще нет!';
                         $data['links']=[];
                         }
                $this->view('home/index',$data);
       }


       public function addLink(){ //Метод добаввления ссылки

            $this->link -> setData($_POST['longsite'], $_POST['shortsite'], $this->id_user);
            $message = $this->link-> validForm();
            if ($message == 'Верно') {
                $this->link -> addLink();
                $data['message'] = '';
            }
            else{
                $data['message'] = $message;
            }
            return $data['message'];
        }



      public function showAllLinks(){   //Метод вывода всех ссылок на странице
            $this->link = $this -> model('LinkModel');
           return $result= $this->link->getLink($this->id_user);
      }

      public function deleteLink($link){ //Метод удаления ссылки
            $this->link->deleteLink($link);
      }
        public function error404()    { //вывод ошибки 404
            $this->view('errors/error404');
        }

      public function redirectLink($link){ //редирект
            header("location:$link");
      }
    }