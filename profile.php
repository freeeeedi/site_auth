<?php

include './Classes/includeClasses.php';

$db = new DataBase();
$auth = new Auth($db);
$user = new User($db);

$login = '';
$password = '';

if (isset($_POST['login']) && isset($_POST['password'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login && $password) {
        $login_result = $auth->login($login, $password);
    }

    if ($login_result['result'] === true && !isset($_COOKIE['userID'])) {
        setcookie('userID', $login_result['user']['id'], time() + 60 * 60, '/',);
    } else {
        echo $login_result['message'];
    }
}

if (!isset($_COOKIE['userID']) && $login_result['result'] !== true) {
    header("Location: /");
    exit();
}


if (isset($_COOKIE['userID'])) {
    $user_info = $user->getUserByID($_COOKIE['userID'])['user'];
} else {
    $user_info = $user->getUserByID($login_result['user']['id'])['user'];
}

if (isset($_GET['edit_profile'])) { ?>

    <h1>Редактирование профиля</h1>
    <form action="/profile/update_profile.php" method="post">
        <p>
            <label for="login">Логин:</label>
            <input type="text" name="login" id="login" value="<?php echo $user_info['login'] ?>">
        </p>
        <p>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" value="<?php echo $user_info['password'] ?>">
        </p>
        <p>
            <label for="password_repeat">Повторите пароль:</label>
            <input type="password" name="password_repeat" id="password_repeat">
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $user_info['email'] ?>">
        </p>
        <p>
            <label for="email">Телефон:</label>
            <input type="tel" name="phone" id="phone" value="<?php echo $user_info['phone'] ?>">
        </p>
        <p>
            <input type="submit" value="Сохранить изменения">
        </p>
    </form>
    <p>
        <a href="/profile.php">Отмена</a>
    </p>

<?php } else { ?>

    <h1>Профиль</h1>
    <p>Email:</p>
    <p><?php echo $user_info['email'] ?></p>
    <p>Телефон:</p>
    <p><?php echo $user_info['phone'] ?></p>
    <p>
        <a href="?edit_profile">Редактировать профиль</a>
        <a href="/?logout">Выйти</a>
    </p>

<?php } ?>