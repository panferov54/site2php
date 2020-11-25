<ul class="nav nav-pills justify-content-between">
    <li class="nav-item"><a href="index.php?page=1" class="nav-link active">Tours</a></li>
    <li class="nav-item"><a href="index.php?page=2" class="nav-link">Comments</a></li>
    <li class="nav-item"><a href="index.php?page=3" class="nav-link">Registration</a></li>
    <li class="nav-item"><a href="index.php?page=4" class="nav-link">Admin Forms</a></li>

    <?php
    if(isset($_SESSION['radmin'])){
        echo '<li class="nav-item"><a href="index.php?page=5" class="nav-link">Private page</a></li>';

    }
    ?>


</ul>
