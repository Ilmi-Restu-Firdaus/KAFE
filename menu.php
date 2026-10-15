<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu
    LEFT JOIN tb_kategori_menu ON tb_kategori_menu.id_kat_menu = tb_daftar_menu.kategori");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
 $select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu, kategori_menu FROM tb_kategori_menu");

?>


<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Menu page
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaltambahmenu"> Add Menu </button>
                </div>
            </div>
            <!-- Modal ADD MENU -->
            <div class="modal fade" id="modaltambahmenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control py-3" id="uploadfoto" placeholder="yourname" name="foto" required>
                                            <label class="input-group-text" for="floatingInput">upload</label>
                                            <div class="invalid-feedback">
                                                Please Input a file/photo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama menu" name="nama_menu" required>
                                            <label for="floatingInput">Name</label>
                                            <div class="invalid-feedback">
                                                Please Input Name.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="keterangan" name="keterangan" >
                                            <label for="floatingpassword">Keterangan</label>
                                            <div class="invalid-feedback">
                                                Please Input a password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 "> 
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="kat_menu" required>
                                                <option selected hidden value="">Pilih kategori menu</option>
                                                <?php
                                                foreach($select_kat_menu as $value){
                                                    echo"<option value= ".$value['id_kat_menu']."> $value[kategori_menu] </option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Category Food or Drink</label>
                                            <div class="invalid-feedback">
                                                Select Category Food or Drink.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" required>
                                            <label for="floatingInput">Price</label>
                                            <div class="invalid-feedback">
                                                Input price.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="08xxxx" name="stok" required>
                                            <label for="floatingInput">stock</label>
                                            <div class="invalid-feedback">
                                                 Input stock.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                        

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_menu_validate" value="12345">Save changes</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- end modal add menu -->
            
            <?php
            if (empty($result)) {
                echo "data menu Empty";
            } else {

            foreach ($result as $row) {
            ?>

                <!-- Modal view -->
                <div class="modal fade" id="modalview<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Lihat Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input disabled type="text" class="form-control" id="floatingInput" placeholder="Nama menu" name="nama_menu" value="<?php echo $row['nama_menu'] ?>
                                            ">
                                            <label for="floatingInput">Name</label>
                                            <div class="invalid-feedback">
                                                Please Input Name.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input disabled type="text" class="form-control" id="floatingInput"  value="<?php echo $row['keterangan'] ?>">
                                            <label for="floatingpassword">Keterangan</label>
                                            <div class="invalid-feedback">
                                                Please Input a password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 "> 
                                        <div class="form-floating mb-3">
                                            <select disabled class="form-select" aria-label="Default select example" name="kat_menu" required>
                                                <option selected hidden value="">Pilih kategori menu</option>
                                                <?php
                                                foreach($select_kat_menu as $value){
                                                    if($row['kategori'] == $value['id_kat_menu']){
                                                        echo "<option selected value= " . $value['id_kat_menu'] . "> $value[kategori_menu] </option>";
                                                    } else{
                                                        echo "<option value=" . $value['id_kat_menu'] . "> $value[kategori_menu] </option>";
                                                    }       
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Category Food or Drink</label>
                                            <div class="invalid-feedback">
                                                Select Category Food or Drink.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input disabled type="number" class="form-control" id="floatingInput"  value="<?php echo $row['harga'] ?>">
                                            <label for="floatingInput">Price</label>
                                            <div class="invalid-feedback">
                                                Input price.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input disabled type="number" class="form-control" id="floatingInput" value="<?php echo $row['stok'] ?>">
                                            <label for="floatingInput">stock</label>
                                            <div class="invalid-feedback">
                                                 Input stock.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                        

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_menu_validate" value="12345">Save changes</button>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">edit Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_edit_menu.php" method="POST" enctype="multipart/form-data">
                                     <input type="hidden" value="<?php echo $row['id'] ?>" name="id">           

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control py-3" id="uploadfoto" placeholder="yourname" name="foto" required >
                                            <label class="input-group-text" for="floatingInput">upload</label>
                                            <div class="invalid-feedback">
                                                Please Input a file/photo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama menu" name="nama_menu" required value="<?php echo $row['nama_menu'] ?>">
                                            <label for="floatingInput">Name</label>
                                            <div class="invalid-feedback">
                                                Please Input Name.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="keterangan" name="keterangan" value="<?php echo $row['keterangan'] ?>">
                                            <label for="floatingpassword">Keterangan</label>
                                            <div class="invalid-feedback">
                                                Please Input a password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 "> 
                                        <div class="form-floating mb-3">
                                        <select class="form-select" aria-label="Default select example" name="kat_menu" required>
                                                <option selected hidden value="">Pilih kategori menu</option>
                                                <?php
                                                foreach($select_kat_menu as $value){
                                                    if($row['kategori'] == $value['id_kat_menu']){
                                                        echo "<option selected value= " . $value['id_kat_menu'] . "> $value[kategori_menu] </option>";
                                                    } else{
                                                        echo "<option value=" . $value['id_kat_menu'] . "> $value[kategori_menu] </option>";
                                                    }       
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Category Food or Drink</label>
                                            <div class="invalid-feedback">
                                                Select Category Food or Drink.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" required value="<?php echo $row['harga'] ?>">
                                            <label for="floatingInput">Price</label>
                                            <div class="invalid-feedback">
                                                Input price.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="08xxxx" name="stok" required value="<?php echo $row['stok'] ?>"> 
                                            <label for="floatingInput">stock</label>
                                            <div class="invalid-feedback">
                                                 Input stock.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                        

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_menu_validate" value="12345">Save changes</button>
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_menu.php" method="POST">

                                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                <input type="hidden" value="<?php echo $row['foto'] ?>" name="foto">
                                <div class="col-lg-12">
                                    Hapus menu  <b> <?php echo $row['nama_menu'] ?></b> ?
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete_menu_validate" value="12345">Delete</button>
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
                            <tr class="nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Details</th>
                                <th scope="col">category</th>
                                <th scope="col">type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?>
                                </th>
                                <td>
                                        <div style="width:90px">
                                        <img src="assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="..."> 
                                        </div>
                                    </td>
                                    
                                    
                                    <td><?php echo $row['nama_menu'] ?> </td>
                                    <td><?php echo $row['keterangan'] ?> </td>
                                    <td><?php echo $row['kategori_menu'] ?> </td>
                                    <td><?php echo ($row['jenis_menu'] ==1) ? "makanan" : "Minuman" ?> </td>
                                    <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                                    
                                    <td><?php echo $row['stok'] ?> </td>
                                   
                                    <td >
                                        <div class="d-flex">

                                        <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalview<?php echo $row['id'] ?>"><i class="bi bi-eye-fill"></i></button>
                                        <button class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil-fill" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id'] ?>"></i></i> </button>
                                        <button class="btn btn-danger btn-sm"      ><i class="bi bi-trash-fill"  data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $row['id'] ?>"></i></i> </button>
                                        </div>
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
