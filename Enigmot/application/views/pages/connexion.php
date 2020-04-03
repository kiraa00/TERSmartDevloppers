		<section class="banner_area">
			<div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
				<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="home_left_img">
								<img class="img-fluid" src="<?php echo base_url('assets/img/banner/home-left.png');?>" alt="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="banner_content">
								<h1>Connexion</h1>
							    <hr>

							    <label for="email"><b>Email</b></label>
							    <input type="text" placeholder="Email" name="email" required>

							    <label for="mdp"><b>Mot de passe</b></label>
							    <input type="password" placeholder="Mot de passe" name="mdp" required>
							    <hr>

							    <button type="submit" class="registerbtn">Se connecter</button>
							</div>
							<div class="container signin">
							    <p>Vous n'avez pas encore de compte? <a href="<?php echo base_url('index.php/inscription');?>">S'inscrire'</a>.</p>
							 </div>
						</div>
					</div>
				</div>
			</div>
		</section>

