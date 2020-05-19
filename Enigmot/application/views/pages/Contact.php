<section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center">
						<div class="page_link">
							<a href="<?php echo base_url('index.php/home');?>">Acceuil</a>
							<a href="<?php echo base_url('index.php/Contact');?>">Contact</a>
						</div>
						<h2>CONTACTEZ NOUS</h2>
						
					</div>
				</div>
            </div>
        </section>


        <section class="contact_area section_gap">
            <div class="container">
                <div id="mapBox" class="mapBox" 
                    data-lat="43.6" 
                    data-lon="3.8833" 
                    data-zoom="13" 
                    data-info="75 avenue augustin Fliche"
                    data-mlat="40.701083"
                    data-mlon="-74.1522848">
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="contact_info">
                            <div class="info_item">
                                <i class="lnr lnr-home"></i>
                                <h6>Montpellier,France 34090</h6>
                                <p>Faculté des sciences</p>
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-phone-handset"></i>
                                <h6>00 (440) 9865 562 </h6>
                                <p>Du Lundi au Vendredi de 9h à 18h</p>
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-envelope"></i>
                                <h6>smartDevelopper@gmail.com   </h6>
                                <p>Envoyez-nous votre requête à tout moment!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div id="msgError" class="alert alert-danger" hidden></div>
                        <div class="row contact_form">
                            <div class="col-md-6">
                                <?php if(!isset($_SESSION['user'])) { ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="pseudo" name="name" placeholder="Saisir votre pseudo">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Saisir votre adresse email">
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="objet" name="subject" placeholder="Saisir le sujet">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" rows="1" placeholder="Ecrivez votre message ici"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button onclick="sendMessage()" type="submit" value="submit" class="primary_btn">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>