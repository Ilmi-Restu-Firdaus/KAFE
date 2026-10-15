<?php 
session_start();
include "connect.php";
 $username = (isset ($_POST ['username'])) ? htmlentities($_POST['username']) : "" ;
 $password = (isset ($_POST ['password'])) ? htmlentities($_POST['password']) : "" ;
 if(!empty($_POST['submit_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
    $hasil = mysqli_fetch_array($query);
   if($hasil) {
    $_SESSION ['username_kafe'] = $username;
    $_SESSION ['level_kafe'] = $hasil['level'];
    $_SESSION ['id_kafe'] = $hasil['id'];
    header('location:../home');
   }else { ?>
    <script>
        alert('username or password you entered is incorrect');
        window.location='../login'
    </script>
<?php
   }
 }
?>
