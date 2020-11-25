<h4>Комментарии к Отелям</h4>
<?php
include_once ('functions.php');
$link=connect();
echo '<form action="index.php?page=2" method="post" class="input-group" id="formcomments">';
$res=mysqli_query($link,'
SELECT ho.id,ho.hotel,ho.stars,ho.cost,co.hotelid,co.comment
 FROM hotels ho,comments co where ho.id=co.hotelid
 ');

//вывод  города
echo '<table class="table table-striped">';
echo '<tr><th>Имя</th><th>Звезды</th><th>Цена</th><th>Комментарий</th></tr>';
while($row=mysqli_fetch_array($res,MYSQLI_NUM)){
    echo '<tr>';
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[5]</td>";

    echo '</tr>';
}


echo '</table>';




echo '</form>';


if (isset($_POST['btn-comm-hotel'])){

        $hotelid = $_POST['val-comm-hotel'];
        $comment = trim(htmlspecialchars($_POST['comment']));
        mysqli_query($link, "INSERT INTO comments(hotelid,comment) values ('$hotelid','$comment')");

        echo '<script>window.location=document.URL</script>';

}
