<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xr0+fK+6o0e6Z+LA8dCNk56Yt0Ic/v4ROB4BqK7Z8rYK1S9XNT7d/bt5vppaGlmYoOP5Zd58k3aB4e5CX5T6jQ==" crossorigin="anonymous" />

    <style>
        /* Ganti tampilan saat dicetak */
        @media print {
            /* Sembunyikan tombol cetak saat dicetak */
            button {
                display: none;
            }
            /* Sembunyikan atau sesuaikan elemen-elemen lain yang tidak ingin dicetak */
            header, footer, .delete-btn, .dataTables_info, .dataTables_paginate {
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
            /* Atur gaya untuk header saat dicetak */
            .header {
                text-align: center;
                margin-bottom: 20px;
                font-size: 24px; /* Sesuaikan ukuran font sesuai kebutuhan */
                border-bottom: 1px solid black; /* Tambahkan garis bawah */
            }
            /* Sembunyikan kolom aksi saat mencetak */
            .print-only {
                display: none;
            }
            /* Sembunyikan informasi jumlah entri saat mencetak */
            .dataTables_info {
                display: none;
            }
            /* Sembunyikan navigasi halaman saat mencetak */
            .dataTables_paginate {
                display: none;
            }
        }
    </style>
    <title>Tombol Cetak Laporan</title>
</head>
<body>

    <!-- Isi dari halaman web Anda -->

    <!-- Tombol untuk mencetak laporan -->
    <button onclick="cetakLaporan()"><i class="fas fa-print"></i> Cetak Laporan</button>

    <!-- JavaScript untuk melakukan pencetakan -->
    <script>
        function cetakLaporan() {
            // Sembunyikan tombol cetak sebelum mencetak
            document.querySelector('button').style.display = 'none';
            // Sembunyikan kolom aksi saat mencetak
            var printOnlyElements = document.querySelectorAll('.print-only');
            printOnlyElements.forEach(function(element) {
                element.style.display = 'none';
            });
            // Memicu fungsi pencetakan bawaan browser
            window.print();
            // Tampilkan kembali tombol cetak setelah mencetak (opsional)
            document.querySelector('button').style.display = 'block';
            // Tampilkan kembali kolom aksi setelah mencetak
            printOnlyElements.forEach(function(element) {
                element.style.display = 'table-cell';
            });
        }
    </script>

    <!-- Header untuk laporan -->
    <div class="header">
        <strong>KERUPUK JANGEK KULIT ASLI SAPI <br>MAHKOTA KERUPUK</strong><br><br>-Laporan Data Log Distribusi-
    </div>

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
                            <th class="print-only">Aksi</th>
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
                                <td class="print-only"><a href="<?= base_url('LogUser/deleteLog/'.$value['id_log']) ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus Log ??')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
