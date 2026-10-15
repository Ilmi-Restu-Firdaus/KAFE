<?php
include "proses/connect.php";


$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_order
    LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
    LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
    GROUP BY id_list_order
    HAVING tb_list_order.kode_order = $_GET[order]");



$kode = $_GET['order'];
$meja = $_GET['meja'];
$pelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    // $kode = $record['id_order'];
    // $meja = $record['meja'];
    // $pelanggan = $record['pelanggan'];
}
$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_daftar_menu");

?>


<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Order Item
        </div>
        <div class="card-body">
            <a href="order" class="btn btn-warning mb-3"><i class="bi bi-arrow-left-circle-fill"></i></a>

            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kodeorder" value="<?php echo $kode; ?>">
                        <label for="uploadfoto">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control " id="meja" value="<?php echo $meja; ?>">
                        <label for="uploadfoto">Meja</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control " id="pelanggan" value="<?php echo $pelanggan; ?>">
                        <label for="uploadfoto">Pelanggan</label>
                    </div>
                </div>
            </div>

            <!-- Modal ADD item -->
            <div class="modal fade" id="tambahitem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_orderitem.php" method="POST">
                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="menu" id="">
                                                <option selected hidden value="">pilih menu</option>
                                                <?php
                                                foreach ($select_menu as $value) {
                                                    echo "<option value=$value[id]>$value[nama_menu] </option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="menu">Menu</label>
                                            <div class="invalid-feedback">
                                                Pilih menu
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="jumlah porsi" name="jumlah" required>
                                            <label for="floatingInput">jumlah</label>
                                            <div class="invalid-feedback">
                                                masukan jumlah.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="catatan" placeholder="catatan" name="catatan">
                                            <label for="floatingInput">catatan</label>
                                            <div class="invalid-feedback">
                                                Masukan catatan
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_orderitem_validate" value="12345">Save changes</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- end modal add item -->

            <?php
            if (empty($result)) {
                echo "data menu Empty";
            } else {

                foreach ($result as $row) {
            ?>


                    <!-- Modal edit -->
                    <div class="modal fade" id="modaledit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">edit Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_orderitem.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">

                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="menu" id="">
                                                        <option selected hidden value="">pilih menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $row['id']) {
                                                                echo "<option selected value=$value[id]>$value[nama_menu] </option>";
                                                            } else {
                                                                echo "<option value=$value[id]>$value[nama_menu] </option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="menu">Menu</label>
                                                    <div class="invalid-feedback">
                                                        Pilih menu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="jumlah porsi" name="jumlah" required value="<?php
                                                                                                                                                                            echo $row['jumlah']  ?>">
                                                    <label for="floatingInput">jumlah</label>
                                                    <div class="invalid-feedback">
                                                        masukan jumlah.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="catatan" placeholder="catatan" name="catatan" value="<?php
                                                                                                                                                        echo $row['catatan']  ?>">
                                                    <label for="floatingInput">catatan</label>
                                                    <div class="invalid-feedback">
                                                        Masukan catatan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit_orderitem_validate" value="12345">Save changes</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end edit action -->

                    <!-- Modal delete -->
                    <div class="modal fade" id="modaldelete<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_delete_orderitem.php" method="POST">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">

                                        <div class="col-lg-12">
                                            Hapus menu <b> <?php echo $row['nama_menu'] ?></b> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete_orderitem_validate" value="12345">Delete</button>
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

                <!-- Modal BAYAR item -->
                <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="nowrap">
                                                <th scope="col">Menu</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Catatan</th>
                                                <th scope="col">Total</th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            foreach ($result as $row) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['nama_menu'] ?> </td>
                                                    <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                                                    <td><?php echo $row['jumlah'] ?> </td>
                                                    <td><?php echo $row['catatan'] ?> </td>
                                                    <td><?php echo number_format($row['harganya'], 0, ',', '.') ?></td>
                                                   
                                                </tr>
                                            <?php
                                                $total += $row['harganya'];
                                            }
                                            ?>

                                            <tr>
                                                <td colspan="4" class="fw-bold">
                                                    Total Harga
                                                </td>
                                                <td class="fw-bold">
                                                    <?php echo number_format($total, 0, ',', '.') ?>

                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <span class="text-danger fs-9 fw-semibold"> Lakukan Pembayaran?</span>
                                <form class="needs-validation" novalidate action="proses/proses_bayar.php" method="POST">
                                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                    <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                    <input type="hidden" name="total" value="<?php echo $total ?>">

                                    <div class="row">
                                        
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="nominal_uang" name="uang" required>
                                                <label for="floatingInput">Nominal uang</label>
                                                <div class="invalid-feedback">
                                                    Masukan Nominal Uang.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="bayar_validate" value="12345">Bayar</button>
                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- end modal BAYAR item -->

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="nowrap">
                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['nama_menu'] ?> </td>
                                    <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td><?php echo $row['jumlah'] ?> </td>
                                    <td><?php echo $row['catatan'] ?> </td>
                                    <td><?php echo number_format($row['harganya'], 0, ',', '.') ?></td>
                                    <td>
                                        <div class="d-flex">


                                            <button class="<?php  echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled btn-sm me-1" : "btn btn-warning btn-sm me-1"; ?> "><i class="bi bi-pencil-fill" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id_list_order'] ?>"></i></i> </button>
                                            <button class="<?php  echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled btn-sm me-1" : "btn btn-danger btn-sm"; ?>"><i class="bi bi-trash-fill" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $row['id_list_order'] ?>"></i></i> </button>

                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $total += $row['harganya'];
                            }
                            ?>

                            <tr>
                                <td colspan="4" class="fw-bold">
                                    Total Harga
                                </td>
                                <td class="fw-bold">
                                    <?php echo number_format($total, 0, ',', '.') ?>

                                </td>

                            </tr>
                        </tbody>
                    </table>

                </div>
            <?php
            }
            ?>
            <div>
                <button class="<?php  echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-warning"; ?>" data-bs-toggle="modal" data-bs-target="#tambahitem"><i class="bi bi-plus-circle"></i> Tambah Item</button>
                <button class="<?php  echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-success"; ?>" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash"></i> Bayar</button>
            </div>
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