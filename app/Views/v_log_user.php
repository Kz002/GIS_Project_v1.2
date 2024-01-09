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
                        <th>No. Hp</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; 
                    foreach ($user as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_user'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $value['level'] ?></td>
                            <td><img src="<?= base_url('foto_user/'.$value['foto_user']) ?>" width="150px"></td>
                            <td>
                                <!-- <a href="?= base_url('User/editUser/'.$value['id_user']) ?>" class="btn btn-warning">Edit</a> -->
                                <a href="<?= base_url('User/deleteUser/'.$value['id_user']) ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus Akun User ??')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>