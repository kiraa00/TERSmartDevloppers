<section class="banner_area" >
    <div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container" >
            <div class="banner_content text-center p-5" style="margin-top:50px;">
                <h2 style="text-transform: none;">Modification du profil</h2>
            </div>
            <div class="col-md-12" >
                <div class="col-lg-12 p-4" style="background-color: #5753967a;">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="rowdiv">
                                    <ul class="ul-inline">
                                        <li><a class="noactive" href="<?php echo base_url('index.php/profil');?>">Profil</a></li>
                                        <li><a class="activeprofil" href="<?php echo base_url('index.php/editInfo');?>" >Modification</a></li>
                                        <li><a class="noactive" href="<?php echo base_url('index.php/editPassword');?>" >Mot de passe</a></li>
                                    </ul>
                                </div>
                                <br>
                                <div class="col-lg-12 p-4" style="background-color: #5753967a; margin-top:-18px;text-align:center;" > 
                                        <p style="margin-bottom: 5px;"><b>Genre</b></p>
                                        <div class="radiosex">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="homme" name="genre" value="Homme" <?php if ($_SESSION['user']['genre'] === "Homme") {?> checked <?php } ?>>
                                                <label class="custom-control-label" for="homme">Homme</label>
                                            </div>

                                            <div class="custom-control custom-radio" style="margin-left:10px;">
                                                <input type="radio" class="custom-control-input" id="femme" name="genre" value="Femme" <?php if ($_SESSION['user']['genre'] === "Femme") {?> checked <?php } ?>>
                                                <label class="custom-control-label" for="femme" >Femme</label>
                                            </div>
                                        </div>
                                        <p style="margin-top: 20px; margin-bottom: 5px;"><b>Date de naissance</b></p>

                                        <div>
                                            <input type="date" max="<?php echo date("Y-m-d") ?>" min="1900-01-01" id="dateNaissance" style="margin-top:10px;" min="0" value="<?php echo $_SESSION['user']['dateNaissance']?>">
                                        </div>
                                        <div class="buttonvalidation" style="margin-top:20px;">        
                                            <button class="btn btn-primary" onclick="modifyInfo()">Valider</button>
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