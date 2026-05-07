<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dymIPrG1njK1jR6O+Vf8drSbf/9u7L0dU8ObZLAGHtCvdBqJrYVbfjVml1P8NQ6U8NRYNQfJzz7Zx8x2QdB4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- AdminLTE -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Bootstrap 4 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

	<!-- AdminLTE App -->
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Sign in</p>

				<?php if (isset($error)): ?>
					<div class="alert alert-danger"><?= $error ?></div>
				<?php endif; ?>
				
				

				<form method="post">
					<?= csrf_field(); ?>
					<div class="input-group mb-3">
						<input type="text" name="username" class="form-control" placeholder="Username" required>
						<div class="input-group-append">
							<div class="input-group-text"><span class="fas fa-user"></span></div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="password" class="form-control" placeholder="Password" required>
						<div class="input-group-append">
							<div class="input-group-text"><span class="fas fa-lock"></span></div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Login</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
