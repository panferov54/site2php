<?php
include_once ('functions.php');
$link=connect();
$cityid=$_POST['cityid'];
$sel="SELECT id,hotel,stars,cost FROM hotels WHERE cityid='$cityid'";
$res=mysqli_query($link,$sel);
echo '<table class="table table-striped">';
echo '<tr><th>Отель</th><th>Звезды</th><th>Цена</th><th>Информация</th></tr>';
while($row=mysqli_fetch_array($res,MYSQLI_NUM)){
    echo "<tr>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td><a href='pages/hotelinfo.php?hotel=$row[0]' target='_blank'>подробнее...</a></td>";
    echo "</tr>";
}
echo '</table>';
mysqli_free_result($res);