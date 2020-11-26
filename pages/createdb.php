<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
include_once ("functions.php");
$link=connect();
// создание таблицы Стран и полей к ней
//int - тип данных для целых чисел
//varchar - текстовый тип данных
//not null - не может быть пустым
//unique - данные и в этом поле не могут повторяться
//auto_increment - значения в данном поле будут автоматически увеличиваться на один
//primary key - ключевое поле должно быть у идентификатора. Будет создаваться автоматически и менять его самостоятльно не нужно
//foreign key - устанавливает внешний ключ, который связывает поле текущей таблицы с полем другой таблицы
//delete cascade - если будет удалено родительское поле, то все дочернии поля будут удалены.

$ct1='CREATE TABLE countries(
id int not null auto_increment primary key,
country varchar(64) not null unique 
)default charset="utf8"';

$ct2='CREATE TABLE cities(
id int not null auto_increment primary key,
city varchar(64) not null ,
countryid int,
foreign  key(countryid) references countries(id) on delete cascade 
)default charset="utf8"';

$ct3='CREATE TABLE hotels(
id int not null auto_increment primary key,
hotel varchar(64),
cityid int,
foreign  key(cityid) references cities(id) on delete cascade,
countryid int,
foreign  key(countryid) references countries(id) on delete cascade,
stars int,
coast int,
info varchar(2048) 
)default charset="utf8"';

$ct4='CREATE TABLE images(
id int not null auto_increment primary key,
imagepath varchar(256),
hotelid int,
foreign  key(hotelid) references hotels(id) on delete cascade
)default charset="utf8"';

$ct5='CREATE TABLE roles(
id int not null auto_increment primary key,
role varchar(16)
)default charset="utf8"';


$ct6='CREATE TABLE users(
id int not null auto_increment primary key,
login varchar(64) unique ,
pass varchar (128),
email varchar (64),
discount int,
avatar mediumblob,
roleid int,
foreign  key(roleid) references roles(id) on delete cascade
)default charset="utf8"';


$ct7='CREATE TABLE comments(
id int not null auto_increment primary key,
hotelid int,
foreign  key(hotelid) references hotels(id) on delete cascade,
comment varchar(2048) 
)default charset="utf8"';


//error_reporting(E_ALL);
//mysqli_query($link,$ct7);
//$err=mysqli_errno($link);
//if($err){
//    echo "Error code 1: $err <br>";
//    exit;
//}

//mysqli_query($link,$ct2);
//$err=mysqli_errno($link);
//if($err){
//    echo "Error code 2: $err <br>";
//    exit;
//}
//
//mysqli_query($link,$ct3);
//$err=mysqli_errno($link);
//if($err){
//    echo "Error code 3: $err <br>";
//    exit;
//}

//mysqli_query($link,$ct4);
//$err=mysqli_errno($link);
//if($err){
//    echo "Error code 4: $err <br>";
//    exit;
//}
//mysqli_query($link,$ct5);
//$err=mysqli_errno($link);
//if($err){
//    echo "Error code 5: $err <br>";
//    exit;
//}

//mysqli_query($link,$ct6);
//$err=mysqli_errno($link);
//if($err){
//    echo "Error code 6: $err <br>";
//    exit;
//}


?>
</body>
</html>
