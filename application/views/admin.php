<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>

	<!-- bootstrap 5 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta2/css/bootstrap.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta2/js/bootstrap.min.js"></script>
</head>
<body>
	<main>
	<div class="container py-4">
		<header class="pb-3 mb-4 border-bottom">
		<a href="/" class="d-flex align-items-center text-dark text-decoration-none">
			<span class="fs-2">My Profile</span>

		</a>
		</header>

		<div class="p-5 mb-4 bg-light rounded-3">
		<div class="container-fluid py-5">
			<?php
				// ini untuk pesannya ambil dari flashdata
				if ($this->session->flashdata() != null) {
						$statusCode = $this->session->flashdata('code');
						$message = $this->session->flashdata('message');
						dismissableAlert($statusCode, $message);
				}
			?>
			<div class="row">
				<div class="col-md-2">
					<img src="https://cdn.pixabay.com/photo/2017/07/18/23/23/user-2517433_1280.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
				</div>
				<div class="col-md-6">

				<!-- menampilkan session -->
					<h1 class="display-6 fw-bold"><?= $user['name']?></h1>
					Username : <?= $user['username']?> <br>
					Email : <?= $user['email']?> <br>
					Level : <span class="badge <?= ($user['level'] == 'admin') ? 'bg-primary text-bg-primary' : 'bg-warning text-bg-warning' ?>"><?= $user['level']?></span>
					<br> <br>

					<!-- tombol ini akan menuju controller login dengan function logout -->
					<!-- melakukan logout akun -->
					<a href="<?= site_url('login/logout')?>" class="btn btn-outline-danger btn-lg">Logout</a>
				</div>
	
			</div>
		</div>
		</div>
	</div>
	</main>
</body>
</html>

<?php


// function ini untuk menampilkan pesan sukses,error,informasi
// kemudian untuk color dari pesan popup ini ditentukan berdasarkan statusCode
function dismissableAlert($statusCode, $message)
{
    if ($statusCode == 200) {
        echo "
		<div class='alert alert-success alert-dismissible fade show' role='alert'>
			".$message."
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>

		</div>
		";
    } elseif ($statusCode == 500) {
        echo "
		<div class='alert alert-danger alert-dismissible fade show' role='alert'>
			".$message."
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
		";
    } else {
        echo "
		<div class='alert alert-primary alert-dismissible fade show' role='alert'>
			".$message."
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
		";
    }
}
?>
