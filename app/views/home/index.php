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
    <title>Главная страница</title>

</head>
<body>

<div class="wrapper">
    <div class="content">
    <?php require_once 'public/blocks/header.php'; ?>
            <div class="main_text">
            <h1>Сокра.тим</h1>
            <?php if (!$_COOKIE['email']): ?>
            <p>Вам  нужно сократить ссылку? Прежде чем это сделать зарегистрируйтесь на сайте</p>
                <form action="/user/reg" method="post">
                <input type="email" name="email" title="Введите email,не менее 3 символов" placeholder="Введите email" value="<?=$_POST['email']?>">
                <input type="text" name="login" title="Введите login,не менее 3 символов" placeholder="Введите логин" value="<?=$_POST['login']?>">
                <input type="password" name="pass" placeholder="Введите пароль" title="Введите пароль,не менее 3 символов" value="<?=$_POST['pass']?>">
                    <div class="error"><?=$data['message']?></div>
                <button type="submit" class="btn btn-reg" title="Регистрация на сайте" name="reg">Зарегистрироваться</button>
                </form>
                <p>Есть аккаунт? Тогда вы можете <a href="/user/auth" title="Переход на страницу авторизации">авторизоваться</a></p>
                <?php else: ?>
                    <p>Вам  нужно сократить ссылку? Сейчас мы это сделаем!</p>

<!--                Для зарегистрированных пользователей-->
                <form action="/" method="post">
                    <input type="text" title="Введите длинную ссылку,не менее 8 символов" name="longsite" placeholder="Введите длинную ссылку"value="<?=$_POST['longsite']?>">
                    <input type="text" title="Введите короткую ссылку,не менее 2 символов" name="shortsite" placeholder="Введите короткую ссылку"value="<?=$_POST['shortsite']?>" >
                    <div class="error"><?=$data['message']?></div>
                    <button type="submit" title="Уменьшить ссылку" class="btn btn-short" name="short">Уменьшить</button>
                </form>
                <div class="info">
                <h3><b>Сокращенные ссылки:</b></h3>
                <?=$data['notlinks']?>
                 </div>
                    <?php
                       foreach ($data['links'] as $el) {
                       echo'<form action="/" class="form-info" method="post">';
                       echo '<p>Длинная ссылка: '.$el['long_link'].'</p>';
                       echo '<input type="hidden" name="field" value="'.$el['id'].'">';
                       //этот вариант был самым простым, но здесь происходит переход по адресу , а не редирект, поэтому сделано через редирект, как указано в задании.
//                       echo '<p>Короткая ссылка: <a href="'.$el['long_link'].'" title="Ваша короткая ссылка">'.$el['short_link'].' </a></p>';
                       echo '<p>Короткая ссылка: <a href="/home/index/'.$el['short_link'].'" title="Ваша короткая ссылка">'.$el['short_link'].' </a></p>';
                       echo  '<button type="submit" title="Удалить ссылку" class="btn btn-delete" name="deleteLink"> Удалить    <img src=/public/img/trash-solid.svg width="16px"  alt="delete"></button>';
                       echo '</form>';
                        }

                    ?>

                <?php endif ?>
            </div>


    </div>
    <?php require_once 'public/blocks/footer.php'; ?>
</div
    <?php return ?>
</body>
</html>