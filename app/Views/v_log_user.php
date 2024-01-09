<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
        <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success" role="alert">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
        ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Alamat</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; 
                    foreach ($log as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_user'] ?></td>
                            <td><?= $value['latitude'] ?></td>
                            <td><?= $value['longitude'] ?></td>
                            <td><?= $value['alamat'] ?></td>
                            <td><?= $value['tgl_log'] ?></td>
                                <!-- <a href="?= base_url('User/editUser/'.$value['id_user']) ?>" class="btn btn-warning">Edit</a> -->
                                <td><a href="<?= base_url('LogUser/deleteLog/'.$value['id_log']) ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus Log ??')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>