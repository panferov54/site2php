<h2>Private page</h2>
<?php
$link=connect();
$sel="SELECT * FROM users WHERE roleid=2 ORDER BY login";
$res=mysqli_query($link,$sel);
//форма для измения роли юзеров
echo '<form action="" method="post" enctype="multipart/form-data" class="input-group">';
echo '<select name="userid">';
while ($row=mysqli_fetch_array($res,MYSQLI_NUM)){
    echo "<option value='$row[0]'>$row[1]</option>";
}
echo '</select>';
echo '<input type="file" name="file" accept="images/*">';
echo '<input type="submit" name="addadmin" value="Сделать админом" class="btn btn-danger">';
echo '</form>';

//обработчик измения роли и добавления аватарки
if (isset($_POST['addadmin'])){
    $fn=$_FILES['file']['tmp_name'];
    $file=fopen($fn,'rb');//открытие на побитовое чтение файла(картинки)
    $img=fread($file,filesize($fn));
    fclose($file);
    $img=addslashes($img);//проэнкранируем символы в имени файла для безопасности
    $upd="UPDATE users SET avatar='$img',roleid=1 WHERE id=".$_POST['userid'];
    mysqli_query($link,$upd);
}

//вывод всех админов с аватарками
$sel='SELECT * FROM users WHERE roleid=1 ORDER BY login';
$res=mysqli_query($link,$sel);
echo '<table class="table table-striped">';
while($row=mysqli_fetch_array($res,MYSQLI_NUM)){
    echo '<tr>';
echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[3]</td>";
    //вывод аватарки с предварительной раскадировкой
    $img=base64_encode($row[5]);
    echo "<td><img src='data:image/*; base64, $img' alt='avatar' style='width: 100px;'></td>";
    echo '</tr>';

}
mysqli_free_result($res);
echo '</table>';
