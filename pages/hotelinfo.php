<?php
session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Info</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="../slick/slick.min.js"></script>
    <link rel="stylesheet" href="../slick/slick.css">
    <link rel="stylesheet" href="../slick/slick-theme.css">
</head>
<body>
<?php
include_once ('functions.php');
$link=connect();
if(isset($_GET['hotel'])){
    $hotelid=$_GET['hotel'];
    $res=mysqli_query($link,"SELECT * FROM hotels WHERE id=$hotelid");
    $row=mysqli_fetch_array($res,MYSQLI_NUM);
    $hname=$row[1];
    $hstar=$row[4];
    $hcost=$row[5];
    $hinfo=$row[6];
    mysqli_free_result($res);
        echo '<div class="container text-center">';
    echo '<h2 class="lead">Информация об отеле '.$hname.'</h2>';
    for ($i=0;$i<$hstar;$i++){
        echo '<img src="../images/star.png" alt="star" draggable="false" style="width: 30px;">';
    }

echo "<h4 class='lead'>$hinfo</h4>";

    $res=mysqli_query($link,"select id,comment from comments where hotelid=$hotelid");
    echo '<h2>Комментарии к отелю</h2>';


    echo '<form action="hotelinfo.php?hotel='.$_GET['hotel'].'" method="post" class="input-group" id="formcomments">';

if($_SESSION['ruser'] || $_SESSION['radmin']) {
    echo '<textarea name="comment" class="w-100" rows="5" placeholder="Введите комментарий" ></textarea>';
    echo "<input type='submit' name='btn-comm-hotel'  class='btn btn-success' value='добавить коментарий'>";
}



    if (isset($_POST['btn-comm-hotel'])){
        $hotelid=$_GET['hotel'];

        $comment = trim(htmlspecialchars($_POST['comment']));
        mysqli_query($link, "INSERT INTO comments(hotelid,comment) values ('$hotelid','$comment')");

        echo '<script>window.location=document.URL</script>';

    }


    echo '<div style="display: flex;flex-wrap: wrap;">';
    while ($row=mysqli_fetch_array($res,MYSQLI_NUM)){
        echo "<div class='m-2' style='background-color: beige;border-radius: 25px;padding-top: 10px;padding-left: 5px;padding-right: 5px;'><p>$row[1]<p/></div>";
        if($_SESSION['radmin']){
            echo "<input type='hidden' name='volCom' value='$row[0]'>";
            echo '<input type="submit" name="delCom" value="x" class="btn btn-danger btn-sm" style="height: 40px;padding-top: ">';
        }
    }


    if(isset($_POST['delCom'])){
        $comid=$_POST['volCom'];


        mysqli_query($link,"DELETE FROM comments WHERE id='$comid'");

        echo '<script>window.location=document.URL</script>';
    }


    echo '</div>';
    echo '</form>';



$res=mysqli_query($link,"SELECT imagepath FROM images WHERE hotelid=$hotelid");
    echo '<h2 class="lead">Фотография отеля '.$hname.'</h2>';
   echo'<div  class="slider multiple-items">';
   while ($row=mysqli_fetch_array($res,MYSQLI_NUM)){
       echo "<div><img src='../$row[0]' alt='photo' class='img-fluid'></div>";
   }

    echo'</div>';


    echo "<script>

$('.multiple-items').slick({
        arrows: true,
      infinite: true,
      dots: true,
      slidesToShow: 3,
      slidesToScroll: 1
    });
    
    </script>";
    echo '</div>';

}
?>
</body>
</html>