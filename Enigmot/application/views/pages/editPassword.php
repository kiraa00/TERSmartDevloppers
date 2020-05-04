<section class="banner_area">
    <div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center p-5" style="margin-top:50px;">
                <h2 style="text-transform: none;">Changement de mot de passe</h2>
            </div>
            <div class="col-md-12">
                <div class="col-lg-12 p-4" style="background-color: #5753967a;">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="rowdiv">
                                    <ul class="ul-inline">
                                        <li><a class="noactive" href="<?php echo base_url('index.php/profil');?>">Profil</a></li>
                                        <li><a class="noactive" href="<?php echo base_url('index.php/editInfo');?>">Modification</a></li>
                                        <li><a class="activeprofil" href="<?php echo base_url('index.php/editPassword');?>">Mot de passe</a></li>
                                    </ul>
                                </div>
                                <br>
                                <div class="col-lg-12 p-4" style="background-color: #5753967a; margin-top:-18px;" >
                               
                                        
                                                <div style="font-size: 13px;" class="alert alert-danger" role="alert">Ici tu gérera tes differentes erreurs .</div>
                                                <p >Mot de passe actuel <b>*</b></p>
                                                <input type="password" id="form1" class="form-control">
                                                <p >Nouveau mot de passe <b>*</b></p>
                                                <input type="password" id="form1" class="form-control">
                                                <p >Confirmation du mot de passe <b>*</b></p> 
                                                <input type="password" id="form1" class="form-control">

                                                <div class="buttonvalidation">        
                                                    <a class="validerButton" href="#" >Valider</a>
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