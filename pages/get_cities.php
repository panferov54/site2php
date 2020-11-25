<?php
include_once ('functions.php');
$link=connect();
$coid=$_GET['coid'];
$sel="SELECT * FROM cities WHERE countryid='$coid'";
$res=mysqli_query($link,$sel);
echo '<option value="0">Выбрать город</option>';
while ($row=mysqli_fetch_array($res,MYSQLI_NUM)){

        echo "<option value='$row[0]'>$row[1]</option>";

}
mysqli_free_result($res);