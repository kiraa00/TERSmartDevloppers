<section class="banner_area">
    <div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center p-5" style="margin-top:50px;">
                <h2 style="text-transform: none;"><b>Profil de </b> <?php echo $_SESSION['user']['pseudo'] ?></h2>
            </div>
            <div class="col-md-12">
                <div class="col-lg-12 p-4" style="background-color: #5753967a;">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="rowdiv">
                                    <ul class="ul-inline">
                                        <li><a class="activeprofil" href="<?php echo base_url('index.php/profil');?>">Profil</a></li>
                                        <li><a class="noactive" href="<?php echo base_url('index.php/editInfo');?>">Modification</a></li>
                                        <li><a class="noactive" href="<?php echo base_url('index.php/editPassword');?>">Mot de passe</a></li>
                                    </ul>
                                </div>
                                <br>
                                <div class="col-lg-12 p-4" style="background-color: #5753967a; margin-top:-18px;">
                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <p><b>Titre : </b> <?php echo $_SESSION['user']['titre'] ?></p>
                                            <p><b>Parties : </b> 0</p>
                                            <p><b>Points :</b> <?php echo $_SESSION['user']['point'] ?></p>
                                            <p><b>Crédits :</b> <?php echo $_SESSION['user']['credit'] ?></p>
                                            <p> Vous avez créé :</p>
                                            <div class="ulmarge">
                                            <ul >
                                                <li><?php echo $_SESSION['user']['nbrPhraseCree'] ?> phrases
                                                    <a href="#" style="color:white;"></a>
                                                </li>
                                                <li><?php echo $_SESSION['user']['nbrGloseAjoutee'] ?> gloses</li>
                                                <li><?php echo $_SESSION['user']['nbrMotAmbigu'] ?> mots / rattachements ambigus</li>
                                            </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <p><b>Date d'inscription :</b> <?php echo str_replace("-", "/", substr($_SESSION['user']['dateInscription'], 0, 10)) ." à ". substr($_SESSION['user']['dateInscription'], 11, 12)?></p>
                                            <p><b>Précédente connexion :</b> <?php if (substr($_SESSION['user']['derniereConnexion'], 0, 1) === "0") { echo "Jamais"; } else { echo str_replace("-", "/", substr($_SESSION['user']['derniereConnexion'], 0, 10)) ." à ". substr($_SESSION['user']['derniereConnexion'], 11, 12); }?></p>
                                            <p><b>Email :</b> <?php echo $_SESSION['user']['email'] ?></p>
                                            <p>
                                                <b>Groupe :</b> Membre
                                            </p>
                                            <p><b>Genre :</b> <?php if ($_SESSION['user']['genre'] == "") { echo "~"; } else { echo $_SESSION['user']['genre']; } ?></p>
                                            <p><b>Date de naissance :</b> <?php if ($_SESSION['user']['dateNaissance'] == "") { echo "~"; } else { echo $_SESSION['user']['dateNaissance']; } ?></p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>  
                    </div> 

                    

                </div>    
			</div>

            
        </div>
    </div>
</section>