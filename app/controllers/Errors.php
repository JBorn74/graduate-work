<?php


class Errors extends App\Controller {
    public function index()    {
       $this->view('errors/error404');
    }
    public function error404()    {
        $this->view('errors/error404');
    }

}