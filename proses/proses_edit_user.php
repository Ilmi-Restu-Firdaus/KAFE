<?php
include "connect.php";
 $id = (isset ($_POST ['id'])) ? htmlentities($_POST['id']) : "" ;
 $Nama = (isset ($_POST ['Nama'])) ? htmlentities($_POST['Nama']) : "" ;
 $username = (isset ($_POST ['username'])) ? htmlentities($_POST['username']) : "" ;
 $nohp = (isset ($_POST ['nohp'])) ? htmlentities($_POST['nohp']) : "" ;
 $level = (isset ($_POST ['level'])) ? htmlentities($_POST['level']) : "" ;
 $alamat = (isset ($_POST ['alamat'])) ? htmlentities($_POST['alamat']) : "" ;
 $password = (isset ($_POST ['password'])) ? htmlentities($_POST['password']) : "" ;
 


 
if(!empty($_POST['input_user_validate'] )) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND id != '$id'");
    if(mysqli_num_rows($select) > 0) {
        $message = '<script>alert("username has already exists");
                    window.location="../user"</script>';
    } else {
    $query = mysqli_query($conn, "UPDATE tb_user SET Nama='$Nama',username='$username',nohp='$nohp',level='$level',alamat='$alamat',password='$password' WHERE id='$id'");

    if (!$query) {
        $message = '<script>alert("Failed update Data");
                    window.location="../user"</script>';
        
    } else {
        $message = '<script>alert("Success uptate Data");
                    window.location="../user"</script>';
    }}
 } echo $message;
?>