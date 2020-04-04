		<section class="banner_area">
			<div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
				<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
				<div style="height:165px"></div>
					<div class="row">
						<div class="col-lg-6">
							<div class="home_left_img">
								<img class="img-fluid" src="<?php echo base_url('assets/img/banner/home-left.png');?>" alt="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="banner_content">
									<h1>Inscription</h1>
									<div class="container signin">
									</div>
								<hr>
								
								<label for="email"><b>Pseudo</b></label>
								<input id="pseudo" autocomplete="off" type="text" placeholder="Pseudo" name="pseudo" required>
								<div style="color:red;" id="errorPseudo" hidden role="alert"></div>

								<label for="email"><b>Email</b></label>
								<input id="email" autocomplete="off" type="text" placeholder="Email" name="email" required>
								<div style="color:red;" id="errorEmail" hidden role="alert"></div>

								<label for="mdp"><b>Mot de passe</b></label>
								<input id="password" type="password" placeholder="Mot de passe" name="mdp" required>
								<div id="errorPassword" hidden style="color:red;" role="alert"></div>

								<label for="mdp-repeat"><b>Confirmer mot de passe</b></label>
								<input id="password_verify" type="password" placeholder="Confirmer mot de passe" name="mdp-repeat" required>
								<div id="errorPasswordVerify" hidden style="color:red;" role="alert"></div>
								<hr>

								<p>En créant votre compte vous accepter nos conditions d'utilisation.</p>
								<button onclick="verify_form()" type="submit" class="registerbtn">S'inscrire</button>
								
							</div>
							<div class="container signin">
							    <p>Vous avez dèjà un compte? <a href="<?php echo base_url('index.php/connexion');?>">Se connecter</a>.</p>
							 </div>
						</div>
					</div>
				</div>
			</div>
		</section>