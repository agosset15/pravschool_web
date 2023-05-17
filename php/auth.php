<?php
include './pass.php';

$login = filter_var(trim($_POST['login']), 513);
$pass = filter_var(trim($_POST['password']), 513);

/** @var string $user*/
/** @var string $host*/
/** @var string $passw*/
/** @var string $db*/

$mysql = new mysqli($host,
    $user,
    $passw,
    $db);
$res = $mysql->query("SELECT * FROM `STUDENTS` WHERE `isAdmin` = 1");
$res->fetch_all(MYSQLI_ASSOC);


foreach ($res as $value) {
    if ($value['password'] == $pass && $value['login'] == $login) {
        $auth = $value['tgid'];
        $auth_token = (md5($auth));
        ob_start();
        $new_url = 'https://tg.ag15.ru/table.php?auth_token='.$auth_token;
        header('Location: '.$new_url);
        ob_end_flush();
        $mysql->close();
        die();
    }
}
$mysql->close();
exit(503);
?>
