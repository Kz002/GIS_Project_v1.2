<!DOCTYPE html>
<html>
<head>
<style>
        /* Ganti tampilan saat dicetak */
        @media print {
            /* Sembunyikan tombol cetak saat dicetak */
            button {
                display: none;
            }
            /* Sembunyikan atau sesuaikan elemen-elemen lain yang tidak ingin dicetak */
            header, footer, .delete-btn {
                display: none;
            }
            /* Atur tampilan tabel saat dicetak */
            table {
                width: 100%;
                border-collapse: collapse;
            }
            td {
                padding: 8px;
            }
        }
        /* Atur gaya untuk header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <title>Tombol Cetak Laporan</title>
</head>
<body>

    <!-- Isi dari halaman web Anda -->

    <!-- Tombol untuk mencetak laporan -->
    <button onclick="cetakLaporan()">Cetak Laporan</button>

    <!-- JavaScript untuk melakukan pencetakan -->
    <script>
        function cetakLaporan() {
            window.print(); // Memicu fungsi pencetakan bawaan browser
        }
    </script>

</body>
</html>

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