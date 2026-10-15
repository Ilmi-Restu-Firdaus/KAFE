<?php
include "connect.php";
 $Nama = (isset ($_POST ['Nama'])) ? htmlentities($_POST['Nama']) : "" ;
 $username = (isset ($_POST ['username'])) ? htmlentities($_POST['username']) : "" ;
 $nohp = (isset ($_POST ['nohp'])) ? htmlentities($_POST['nohp']) : "" ;
 $level = (isset ($_POST ['level'])) ? htmlentities($_POST['level']) : "" ;
 $alamat = (isset ($_POST ['alamat'])) ? htmlentities($_POST['alamat']) : "" ;
 $password = (isset ($_POST ['password'])) ? htmlentities($_POST['password']) : "" ;
 


 
if(!empty($_POST['input_user_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if(mysqli_num_rows($select) > 0) {
        $message = '<script>alert("username has already exists");
                    window.location="../user"</script>';
    } else {
    $query = mysqli_query($conn, "INSERT INTO tb_user (Nama,username,nohp,level,alamat,password) values ('$Nama','$username','$nohp','$level','$alamat','$password')");

    if (!$query) {
        $message = '<script>alert("Failed Input Data");
                    window.location="../user"</script>';
        
    } else {
        $message = '<script>alert("Success Input Data");
                    window.location="../user"</script>';
    } 
}
 } echo $message;
?>


