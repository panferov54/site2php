<h3 class="lead my-5">Registration</h3>

<?php
if (!isset($_POST['regbtn'])){
    ?>
    <form action="index.php?page=3" method="post" class="my-5">
        <div class="form-group">
            <label for="login"></label>Login:
            <input type="text" class="form-control w-25" name="login" id="login">
        </div>
        <div class="form-group">
            <label for="pass1"></label>Password:
            <input type="password" class="form-control w-25" name="pass1" id="pass1">
        </div>
        <div class="form-group">
            <label for="pass2"></label>Password:
            <input type="password" class="form-control w-25" name="pass2" id="pass2">
        </div>
        <div class="form-group">
            <label for="email"></label>Email:
            <input type="email" class="form-control w-25" name="email" id="email">
        </div>
        <input type="submit" name="regbtn" class="btn btn-primary mb-5" value="Register">
    </form>

<?php
} else {
    if (register($_POST['login'],$_POST['pass1'],$_POST['pass2'],$_POST['email'])){
        echo "<h3 class='text-success'>Пользователь добавлен </h3>";
    }
}