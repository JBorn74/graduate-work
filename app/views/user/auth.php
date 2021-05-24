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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <title>Страница авторизации</title>

</head>
<body>

<div class="wrapper">
    <div class="content">
    <?php require_once 'public/blocks/header.php'; ?>
            <div class="main_text">
            <h1>Сокра.тим</h1>
            <p>Вам  нужно сократить ссылку? Прежде чем это сделать зарегистрируйтесь на сайте</p>
                <form action="/user/auth" method="post">
                <input type="text" name="login" placeholder="Введите логин" title="Введите login,не менее 3 символов" value="<?=$_POST['login']?>">
                <input type="password" name="pass" placeholder="Введите пароль" title="Введите login,не менее 3 символов" value="<?=$_POST['pass']?>">
                    <div class="error"><?=$data['message']?></div>
                <button type="submit" class="btn btn-reg" name="reg" title="Войти на сайт">Авторизоваться</button>
                </form>


            </div>


    </div>
    <?php require_once 'public/blocks/footer.php'; ?>
</div

</body>
</html>