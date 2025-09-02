<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?= isset($title) ? $title : "Admin Panel" ?></title>

	<!-- Font Awesome + AdminLTE via CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dymIPrG1njK1jR6O+Vf8drSbf/9u7L0dU8ObZLAGHtCvdBqJrYVbfjVml1P8NQ6U8NRYNQfJzz7Zx8x2QdB4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
				</li>
			</ul>
		</nav>

		<!-- Sidebar -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<a href="#" class="brand-link">
				<span class="brand-text font-weight-light">My Admin</span>
			</a>
			<div class="sidebar">
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column">
						<li class="nav-item">
							<a href="<?= site_url('dashboard') ?>" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?= site_url('products') ?>" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Products</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?= site_url('change-password') ?>" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Change Password</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('logout') ?>" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Logout</p>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</aside>

		<!-- Content Wrapper -->
		<div class="content-wrapper p-3">
			<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success">
					<?= $this->session->flashdata('success'); ?>
				</div>
			<?php endif; ?>

			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-danger">
					<?= $this->session->flashdata('error'); ?>
				</div>
			<?php endif; ?>

			<?php $this->load->view($view, isset($data) ? $data : []); ?>
		</div>

		<!-- Footer -->
		<footer class="main-footer text-center">
			<strong>Copyright &copy; <?= date('Y') ?> My Admin.</strong> All rights reserved.
		</footer>

	</div>

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>