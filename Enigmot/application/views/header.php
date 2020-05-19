<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="<?php echo base_url('assets/img/favicon.png');?>" type="image/png">
	<title>ENIGMOTS</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-multiselect.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/select-checkbox.css');?>">
	<?php if (isset($cssFile) && $cssFile !== "") { ?><link rel="stylesheet" href="<?php echo base_url($cssFile);?>"><?php } ?>
	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/linericon/style.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/owl-carousel/owl.carousel.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/magnific-popup.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/nice-select/css/nice-select.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/animate-css/animate.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/flaticon/flaticon.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/dataTables.bootstrap.css');?>">
	<!-- main css -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">


</head>

<body>
	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div>
						<a class="navbar-brand logo_h"  href="<?php echo base_url('');?>"><img src="<?php echo base_url('assets/img/logo.png');?>" class="Mon_logo" alt=""></a>
						<br><?php if (isset($_SESSION['user'])) { ?>
							<p style="margin-left: 4px; color: rgb(255, 188, 0); font-weight: bold;">
								Crédits &nbsp;: &nbsp;<credit style="color: white;"><?php echo $_SESSION['user']['credit'] ?></credit> &nbsp;&nbsp;/ 
								&nbsp;&nbsp;Points &nbsp;: &nbsp;<point style="color: white;"><?php echo $_SESSION['user']['point'] ?></point>
							</p>
						<?php } ?>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav justify-content-center">
							<li class="nav-item <?php if (isset($flagActif) && $flagActif === "home") {echo "active";} ?>"><a class="nav-link" href="<?php echo base_url('');?>">Acceuil</a></li>
							<li class="nav-item submenu dropdown <?php if (isset($flagActif) && $flagActif === "jouer") {echo "active";} ?>">
							<a style="cursor: pointer;" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
									aria-expanded="false">Jouer</a>								<ul style="min-width: 206px;" class="dropdown-menu">
									<li class="nav-item <?php if (isset($flagActif) && $flagActif === "creer") {echo "active";} ?>"><a class="nav-link" href="<?php echo base_url('index.php/jouer');?>">Version ambigus</a>
									<li class="nav-item <?php if (isset($flagActif) && $flagActif === "creer") {echo "active";} ?>"><a class="nav-link" href="<?php echo base_url('index.php/jouer/rattachement');?>">Version rattachement</a>
								</ul>
							</li>
							<?php if (isset($_SESSION['user'])) { ?>
								<li class="nav-item submenu dropdown <?php if (isset($flagActif) && $flagActif === "creer") {echo "active";} ?>">
									<a style="cursor: pointer;" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
									aria-expanded="false">Créer</a>
									<ul style="min-width: 206px;" class="dropdown-menu">
										<li class="nav-item <?php if (isset($flagActif) && $flagActif === "creer") {echo "active";} ?>"><a class="nav-link" href="<?php echo base_url('index.php/create');?>">Version ambigus</a>
										<li class="nav-item <?php if (isset($flagActif) && $flagActif === "creer") {echo "active";} ?>"><a class="nav-link" href="<?php echo base_url('index.php/creation_rattachement');?>">Version rattachement</a>
									</ul>
								</li>
							<?php } ?>
							<li class="nav-item submenu dropdown <?php if (isset($flagActif) && $flagActif === "classement") {echo "active";} ?>">
								<a style="cursor: pointer;" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Classement</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="<?php echo base_url('index.php/ClassementJ');?>">Joueurs</a>
									<?php if (isset($_SESSION['user'])) { ?>
										<li class="nav-item"><a class="nav-link" href="<?php echo base_url('index.php/classement-phrase');?>">Phrases</a>
										<li class="nav-item"><a class="nav-link" href="#">Mes Phrases</a>
									<?php }?>
								</ul>
							</li>
							<?php if (isset($_SESSION['user'])) { ?>
								<li class="nav-item <?php if (isset($flagActif) && $flagActif === "profil") {echo "active";} ?>"><a class="nav-link" href="<?php echo base_url('index.php/profil');?>">Profil</a></li>
							<?php }?>
						</ul>
						<ul class="nav navbar-nav navbar-right" >
							<ul class="nav navbar-nav navbar-right" class="primary_btn">
								<?php if (!isset($_SESSION['user'])) { ?>
									<li class="nav-item submenu dropdown <?php if (isset($flagActif) && $flagActif === "authentification") {echo "active";} ?>">
										<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
										aria-expanded="false" class="primary_btn">Inscription/Connexion</a>
										<ul class="dropdown-menu">
											<li class="nav-item"><a class="nav-link" href="<?php echo base_url('index.php/inscription');?>">Inscription</a></li>
											<li class="nav-item"><a class="nav-link" href="<?php echo base_url('index.php/connexion');?>">Connexion</a></li>
										</ul>
									</li>
								<?php } else { ?>
									<li class="nav-item"><a class="nav-link" href="<?php echo base_url('index.php/deconnexion');?>">Déconnexion</a></li>
								<?php } ?>
							</ul>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================Header Menu Area =================-->