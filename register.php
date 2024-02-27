<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="admin/css/bootstrap.css">
    <style>
        .foto-user-profile {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-9 bg-light py-3">
                <h5 class="display-6 fw-bold text-center">Register</h5>
                <form action="admin/proses_register.php" method="post" enctype="multipart/form-data">
                    <label for="inputFoto" style="display: block;" class="mb-3">
                        <img src="admin/default/user.png" alt="" class="foto-user-profile" id="imgFoto">
                    </label>
                    <input type="file" name="FotoUser" id="inputFoto" class="form-control" hidden >
                    <label for="Username">Username</label>
                    <input type="text" class="form-control mb-2" id="Username" name="Username" placeholder="klik dan ketik disini..." >
                    <label for="Password">Password</label>
                    <input type="password" class="form-control mb-2" id="Password" name="Password" placeholder="klik dan ketik disini..." >
                    <label for="Email">Email</label>
                    <input type="email" class="form-control mb-2" id="Email" name="Email" placeholder="klik dan ketik disini..." >
                    <label for="NamaLengkap">Nama Lengkap</label>
                    <input type="text" class="form-control mb-2" id="NamaLengkap" name="NamaLengkap" placeholder="klik dan ketik disini..." >
                    <label for="Alamat">Alamat</label>
                    <textarea name="Alamat" class="form-control mb-2" id="Alamat" cols="30" rows="5" placeholder="klik dan ketik disini..." ></textarea>
                    <input type="submit" value="Register" class="btn btn-success">
                    <button type="reset" class="btn btn-danger">Hapus</button>
                    <a href="index.php" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="admin/js/image.js"></script>
<script src="admin/js/bootstrap.js"></script>
</html>