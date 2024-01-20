<?php

include '../Classes/includeClasses.php';

$db = new DataBase();
$user = new User($db);

$user_info = $user->getUserByID($_COOKIE['userID'])['user'];

$new_login = $_POST['login'];
$new_pass = $_POST['password'];
$new_email = $_POST['email'];
$new_phone = $_POST['phone'];
$user_id = $_COOKIE['userID'];

$messages = [];


if ($new_login !== $user_info['login']) {

    $result = $user->updateUserInfo('login', $new_login, $user_id);
    if ($result) {
        $messages[] .= 'Логин успешно обновлен';
    } else {
        $messages[] .= 'Не удалось поменять логин';
    }
}

if ($new_pass !== $user_info['password']) {

    $result = $user->updateUserInfo('password', $new_pass, $user_id);

    if ($result) {
        $messages[] .= 'Пароль успешно обновлен';
    } else {
        $messages[] .= 'Не удалось поменять пароль';
    }
}

if ($new_email !== $user_info['email']) {

    $result = $user->updateUserInfo('email', $new_email, $user_id);

    if ($result) {
        $messages[] .= 'Почта успешно обновлена';
    } else {
        $messages[] .= 'Не удалось поменять почту';
    }
}

if ($new_phone !== $user_info['phone']) {

    $result = $user->updateUserInfo('phone', $new_phone, $user_id);

    if ($result) {
        $messages[] .= 'Телефон успешно обновлен';
    } else {
        $messages[] .= 'Не удалось поменять телефон';
    }
} ?>

<div>
    <?php foreach ($messages as $message) { ?>
        <p><?= $message ?></p>
    <?php } ?>
    <p>
        <a href="/profile.php">Профиль</a>
    </p>
</div>