<?php

require 'UserModel.php';
//Класс для создания коротких ссылок

class LinkModel   {

    private $long_link;
    private $short_link;
    private $id_user;
    private $_db = null;

    public function __construct() { //подключение к БД
        $this->_db = DB::getInstence();
    }

    public function setData($long_link, $short_link, $id_user) { // установка данных

        $this->long_link =trim(filter_var($long_link,FILTER_SANITIZE_STRING)) ;
        $this->short_link =trim(filter_var($short_link,FILTER_SANITIZE_STRING)) ;
        $this->id_user =trim(filter_var($id_user,FILTER_SANITIZE_STRING)) ;

    }
    public function validForm() {   //проверка вводимых данных

        if(strlen($this->long_link) < 8)
            return "Адрес слишком короткий";
        else if(strlen($this->short_link) < 2)
            return "Короткая ссылка слишком короткая, необходимо ввести хотя-бы 2 символа";
        else if(!empty($this->existShortLink($this->short_link,$this->id_user))){
            return  "Такое сокращение уже используется в базе!";
    }
        else
            return "Верно";
    }

    public function addLink(){ //добавление ссылки

        $sql = 'INSERT INTO link (long_link, short_link, id_user) VALUES(:long_link, :short_link, :id_user)';
        $query = $this->_db->prepare($sql);
        $query->execute(['long_link' => $this->long_link, 'short_link' => $this->short_link, 'id_user' => $this->id_user]);
        $_POST['longsite']='';
        $_POST['shortsite']='';
   }

    public function existShortLink($shortlink,$id_user){ //проверка, существует ли в БД короткая ссылка

        $sql = "SELECT * FROM `link` WHERE `short_link` = :short_link &&   `id_user`=:id_user";
        $query = $this->_db->prepare($sql);
        $query->execute(['short_link' => $shortlink,'id_user'=>$id_user]);
        $result=$query->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    public function getLink($id_user){          // Метод получения данных по id user

        $sql="SELECT * FROM `link` WHERE `id_user` =:id_user ORDER BY `id` DESC";
        $query = $this->_db->prepare($sql);
        $query->execute(['id_user' => $id_user]);
        return $result=$query->fetchAll(PDO::FETCH_ASSOC);
         }



    public function deleteLink($link){ //Метод удаления ссылки

        $sql = "DELETE FROM `link`  WHERE `id`=:id ";
        $query = $this->_db->prepare($sql);
        $query->execute(['id' => $link]);

    }
}