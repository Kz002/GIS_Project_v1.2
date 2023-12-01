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
                        <th>Nama Lokasi</th>
                        <th>Alamat Lokasi</th>
                        <th>Coordinat</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; 
                    foreach ($lokasi as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_lokasi'] ?></td>
                            <td><?= $value['alamat_lokasi'] ?></td>
                            <td><?= $value['latitude'] ?>,<?= $value['longitude'] ?></td>
                            <td><img src="<?= base_url('foto/'.$value['foto_lokasi']) ?>" width="200px"></td>
                            <td>
                                <a href="<?= base_url('Lokasi/editLokasi/'.$value['id_lokasi']) ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url('Lokasi/deleteLokasi/'.$value['id_lokasi']) ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus Data ??')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>