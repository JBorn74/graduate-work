<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Сайт о окращении ссылок">
    <meta name="Keywords" content="HTML, META, метатег, тег, поисковая систем, сокращение ссылок, короткий адрес">
    <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/dashboard.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <title>Обратная связь</title>

</head>
<body>

<div class="wrapper">
    <div class="content">
        <?php require_once 'public/blocks/header.php'; ?>
        <div class="main_text">
            <h1>Обратная связь</h1>

                <p>Напишите нам, если у вас есть вопросы</p>
                <form action="/contact" method="post">


                    <input type="text" name="name" placeholder="Введите имя" title="Введите имя,не менее 3 символов" value="<?=$_POST['name']?>"><br>
                    <input type="email" name="email" placeholder="Введите email"  title="Введите email,не менее 3 символов" value="
                    <?php   //для облегчения авторизованному пользователю - email добавляется в форму
                    if (isset($_COOKIE['email'])){
                        echo $_COOKIE['email'];
                        }
                        else{
                            echo $_POST['email'];
                        }
                    ?>
                    "><br>
                    <input type="text" name="age" placeholder="Введите возраст"title="Введите ваш возраст,от 10 до 90 лет" value="<?=$_POST['age']?>"><br>
                    <textarea name="message" placeholder="Введите само сообщение" title="Введите сообщение ,не менее 10 символов"><?=$_POST['message']?></textarea>
                    <div class="error"><?=$data['message']?></div>
                    <button type="submit" class="btn btn-reg" name="reg" title="Отправить нам ваше сообщение">Отправить</button>

                </form>

        </div>

    </div>
    <?php require_once 'public/blocks/footer.php'; ?>
</div
<?php return ?>
</body>













