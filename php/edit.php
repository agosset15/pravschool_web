<?php

$tgid = filter_var(trim($_POST['tgid']), 513);
$clas = filter_var(trim($_POST['class']), 513);
$admin = filter_var(trim($_POST['admin']), 513);
$ns = filter_var(trim($_POST['ns']), 513);
$teacher = filter_var(trim($_POST['teacher']), 513);
$login = filter_var(trim($_POST['log']),  513);
$password = filter_var(trim($_POST['pass']),  513);
$notifications = filter_var(trim($_POST['notification']), 513);
$block = filter_var(trim($_POST['blocked']),  513);
$all = array($clas, $admin, $ns, $teacher, $login, $password, $notifications, $block);

if (!empty($tgid)):
    $query = "UPDATE `STUDENTS` SET `clas`='$clas', `isAdmin`='$admin', `isNs`='$ns', `isTeacher`='$teacher', `login`='$login', `password`='$password', `duty_notification`='$notifications', `blocked`='$block' WHERE `id` = $tgid";

    include './pass.php';
    /** @var string $user*/
    /** @var string $host*/
    /** @var string $passw*/
    /** @var string $db*/

    $mysql = new mysqli($host,
        $user,
        $passw,
        $db);

    $mysql->query($query);

    $mysql->close();

    header('Location: table.php');
else:
    header('Location: table.php?ondie=true');
    die();
endif;
?>

