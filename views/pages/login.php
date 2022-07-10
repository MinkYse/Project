<?php
use App\Services\Page;
?>

<!doctype html>
<html lang="ru" class="">
<?php
Page::part('head');
?>
<body>
<?php
Page::part('navbar');
?>
<form id="sign_in">
    <div class="imgcontainer">
        <img src="/assets/img/pngwing.com.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="uname"><b>Логин</b></label>
        <input type="text" placeholder="Введите логин" name="uname" required>

        <label for="psw"><b>Пороль</b></label>
        <input type="password" placeholder="Введите пороль" name="psw" required>

        <button class="login-btn" type="submit">Войти</button>
    </div>
    <div class="container hide d-flex justify-content-center">
        <p class="msg"></p>
    </div>
</form>
<?php
Page::part('footer');
?>
<script src="/assets/js/user.js"></script>
</body>
</html>
