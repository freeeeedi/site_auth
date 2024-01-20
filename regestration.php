<?php

include 'header.php';
include './Classes/includeClasses.php';

$db = new DataBase();
$user = new User($db);
$login = '';
$password = '';
$password_repeat = '';

if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password_repeat'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
    $email = $_POST['email'] ? $_POST['email'] : '';
    $phone = $_POST['phone'] ? $_POST['phone'] : '';

    if ($login && $password === $password_repeat) {

        $registr_result = $user->createUser($login, $password, $email, $phone);

        echo $registr_result['message'];

        if ($registr_result['result'] === true) {

            $user_id = $user->getUserID($login);

            setcookie('userID', $user_id['id'], time() + 60 * 60, '/',); ?>
            <p>
                <a href="/profile.php">Профиль</a>
            </p>

        <? } else { ?>

            <p>
                <a href="/regestration.php">Регистрация</a>
                <a href="/">Авторизация</a>
            </p>

        <?php }
        unset($_POST);
    } else if ($password !== $password_repeat) { ?>

        <p>Пароли не равны!</p>
        <h1>Регистрация</h1>
        <form action="" method="POST">
            <p>
                <label for="login">Логин</label>
                <input required type="text" name="login" id="form_login">
            </p>
            <p>
                <label for="password">Пароль</label>
                <input required type="password" name="password" id="form_password">
            </p>
            <p>
                <label for="password_repeat">Подтверждение пароля</label>
                <input required type="password" name="password_repeat" id="form_password_repeat">
            </p>
            <p>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </p>
            <p>
                <label for="phone">Телефон</label>
                <input type="tel" name="phone" id="phone">
            </p>
            <input type="submit" value="Отправить">
        </form>

        <p>
            <a href="/">Авторизация</a>
        </p>

    <?php }
} else { ?>
    <h1>Регистрация</h1>
    <form action="" method="POST">
        <p>
            <label for="login">Логин</label>
            <input required type="text" name="login" id="form_login">
        </p>
        <p>
            <label for="password">Пароль</label>
            <input required type="password" name="password" id="form_password">
        </p>
        <p>
            <label for="password_repeat">Подтверждение пароля</label>
            <input required type="password" name="password_repeat" id="form_password_repeat">
        </p>
        <p>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </p>
        <p>
            <label for="phone">Телефон</label>
            <input type="tel" name="phone" id="phone">
        </p>
        <input type="submit" value="Отправить">
    </form>

    <p>
        <a href="/">Авторизация</a>
    </p>
<?php } ?>



<?php
include 'footer.php';
