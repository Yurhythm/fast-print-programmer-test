<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title><?= $title ?></title>
	<link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
	<script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/simple-datatables.min.js') ?>"></script>
</head>

<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<!-- Navbar Brand-->
		<a class="navbar-brand ps-3" href="index.html">Fast Print</a>
		<!-- Sidebar Toggle-->
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
	</nav>
	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
				<div class="sb-sidenav-menu">
					<div class="nav">
						<a class="nav-link" href="<?= base_url('/') ?>">
							<div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
							Home
						</a>
						<a class="nav-link" href="<?= base_url('/product') ?>">
							<div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
							Produk
						</a>
					</div>
				</div>
			</nav>
		</div>
		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid px-4">
