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
					<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i>Menu
							Buku<i
								class="fa fa-angle-down rotate-icon"></i></a>
						<div class="collapsible-body">
							<ul>
								</li>
								<li><a href="<?php echo base_url('buku/add') ?>" class="waves-effect"><span
											class="fa fa-plus"></span> Tambah Data
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

<main>
	<div class="container-fluid" style="margin-top: 64px">
		<!--Card-->
		<div class="card card-cascade narrower">
			<div
				class="view gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
				<div class="white-text mx-3">Insert Data Buku</div>
			</div>
			<!--Card content-->
			<div class="card-body  wow fadeIn" data-wow-delay="0.2s">
				<form action="<?php echo site_url('buku/update') ?>" method="post" class="form-inline"
					  style="margin: auto;" enctype="multipart/form-data">
					<input type="hidden" name="id_buku" value="<?= $buku->id_buku ?>">
					<div class="md-form form-group">
						<label for="form7">Judul Buku</label>
						<input type="text" id="form7" name="judul" value="<?= $buku->judul_buku ?>"
							   class="form-control">
					</div>

					<div class="md-form form-group">
						<label for="form9">Penulis</label>
						<input type="text" id="form9" name="penulis" value="<?= $buku->penulis ?>" class="form-control">
					</div>

					<div class="md-form form-group">
						<label for="form8">ISBN</label>
						<input type="number" id="form8" name="isbn" value="<?= $buku->isbn ?>" class="form-control">
					</div>

					<div class="md-form form-group">
						<label for="date-picker-example form11">Tahun Terbit</label>
						<input type="text" name="tahun" value="<?= $buku->tahun_terbit ?>" id="date-picker-example"
							   class="form-control datepicker">
					</div>

					<div class="md-form form-group">
						<select class="mdb-select colorful-select dropdown-primary" name="penerbit" id="penerbit">
							<option value="" disabled>-- Pilih Penerbit --</option>
							<?php foreach ($penerbit as $row): ?>
								<?php if ($row->nama_penerbit == $buku->penerbit) : ?>
									<option value="<?php echo $row->id_penerbit ?>"
											selected><?php echo $row->nama_penerbit ?></option>
								<?php else : ?>
									<option value="<?php echo $row->id_penerbit ?>"><?php echo $row->nama_penerbit ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="md-form form-group">
						<select class="mdb-select colorful-select dropdown-primary" name="kategori" id="merk">
							<option value="" disabled>-- Pilih Kategori --</option>
							<?php foreach ($kategori as $row): ?>
								<?php if ($row->nama_kategori == $buku->kategori) : ?>
									<option value="<?php echo $row->id_kategori ?>"
											selected><?php echo $row->nama_kategori ?></option>
								<?php else : ?>
									<option value="<?php echo $row->id_kategori ?>"><?php echo $row->nama_kategori ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="file-field">
						<div class="btn btn-primary btn-sm">
							<span>Choose files</span>
							<input type="file" multiple="" name="filefoto">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Upload one or more files"
								   readonly="">
						</div>
					</div>

					<div class="md-form form-group">
						<button type="submit" class="btn btn-info mb-2">Submit <i class="fa fa-send ml-1"></i></button>
					</div>

				</form>

			</div>
		</div>
	</div>
</main>
</div>
<!--Footer-->
<footer class="page-footer center-on-small-only blue darken-3" style="margin-top: 175px">
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

	$('.datepicker').pickadate({
		// Escape any “rule” characters with an exclamation mark (!).
		format: 'yyyy-mm-dd',
		formatSubmit: 'yyyy/mm/dd',
		hiddenPrefix: 'prefix__',
		hiddenSuffix: '__suffix'
	})
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
