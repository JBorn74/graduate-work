<header>
    <div class="container">

            <div class="logo">
               <img src="../../public/img/cat-logo.png" alt="logo">
               <span>Уберем всё лишнее из ссылки!</span>
            </div>
                <div class="nav">
                    <a href="/"title="Главная страница">Главная</a>
                    <a href="/contact/about"title="Страничка о нас">Про нас</a>
                    <a href="/contact" title="Страничка обратной связи">Контакты</a>
                    <?php if(!$_COOKIE['email']): ?>
                    <a href="/user/auth" title="Авторизация на сайте">Войти</a>
                    <?php else: ?>
                    <a href="/user/dashboard" title="Личный кабинет пользователя">Личный кабинет</a>
                    <? endif ?>
                </div>


   <div>

</header>