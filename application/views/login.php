<?php
    defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>

	<!-- bootstrap 5 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta2/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?= base_url('assets/')?>login.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Login Form</h2>


        <div class="card my-5">


				<!-- untuk actionnya submit formnya ke controller login -->
          <form class="card-body cardbody-color p-lg-5" action="<?= site_url('login/do_login')?>" method="post">
						<?php
							if ($this->session->flashdata() != null) {
									$statusCode = $this->session->flashdata('code');
									$message = $this->session->flashdata('message');
									dismissableAlert($statusCode, $message);
							}
						?>
            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2017/07/18/23/23/user-2517433_1280.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>

            <div class="mb-3">
              <input type="email" class="form-control" id="Email" aria-describedby="emailHelp"
                placeholder="Email" name="email" required>
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" id="password" placeholder="password" required>
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 w-100">Login</button></div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

</body>
</html>

<?php

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
