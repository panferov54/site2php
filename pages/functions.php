<?php
function connect($host="localhost:8889",$user="root",$pass="root",$dbname="travels"){
$link=mysqli_connect($host,$user,$pass,$dbname);
if(!$link){
    echo "ERROR:MYSQL";
    echo "ERROR N".mysqli_connect_errno();
    echo "ERROR ".mysqli_connect_error();
    exit;
}
    if (!mysqli_set_charset($link,"utf8")){
        echo "ERROR CHARSET UTF" .mysqli_error($link);
        exit;
    }
echo "Connection with MYSQL SERVER complete" .PHP_EOL;
return $link;
}
function register($login,$pass1,$pass2,$email){
    $login=trim(htmlspecialchars($login));
    $pass1=trim(htmlspecialchars($pass1));
    $pass2=trim(htmlspecialchars($pass2));
    $email=trim(htmlspecialchars($email));

    if($login ===''||$pass1===''||$pass2===''||$email===''){
        echo "<h4 class='text-danger'>заполните все поля</h4>";
        return false;
    }
    if (strlen($login)<3||strlen($login)>32||strlen($pass1)>64){
        echo "<h4 class='text-danger'>не корректрна длина полей</h4>";
        return false;

    }

    if ($pass1!==$pass2){
        echo "<h4 class='text-danger'>пароли не совпадают</h4>";
        return false;
    }

//    хэшируем пароль
    $pass=password_hash($pass1,PASSWORD_BCRYPT);
//    создание запроса на вставку данных о пользователе в таблицу users
    $ins= "INSERT INTO users(login,pass,email,roleid) VALUES ('$login','$pass','$email',2)";
$link=connect();
mysqli_query($link,$ins);
$err=mysqli_errno($link);
if($err){
    echo "Error code : $err <br>";
    exit;
}
return true;


}
function login($login,$pass){
    $login=trim(htmlspecialchars($login));
    $pass=trim(htmlspecialchars($pass));

    if ($login==='' || $pass===''){
        echo "<h3 class='text-danger'> Данные не корректны</h3>";
        return false;
    }
//    $link=connect();
//    $res=mysqli_query($link,"SELECT * FROM users WHERE login='$login'");
//    if($row=mysqli_fetch_array($res,MYSQLI_NUM)){
//        if(password_verify($pass,$row[2])){
//            $_SESSION['ruser']=$login;
//            if ($row[6]==1){
//              $_SESSION['radmin']=$login;
//            }
//            return true;
//        }
//    }else{
//        echo "<h3 class='text-danger'> Пользователь не найден</h3>";
//        return false;
//    }
    $link = connect();
    $res = mysqli_query($link,"SELECT login,pass , roleid FROM users WHERE login='$login'");
    if($row=mysqli_fetch_array($res, MYSQLI_NUM)) {
        if ($login == $row[0] and password_verify($pass, $row[1])) {
            $_SESSION['ruser'] = $login;
            if ($row[2] == 1) {
                $_SESSION['radmin'] = $login;
            }
        } else {
            echo "<h3 class='text-danger'>Нет пользователя</h3>";
            return false;
        }
    }

}