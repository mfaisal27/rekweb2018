<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/mdb.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/sweetalert2.css') ?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style>

		#table tr th, tr td {
			text-align: center;
			font-weight: bold;
		}

	</style>
</head>
<body class="fixed-sn mdb-skin  blue-grey lighten-4">
<div class="container-fluid">
	<header>
		<!-- Sidebar navigation -->
		<ul id="slide-out" class="side-nav fixed sn-bg-4 custom-scrollbar">
			<!-- Logo -->
			<li class="social">
				<div class="logo-wrapper waves-light">
					<a href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png"
									 class="img-fluid flex-center"></a>
				</div>
			</li>
			<br>
			<li>
				<ul class="collapsible collapsible-accordion">
					<li><a href="<?php echo base_url('buku/index') ?>"><i class="fa fa-dashboard"></i>
							Dashboard<i class="fa fa-angle-down rotate-icon"></i></a>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i>Menu Buku<i
								class="fa fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								</li>
								<li><a href="<?php echo base_url('buku/add') ?>" class="waves-effect"><span class="fa fa-plus"></span> Tambah Data
										Buku</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-hand-pointer-o"></i> Menu
							Kategori<i class="fa fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="<?php echo base_url('index.php/kategori/index') ?>"
									   class="waves-effect"><span class="fa fa-plus"></span>Daftar Kategori</a>
								</li>
								<li><a href="<?php echo base_url('index.php/kategori/add') ?>"
									   class="waves-effect"><span class="fa fa-plus"></span>Tambah Kategori</a>
								</li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-eye"></i> Menu Penerbit<i
								class="fa fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="<?php echo base_url('index.php/penerbit/index') ?>" class="waves-effect"><span
											class="fa fa-plus"></span>Daftar Penerbit</a>
								</li>
								<li><a href="<?php echo base_url('index.php/penerbit/add') ?>" class="waves-effect"><span
											class="fa fa-plus"></span>Tambah Penerbit</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<!--/. Side navigation links -->
			<div class="sidenav-bg mask-strong "></div>
		</ul>
		<!--/. Sidebar navigation -->
		<!-- Navbar -->
		<nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav  blue darken-3">
			<!-- SideNav slide-out button -->
			<div class="float-left">
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
			</div>
			<!-- Breadcrumb-->
			<div class="breadcrumb-dn mr-auto">
				<p>Daftar Buku di Indonesia</p>
			</div>
		</nav>
		<!-- /.Navbar -->
	</header>
</div>
<!--Top Table UI-->
<div class="container-fluid" style="margin-top: 100px">
	<?php echo $this->session->flashdata('pesan') ?>
	<div class="card card-cascade narrower">
		<!--Card image-->
		<div class="view gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
			<div class="white-text mx-3">Tabel Penerbit Buku</div>
		</div>
		<div class="px-5">

			<div class="table-wrapper">
				<!--Table-->
				<table class="table table-hover table-responsive mb-0" id="table">

					<!--Table head-->
					<thead>
					<tr>
						<th>No</th>
						<th>Nama Penerbit</th>
						<th>Aksi</th>
					</tr>
					</thead>
					<!--Table head-->

					<!--Table body-->
					<tbody>
					<?php $i = 1; ?>
						<?php foreach ($penerbit as $key): ?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $key->nama_penerbit; ?></td>
								<td style="top: -20px; position: relative"><a href="<?= site_url('penerbit/edit/' . $key->id_penerbit) ?>">
										<button type="button" class="btn-floating blue-gradient"><i class="fa fa-edit"></i></button>
									</a> | <a href="<?= site_url('penerbit/delete/' . $key->id_penerbit) ?>" onclick="return confirm('Apakah ingin menghapus data ini ?')">
										<button type="button" class="btn-floating red accent-4"><i class="fa fa-trash" style="margin-left: -2px; margin-top: -3px;"></i></button>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
					<!--Table body-->
				</table>
				<!--Table-->
				<div class="row">
					<div class="col">
						<!--Tampilkan pagination-->
						<?php echo $pagination; ?>
					</div>
				</div>
			</div>
			<hr class="my-0">
		</div>
	</div>
</div>

<!--Footer-->
<footer class="page-footer center-on-small-only blue darken-3" style="margin-top: 80px">
	<!--Social buttons-->
	<div class="social-section text-center">
		<ul>
			<li><a class="btn-floating btn-fb"><i class="fa fa-facebook"> </i></a></li>
			<li><a class="btn-floating btn-tw"><i class="fa fa-twitter"> </i></a></li>
			<li><a class="btn-floating btn-gplus"><i class="fa fa-google-plus"> </i></a></li>
			<li><a class="btn-floating btn-li"><i class="fa fa-linkedin"> </i></a></li>
			<li><a class="btn-floating btn-git"><i class="fa fa-github"> </i></a></li>
		</ul>
	</div>
	<!--/.Social buttons-->

	<!--Copyright-->
	<div class="footer-copyright">
		<div class="container-fluid">
			© 2018 Copyright: Rekayasa Web Teknik Informatika Unpas
		</div>
	</div>
	<!--/.Copyright-->

</footer>
<!--/.Footer-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/mdb.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/script.js') ?>"></script>
<script src="<?php echo base_url('assets/dist/sweetalert2.min.js') ?>"></script>
<script>
	$(function () {

		// We can attach the `fileselect` event to all file inputs on the page
		$(document).on('change', ':file', function () {
			var input = $(this),
				numFiles = input.get(0).files ? input.get(0).files.length : 1,
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
		});

		// We can watch for our custom `fileselect` event like this
		$(document).ready(function () {
			$(':file').on('fileselect', function (event, numFiles, label) {

				var input = $(this).parents('.input-group').find(':text'),
					log = numFiles > 1 ? numFiles + ' files selected' : label;

				if (input.length) {
					input.val(log);
				} else {
					if (log) alert(log);
				}

			});
		});

	});
</script>
<script>
	$(".button-collapse").sideNav();
	new WOW().init();
</script>
<script>
	$(document).ready(function () {
		$('.mdb-select').material_select();
	});
</script>
</body>
</html>

