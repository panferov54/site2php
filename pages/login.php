
<?php
if (isset($_SESSION['ruser'])){
    echo'<form action="index.php';
    if(isset($_GET['page']))echo "?page=".$_GET['page'];
    echo '" class="input-group" method="post">';
echo "<h4> Привет, ".$_SESSION['ruser'] ."</h4>";
echo '<input type="submit" name="exit" value="Log Out" class="btn btn-danger">';
    echo '</form>';

    //нажатие кнопки ЛОГ АУТ
    if (isset($_POST['exit'])){
        unset($_SESSION['ruser']);
        unset($_SESSION['radmin']);
        echo '<script> window.location.reload();</script>';
    }

}else{
    echo'<form action="index.php';
    if(isset($_GET['page']))echo "?page=".$_GET['page'];
    echo '" class="input-group" method="post">';
   echo '<input type="text" name="login" placeholder="login">';
    echo '<input type="password" name="pass" placeholder="password">';
    echo '<input type="submit" name="auth" value="Log IN" class="btn btn-success">';
    echo'</form>';
    //обработчик логина
    if (isset($_POST['auth'])AND $_POST['pass']!==''AND$_POST['login']!==''){
        login($_POST['login'],$_POST['pass']);
        echo '<script> window.location.reload();</script>';
//            echo "<h3 class='text-success'> Пользователь найден</h3>";

    }
}