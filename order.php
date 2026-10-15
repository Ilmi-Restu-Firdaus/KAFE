<?php
include "proses/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT tb_order.*,tb_bayar.*,Nama, SUM(harga*jumlah) AS harganya FROM tb_order
    LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
    LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
    LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
    GROUP BY id_order ORDER BY waktu_order DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
//  $select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu, kategori_menu FROM tb_kategori_menu");

?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Order
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaltambahorder"> Tambah Order </button>
            </div>
        </div>
        <!-- Modal tambah order -->
        <div class="modal fade" id="modaltambahorder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form class="needs-validation" novalidate action="proses/proses_input_order.php" 
                        method="POST">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="kode_order" name="kode_order" value="<?php echo date('ymdHi').rand(100, 999)  ?>" readonly>
                                        <label for="kode_order">Koder Order</label>
                                        <div class="invalid-feedback">
                                            Masukan Kode Order
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="meja" placeholder="Nomor Meja" name="meja" required>
                                        <label for="meja">Meja</label>
                                        <div class="invalid-feedback">
                                            Masukan Nomor Meja
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="pelanggan" placeholder="Nama pelanggan" name="pelanggan" required>
                                        <label for="pelanggan">Nama Pelanggan</label>
                                        <div class="invalid-feedback">
                                            Masukan Nama Pelanggan
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="input_order_validate" value="12345">Buat Order</button>
                            </div>

                        </form>

                    </div>
                    

                </div>
            </div>
        </div>
        <!-- end modal tambah order -->

        <?php
        if (empty($result)) {
            echo "data menu Empty";
        } else {

            foreach ($result as $row) {
        ?>

                <!-- Modal edit -->
                <div class="modal fade" id="modaledit<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">edit Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_edit_order.php" 
                        method="POST">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input readonly type="text" class="form-control" id="kode_order" name="kode_order" value="<?php echo $row['id_order']  ?>" readonly>
                                        <label for="kode_order">Koder Order</label>
                                        <div class="invalid-feedback">
                                            Masukan Kode Order
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="meja" placeholder="Nomor Meja" name="meja" required value="<?php echo $row['meja']  ?>">
                                        <label for="meja">Meja</label>
                                        <div class="invalid-feedback">
                                            Masukan Nomor Meja
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="pelanggan" placeholder="Nama pelanggan" name="pelanggan" required value="<?php echo $row['pelanggan']  ?>">
                                        <label for="pelanggan">Nama Pelanggan</label>
                                        <div class="invalid-feedback">
                                            Masukan Nama Pelanggan
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="edit_order_validate" value="12345">Simpan</button>
                            </div>

                        </form>   

                            </div>

                        </div>
                    </div>
                </div>
                <!-- end edit action -->

                <!-- Modal delete -->
                <div class="modal fade" id="modaldelete<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_order.php" method="POST">

                                    <input type="hidden" value="<?php echo $row['id_order'] ?>" name="kode_order">
                                    <div class="col-lg-12">
                                        Hapus Order atas <b> <?php echo $row['pelanggan'] ?></b> 
                                        dengan kode Order <b> <?php echo $row['id_order'] ?></b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete_order_validate" value="12345">Delete</button>
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
                            <th scope="col">Kode Order</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Meja</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Pelayan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Waktu Order</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($result as $row) {
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $no++ ?></th>
                                <td><?php echo $row['id_order'] ?> 
                            </td>
                                <td><?php echo $row['pelanggan'] ?> </td>
                                <td><?php echo $row['meja'] ?> </td>
                                <td><?php echo number_format((int)$row['harganya'], 0, ',', '.') ?></td>
                                <td><?php echo $row['Nama'] ?> </td>
                                <td>
                                    <?php echo (!empty($row['id_bayar']))? "<span class='badge text-bg-success'>Dibayar</span>" : "" ?>
                                
                                </td>
                                <td><?php echo $row['waktu_order'] ?> </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-success btn-sm me-1" 
                                        href="./?x=orderitem&order=<?php echo $row['id_order']."&meja=".$row['meja']."&pelanggan=".$row['pelanggan'] ?>"><i class="bi bi-cart-plus"></i></i></i></a>

                                        <button class="<?php  echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled btn-sm me-1" : "btn btn-warning btn-sm me-1"; ?> "><i class="bi bi-pencil-fill" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id_order'] ?>"></i></i> </button>
                                        <button class="<?php  echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled btn-sm me-1" : "btn btn-danger btn-sm"; ?>"><i class="bi bi-trash-fill" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $row['id_order'] ?>"></i></i> </button>
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