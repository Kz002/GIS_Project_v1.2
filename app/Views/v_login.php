<!DOCTYPE html>
<html lang="en" >
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GIS | Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url('sb-admin-2/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url('sb-admin-2/')?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-image: url(<?= base_url('images/bg.jpg')  ?>)">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block" style="background-image: url(https://images.squarespace-cdn.com/content/v1/55223b6ee4b098a11a898a5a/1435180067240-WKD5IXSRC26BOITN9ADJ/Gis-what+we+do.jpg?format=2500w)"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login ke Web GIS</h1>
                            </div>

                            <div class="class register-box-body">
                                <?php
                                //pesan validasi error
                                $errors=session()->getFlashdata('errors');
                                if (!empty($errors)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <?php foreach ($errors as $errors) : ?>
                                            <li><?= esc($errors) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                                <?php } ?> 
                                <?php
                                if (session()->getFlashdata('pesan')) {
                                    echo '<div class="alert alert-success" role="alert">';
                                    echo session()->getFlashdata('pesan');
                                    echo '</div>';
                                }
                                ?>                               
                            </div>

                            <?php
                            echo form_open('Auth/cek_login')
                            ?>
                                <!-- <div class="form-group">
                                        <input name="nama_user" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Nama User">
                                </div> -->
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                                </div>
                                <!-- <div class="form-group">
                                    <input name="no_hp" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="No Handphone">
                                </div> -->
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                    <!-- <div class="col-sm-6">
                                        <input type="password" name="repassword" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div> -->
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login Account
                                </button>
                                <hr>
                            <?php echo form_close() ?>
                            <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> -->
                            <div class="text-center">
                                <a class="small" href="<?=base_url('Auth/register')?>">Belum Punya Akun? Register!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url('sb-admin-2/')?>vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url('sb-admin-2/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url('sb-admin-2/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url('sb-admin-2/')?>js/sb-admin-2.min.js"></script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500,0).slideUp(500,function() {
                $(this).remove();
            });
        }, 3000);
    </script>

</body>

</html>