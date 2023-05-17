<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="MobileOptimized" content="176"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="robots" content="noindex,nofollow"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://yastatic.net/jquery/3.3.1/jquery.min.js"></script>
    <title>Расписание</title>
    <script>
        <?php
        function get_all_admins(): array
        {
            include './pass.php';
            /** @var string $user*/
            /** @var string $host*/
            /** @var string $passw*/
            /** @var string $db*/

            $mysql = new mysqli($host,
                $user,
                $passw,
                $db);
            $res = $mysql->query("SELECT * FROM `STUDENTS` WHERE `isAdmin` = 1");
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        ?>
        <?php
            if (empty($_GET)) {
                die(503);
            }
            $auth_token = $_GET['auth_token'];
            if ($auth_token) {
                $admins = get_all_admins();
                $status = 0;
                foreach ($admins as $admin) {
                    if ($auth_token == md5($admin['tgid'])) {
                        echo 'console.log("Вы авторизованы!")';
                        $status = 1;
                    }
                }
            }
            else {
                die(503);
            }
            if ($status == 0) {
                die(503);
            }
        ?>
    </script>
</head>
<body>
<main>
    <div class="container mt-4">
        <div class="row">
                <?php
                function get_all_users(): array
                {
                    include './pass.php';
                    /** @var string $user*/
                    /** @var string $host*/
                    /** @var string $passw*/
                    /** @var string $db*/

                    $mysql = new mysqli('localhost', 'ag15', 'ag151234', 'pravschool');
                    $res = $mysql->query("SELECT * FROM `STUDENTS`");
                    return $res->fetch_all(MYSQLI_ASSOC);
                }
                ?>
            <div class="col">
                <table>
                    <caption>Пользователи</caption>
                    <tr>
                        <th>ID<th>
                        <th>Имя<th>
                        <th>Юзернейм<th>
                        <th>Класс<th>
                        <th>Админ<th>
                        <th>ЭЖ<th>
                        <th>Учитель<th>
                        <th>Логин<th>
                        <th>Пароль<th>
                        <th>Уведомления<th>
                        <th>Бан<th>
                        <th>Реф<th>
                    </tr>
                    <?php
                    $users = get_all_users();
                    foreach ($users as $user) {
                        $admin=$user['isAdmin'];
                        $ns=$user['isNs'];
                        $teacher=$user['isTeacher'];
                        $notifi=$user['duty_notification'];
                        $blocked=$user['blocked'];
                        $all=array($admin, $ns, $teacher, $notifi, $blocked);
                        foreach ($all as $key => $value) {
                            if ($value==1) {
                                $all[$key]='Да';
                            }
                            else {
                                $all[$key]='Нет';
                            }
                        }
                        echo "<tr>";
                        echo "<td>$user[tgid]<td>";
                        echo "<td>$user[name]<td>";
                        echo "<td>$user[username]<td>";
                        echo "<td>$user[clas]<td>";
                        echo "<td>$all[0]<td>";
                        echo "<td>$all[1]<td>";
                        echo "<td>$all[2]<td>";
                        echo "<td>$user[login]<td>";
                        echo "<td>$user[password]<td>";
                        echo "<td>$all[3]<td>";
                        echo "<td>$all[4]<td>";
                        echo "<td>$user[ref]<td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="col">
                <form action="edit.php" method="post">
                    <h2>Редактирование</h2>
                    <label for="tgid">ID:</label>
                    <select class="form-control" id="tgid" name="tgid">
                        <option value="">--Выберите пользователя--</option>
                        <?php
                        $users = get_all_users();
                        foreach ($users as $user) {
                            echo "<option value='$user[id]' data-json='" . json_encode($user) . "'>$user[tgid]($user[name])</option>";
                        }
                        ?>
                    </select><br>
                    <label for="class">Класс:</label>
                    <select id="class" class="form-control" name="class">
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='101'>10б</option>
                        <option value='102'>10г</option>
                        <option value='103'>10ф</option>
                        <option value='111'>11б</option>
                        <option value='112'>11с</option>
                        <option value='113'>11ф</option>
                    </select><br>
                    <label for="admin">Админ:</label>
                    <select id="admin" class="form-control" name="admin">
                        <option value="0">Нет</option>
                        <option value="1">Да</option>
                    </select><br>
                    <label for="ns">ЭЖ:</label>
                    <select id="ns" class="form-control" name="ns">
                        <option value="1">Есть</option>
                        <option value="0">Нет</option>
                    </select><br>
                    <label for="teacher">Учитель:</label>
                    <select id="teacher" class="form-control" name="teacher">
                        <option value="0">Нет</option>
                        <option value="1">Да</option>
                    </select><br>
                    <label for="log">Логин:</label>
                    <input type="text" class="form-control" name="log" id="log" placeholder="Логин" value=""><br>
                    <label for="pass">Пароль:</label>
                    <input type="text" class="form-control" name="pass" id="pass" placeholder="Пароль" value="" <br>
                    <label for="notification">Уведомления:</label>
                    <select id="notification" class="form-control" name="notification">
                        <option value="0">Отключены</option>
                        <option value="1">Включены</option>
                    </select><br>
                    <label for="blocked">Доступ:</label>
                    <select id="blocked" class="form-control" name="blocked">
                        <option value="0">Разблокирован</option>
                        <option value="1">Заблокирован</option>
                    </select><br>
                    <button class="btn btn-success">Обновить</button><br>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">

            </div>
        </div>
    </div>
</main>
<script>
    <?php
    foreach ($_GET as $key => $value) {
        if ($key='ondie' && $value=='true') {
            echo 'alert("Ошибка!\nНеправильный ввод.");';
        }
    }
    ?>
    $('#tgid').on('change', function() {
        let selected = $(this).find('option[value="' + $(this).val() + '"]').data('json');
        $('#class').val(selected.clas);
        $('#admin').val(selected.isAdmin);
        $('#ns').val(selected.isNs);
        $('#teacher').val(selected.isTeacher);
        $('#log').val(selected.login);
        $('#pass').val(selected.password);
        $('#notification').val(selected.duty_notification);
        $('#blocked').val(selected.blocked);
    });
</script>
</body>
</html>
