<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

?>


<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            User Page
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaltambahuser"> Add user </button>
                </div>
            </div>
            <!-- Modal ADD USER -->
            <div class="modal fade" id="modaltambahuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="yourname" name="Nama" required>
                                            <label for="floatingInput">Name</label>
                                            <div class="invalid-feedback">
                                                Please Input a valid name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" >
                                            <label for="floatingInput">Username</label>
                                            <div class="invalid-feedback">
                                                Please Input Username.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 ">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="level" required>
                                                <option selected disabled hidden value="">Select User Level</option>
                                                <option value="1">Owner</option>
                                                <option value="2">Staff</option>
                                            </select>
                                            <label for="floatingInput">User Level</label>
                                            <div class="invalid-feedback">
                                                Please Input level user.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="08xxxx" name="nohp" required>
                                            <label for="floatingInput">Phone Number</label>
                                            <div class="invalid-feedback">
                                                Please Input a valid Number.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingInput" placeholder="password" name="password" required>
                                            <label for="floatingpassword">Password</label>
                                            <div class="invalid-feedback">
                                                Please Input a password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="" style="height: 100px" name="alamat" required></textarea>
                                    <label for="floatingInput"> address</label>
                                    <div class="invalid-feedback">
                                        Please Input a valid address.
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_user_validate" value="12345">Save changes</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- end modal user -->

            <?php
            if (empty($result)) {
                echo "User data Empty";
            } else {
            foreach ($result as $row) {
            ?>

                <!-- Modal view -->
                <div class="modal fade" id="modalview<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">User Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
                                    
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input disabled type="text" class="form-control" id="floatingInput" placeholder="yourname" name="Nama" value="<?php echo $row['Nama'] ?>">
                                                <label for="floatingInput">Name</label>
                                                <div class="invalid-feedback">
                                                    Please Input a valid name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $row['username'] ?>" readonly>
                                                <label for="floatingInput">username</label>
                                                <div class="invalid-feedback">
                                                    Please Input Username.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 ">
                                            <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="=Default select example" id="" name="level" disabled >
                                                    <?php
                                                    $data = array("Owner","Staff");
                                                    foreach($data as $key => $value){
                                                        if($row['level'] == $key + 1){
                                                            echo "<option selected value='$key' >$value </option>";
                                                        } else{
                                                            echo "<option value='$key'>$value</option>";
                                                    } 
                                                }
                                                ?>"
                                                </select>
                                                <label for="floatingInput">User Level</label>
                                                <div class="invalid-feedback">
                                                    Please Input level user.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input disabled type="number" class="form-control" id="floatingInput" placeholder="08xxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                                <label for="floatingInput">Phone Number</label>
                                                <div class="invalid-feedback">
                                                    Please Input a valid Number.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input disabled class="form-control" id="floatingInput" placeholder="password" name="password" value="<?php echo $row['password'] ?>">
                                            <label for="floatingpassword">Password</label>
                                            <div class="invalid-feedback">
                                                Please Input a password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-floating">
                                        <textarea disabled class="form-control" id="" style="height: 100px" name="alamat"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput"> address</label>
                                        <div class="invalid-feedback">
                                            Please Input a valid address.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                
                <!-- end view action -->
                 
                <!-- Modal edit -->
                <div class="modal fade" id="modaledit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_user.php" method="POST">
                                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input  type="text" class="form-control" id="floatingInput" placeholder="yourname" name="Nama" required value="<?php echo $row['Nama'] ?>">
                                                <label for="floatingInput">Name</label>
                                                <div class="invalid-feedback">
                                                    Please Input a valid name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input <?php echo ($row['username'] == $_SESSION['username_kafe']) ?  'readonly' : ''  ; ?> type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $row['username'] ?>">
                                                <label for="floatingInput">username</label>
                                                <div class="invalid-feedback">
                                                    Please Input Username.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 ">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="=Default select example" id="" name="level" required >
                                                    <?php
                                                    $data = array("Owner","Staff");
                                                    foreach($data as $key => $value){
                                                        if($row['level'] == $key + 1){
                                                            echo "<option selected value=".($key+1)." >$value </option>";
                                                        } else{
                                                            echo "<option value=".($key+1).">$value</option>";
                                                    } 
                                                }
                                                ?>"
                                                </select>
                                                <label for="floatingInput">User Level</label>
                                                <div class="invalid-feedback">
                                                    Please Input level user.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input  type="number" class="form-control" id="floatingInput" placeholder="08xxxx" name="nohp" required value="<?php echo $row['nohp'] ?>">
                                                <label for="floatingInput">Phone Number</label>
                                                <div class="invalid-feedback">
                                                    Please Input a valid Number.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input  class="form-control" id="floatingInput" placeholder="password" name="password"required value="<?php echo $row['password'] ?>">
                                            <label for="floatingpassword">Password</label>
                                            <div class="invalid-feedback">
                                                Please Input a password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-floating">
                                        <textarea  class="form-control" id="" style="height: 100px" name="alamat" required><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput"> address</label>
                                        <div class="invalid-feedback">
                                            Please Input a valid address.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_user_validate" value="12345">Save changes</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end edit action -->

                <!-- Modal delete -->
                <div class="modal fade" id="modaldelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">delete User Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_user.php" method="POST">
                                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                <div class="col-lg-12">
                                    <?php 
                                    if($row['username'] == $_SESSION['username_kafe']){
                                        echo "<div class=' alert-danger'> You cannot delete yourself.</div>";
                                    } else {
                                        echo "are you sure you want delete this user? <b>$row[username]</b>";
                                    }
                                    ?>

                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="input_user_validate" value="12345" <?php echo ($row['username'] == $_SESSION['username_kafe']) ?  'disabled' : ''  ; ?>>Delete</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end delete action -->

            <?php
            }
            

            ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Level</th>
                                <th scope="col">action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['Nama'] ?> </td>
                                    <td><?php echo $row['username'] ?> </td>
                                    <td><?php echo $row['nohp'] ?> </td>
                                    <td><?php
                                        if ($row['level'] == 1) {
                                            echo "Owner";
                                        } elseif ($row['level'] == 2) {
                                            echo "Staff";
                                        } ?></td>
                                    <td class="d-flex">
                                        <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalview<?php echo $row['id'] ?>"><i class="bi bi-eye-fill"></i></button>
                                        <button class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil-fill" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id'] ?>"></i></i> </button>
                                        <button class="btn btn-danger btn-sm"      ><i class="bi bi-trash-fill"  data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $row['id'] ?>"></i></i> </button>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
        
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
