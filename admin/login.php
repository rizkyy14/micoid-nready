<?php
    // session start();
    if(!empty($_SESSION)){ }else{ session_start(); }
?>
<!doctype html>
<html>
    <head>
        <title>Crud - Data Barang</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="assets/fonts/css/all.min.css">
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/jquery/jquery.min.js"></script>
        <style>
            .centera {
                height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body style="background:#586df5;">
    <div class="centera">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <br/><br/>
                    <div id="logout">
                        <?php if(isset($_GET['signout'])){?>
                            <div class="alert alert-success">
                                <small>Anda Berhasil Logout</small>
                            </div>
                        <?php }?>
                    </div>
                    <div id="notifikasi">
                        <div class="alert alert-danger">
                            <small>Login Anda Gagal, Periksa Kembali Username dan Password</small>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="card-title">Login Page</h4>
                        </div>
                        <div class="card-body">
                            <!-- form berfungsi mengirimkan data input 
                            dengan method post ke proses login dengan paramater get aksi login -->
                            <form method="post" action="proses/crud.php?aksi=login" id="formlogin">
                            <div class="form-group mb-3">
                                <label>Your username</label>
                                <input name="user" class="form-control" placeholder="user" type="text" required="required" autocomplete="off">
                            </div> <!-- form-group// -->
                            <div class="form-group mb-3">
                                <label>Your password</label>
                                <input name="pass" class="form-control" placeholder="******" type="password" required="required" autocomplete="off">
                            </div> <!-- form-group// --> 
                            <div class="form-group">
                                <button type="submit" name="proses_login" class="btn btn-primary btn-block"> Login  </button>
                            </div> <!-- form-group// -->                                                           
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                </div>
            </div> 
        </div>
    </div>
    <script>
      // notifikasi gagal di hide
      <?php if(empty($_GET['get'])){?>
        $("#notifikasi").hide();
      <?php }?>
        var logingagal = function(){
            $("#logout").fadeOut('slow');
            $("#notifikasi").fadeOut('slow');
        };
        setTimeout(logingagal, 4000);
    </script> 
    </body>
</html>