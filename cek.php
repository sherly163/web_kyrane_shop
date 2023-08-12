<!-- untuk pengecekan status login -->
<?php 
    //jika belum login

    if(isset($_SESSION['log']) && isset($_SESSION['lvl']) == 'User'){

    } else {
        header('location:login.php');
    }
?>
