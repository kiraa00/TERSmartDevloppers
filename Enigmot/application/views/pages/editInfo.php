<section class="banner_area">
    <div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center p-5" style="margin-top:50px;">
                <h2 style="text-transform: none;">Modification du profil</h2>
            </div>
            <div class="col-md-12">
                <div class="col-lg-12 p-4" style="background-color: #5753967a;">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="rowdiv">
                                    <ul class="ul-inline">
                                        <li><a class="noactive" href="<?php echo base_url('index.php/profil');?>">Profil</a></li>
                                        <li><a class="activeprofil" href="<?php echo base_url('index.php/editInfo');?>">Modification</a></li>
                                        <li><a class="noactive" href="<?php echo base_url('index.php/editPassword');?>">Mot de passe</a></li>
                                    </ul>
                                </div>
                                <br>
                                <div class="col-lg-12 p-4" style="background-color: #5753967a; margin-top:-18px;text-align:center;" >
                                    
                                        <p >Email <b>*</b></p>
                                        <input type="text" id="form1" class="form-control" style="width:50%;">  
                                        <p >Genre</p>
                                        <div class="radiosex">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="defaultGroupExample1" name="groupOfDefaultRadios">
                                                <label class="custom-control-label" for="defaultGroupExample1">Homme</label>
                                            </div>

                                            <div class="custom-control custom-radio" style="margin-left:10px;">
                                            <input type="radio" class="custom-control-input" id="defaultGroupExample2" name="groupOfDefaultRadios" checked>
                                            <label class="custom-control-label" for="defaultGroupExample2" >Femme</label>
                                            </div>
                                        </div>
                                        <p >Date de naissance</p>

                                        <div>
                                            <input  type="number" placeholder="Jour" id="example-number-input" style="margin-top:10px;">
                                            <input  type="number" placeholder="Mois" id="example-number-input" style="margin-top:10px;">
                                            <input  type="number" placeholder="Année" id="example-number-input" style="margin-top:10px;">
                                        </div>
                                        <div class="buttonvalidation" style="margin-top:20px;">        
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