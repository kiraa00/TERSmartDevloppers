<section class="banner_area">
    <div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center p-5" style="margin-top:50px;">
                <h2 style="text-transform: none;">Export</h2>
            </div>
            <div class="col-md-12">
                <div class="col-lg-12 p-4" style="background-color: #5753967a;border-radius:10px">
                    <div class="row" >
                        <div class="col-md-12" style="text-align:center;">
                                <p>Enigmots met à disposition les données que nous récupérons sous forme de fichier JSON.<br>
                                Il existe plusieurs types d'export qui répondent à différents besoins, à vous de voir ceux dont vous avez besoin.
                                </p> 
                                <div class="clss">
                                    <img class="download" src="<?php echo base_url('assets/img/download.png');?>" alt="" >
                                    <a class="" href="Export/exportPhraseAmbigus?type=ambigu" download="Enigmot-Phrases-Ambigus.json"><i>Toutes les phrases avec leurs réponses (Version mot ambigu)</i></a>
                                    <br>
                                    <img class="download" src="<?php echo base_url('assets/img/download.png');?>" alt="" >
                                    <a   href="Export/exportPhraseAmbigus?type=rattachement" download="Enigmot-Phrases-Rattachements.json" ><i>Toutes les phrases avec leurs réponses (Version rattachement ambigu)</i></a>
                            </div>    
                        </div>  
                    </div> 
                </div>    
			</div>
        </div>
    </div>
</section>