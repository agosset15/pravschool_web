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
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <script src="https://webappcontent.telegram.org/js/jquery.min.js"></script>
    <script>
        function setThemeClass() {
            document.documentElement.className = Telegram.WebApp.colorScheme;
        }

        Telegram.WebApp.onEvent('themeChanged', setThemeClass);
        setThemeClass();

    </script>
    <title>Расписание</title>
    <style>
        /* General styles */
        body {
            background-color: var(--tg-theme-bg-color);
            color: var(--tg-theme-text-color);
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        /* Header styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

        /* Form styles */
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }

        .schedule {
            display: none;
            padding: 7px;
            font-size: 12px;
            border-radius: 5px;
            border: 2px solid var(--tg-theme-hint-color);
            margin-right: 10px;
        }

        .kabschedule {
            display: none;
            padding: 7px;
            font-size: 12px;
            border-radius: 5px;
            border: 2px solid var(--tg-theme-hint-color);
            margin-right: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            background-color: var(--tg-theme-hint-color);
            color: var(--tg-theme-text-color);
            border: none;
            border-radius: 5px;
            padding: 10px;
        }

        .homework {
            display: none;
            padding: 7px;
            font-size: 12px;
            border-radius: 5px;
            border: 2px solid var(--tg-theme-hint-color);
            margin-right: 10px;
        }

        aside {
            display: none;
            padding: 7px;
            font-size: 12px;
            border-radius: 5px;
            border: 1px solid var(--tg-theme-hint-color);
            margin-right: 10px;
        }


        /* Input styles */
        select {
            padding: 7px;
            font-size: 12px;
            border-radius: 5px;
            border: 1px solid var(--tg-theme-hint-color);
            margin-right: 10px;
        }

        input[type="text"] {
            padding: 7px;
            font-size: 12px;
            border-radius: 5px;
            border: 1px solid var(--tg-theme-hint-color);
            margin-right: 10px;
        }

        /* Button styles */
        button {
            padding: 7px 12px;
            background-color: var(--tg-theme-button-color);
            color: var(--tg-theme-button-text-color);
            border-radius: 5px;
            border: none;
            font-size: 12px;
            cursor: pointer;
        }

        /* Settings button styles */
        .dropbtn {
            background-color: var(--tg-theme-bg-color);
            color: var(--tg-theme-text-color);
            font-size: 20px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: var(--tg-theme-button-text-color);
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--tg-theme-button-color);
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 4px 8px 0px var(--tg-theme-hint-color);
            z-index: 1;
        }

        .dropdown-content a {
            color: var(--tg-theme-button-text-color);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {background-color: var(--tg-theme-bg-color)}

        .show {display: block;}
    </style>
</head>
<body>
<?php
$page = $_GET['nextpage'];
if ($page == 1){include('rasp.html');}
elseif ($page == 2){include('kab.html');}
elseif ($page == 3){include('hw.html');}
elseif ($page == 4){include('profile.html');}
elseif ($page == 'admin'){
    include('login.php');
}
?>
<script>
    function showRaspList() {
        document.getElementsByClassName("dropdown-content");
        let dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            openDropdown.classList.toggle("show");
        }
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            let dropdowns = document.getElementsByClassName("dropdown-content");
            let i;
            for (i = 0; i < dropdowns.length; i++) {
                let openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
</body>
</html>