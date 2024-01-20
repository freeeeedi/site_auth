<?php

include_once './header.php';

if (isset($_GET['logout'])) {
    setcookie('userID', '', time() - 60);
}
?>

<h1>Авторизация на сайте</h1>
<form action="/profile.php" method="POST">
    <p>
        <label for="login">Логин</label>
        <input type="text" name="login" id="form_login">
    </p>
    <p>
        <label for="password">Пароль</label>
    <input type="password" name="password" id="form_password">
    </p>
    <input type="submit" value="Отправить">
</form>

<p>
    <a href="/regestration.php">Регистрация</a>
</p>

<?php
include_once './footer.php';
