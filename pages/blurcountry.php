<?php
include_once ('functions.php');
$link=connect();
$coid=$_GET['coname'];
mysqli_query($link, "INSERT INTO countries(country) VALUES ('$coid')");
