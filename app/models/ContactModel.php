<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
    class ContactModel {    //класс для контактов
        private $name;
        private $email;
        private $age;
        private $message;

        public function setData($name, $email, $age, $message) { //установка данных
            $this->name = trim(filter_var($name,FILTER_SANITIZE_STRING)) ;
            $this->email =trim(filter_var($email,FILTER_SANITIZE_EMAIL)) ;
            $this->age = trim(filter_var($age,FILTER_SANITIZE_EMAIL)) ;
            $this->message =trim(filter_var($message,FILTER_SANITIZE_STRING));
        }

        public function validForm() { //Проверка данных в форме обратной связи
            if(strlen($this->name) < 3)
                return "Имя слишком короткое";
            else if(strlen($this->email) < 3)
                return "Email слишком короткий";
            else if(!is_numeric($this->age) || $this->age <= 10 || $this->age > 90)
                return "Вы ввели не возраст";
            else if(strlen($this->message) < 10)
                return "Сообщение слишком короткое";
            else
                return "Верно";
        }

           public function mail(){  // отправка сообщений через PHP mailer

                $mail = new PHPMailer(true);
                $mail->setLanguage('ru', '/optional/path/to/language/directory/');
                $mail->CharSet='UTF-8';
                try {
                    //Server settings
                    $mail -> SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                    $mail -> isSMTP();                                            //Send using SMTP
                    $mail -> Host = 'smtp.mail.ru';                     //Set the SMTP server to send through
                    $mail -> SMTPAuth = true;                                   //Enable SMTP authentication
                    $mail -> Username = '***@mail.ru';                     //SMTP username Ввести логин
                    $mail -> Password = '*******';                               //SMTP password  Ввести пароль
                    $mail -> SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail -> Port = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail -> setFrom('twink_mistakes@mail.ru', "Имя: " . $this->name);// Имя отправителя из формы
                    $mail -> addAddress('kdv-1974@mail.ru', 'Joe User');     //Ввести адрес получателя, т.е. совой
//                    $mail -> addAddress('ellen@example.com');               //Name is optional
//                    $mail -> addReplyTo('info@example.com', 'Information');
//                    $mail -> addCC('cc@example.com');
//                    $mail -> addBCC('bcc@example.com');

                    //Attachments
                  //  $mail -> addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                  //  $mail -> addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                    //Content
                    $mail -> isHTML(true);                                  //Set email format to HTML
                    $mail -> Subject = 'Сообщение с сайта от пользователя с email:'.$this->email.' возраст : '.$this->age;
                    $mail -> Body =  $this->message;
                  //  $mail -> AltBody = 'This is the body in plain text for non-HTML mail clients';

                   $mail -> send();
                    return 'Ваше сообщение было отправлено';
                } catch (Exception $e) {
                    return "Ваше сообщение не было отправлено. Ошибка: {$mail->ErrorInfo}";
                }
            }
    }