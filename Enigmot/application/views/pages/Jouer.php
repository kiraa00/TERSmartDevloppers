		<!--================Home Banner Area =================-->
		<section class="banner_area">
			<div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
				<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center p-5">
						<div class="page_link">
							<a href="Home">Home</a>
							<a href="<?php echo base_url('index.php/jouer');?>">Jouer Phrase</a>
						</div>
						<h2>Jouer Phrase <?php echo $Type; ?></h2>
					</div>
					<div class="col-lg-12 p-5" style="background-color: #5753967a; text-align:center; color: white;">
						<div id="messageError" hidden style="margin-top: 15px; font-size: 13px;text-align:left;" class="alert alert-danger" role="alert"></div>
						<?php echo form_open('Jouer/saveData',array('id'=>'jouerForm')); ?> 
						<input id="idPhrase" name="idPhrase" type="text" value="<?php echo $phrase->id_phrase ?>" hidden/>
						<h3 id="result" class="phraseGame">
							<?php echo $phrase->Phrase ?>
						</h3>

						<div class="form-group">
							<button id="phraseLike" class="btn-sm btn-light btn-like">
								<i class="fa fa-thumbs-up" aria-hidden="true"></i>J'aime cette phrase
							</button>&nbsp;&nbsp;&nbsp;
							<button id="phraseLike" class="btn-sm btn-primary btn-like">
								<i class="fa fa-thumbs-up" aria-hidden="true"></i> Partager
							</button>&nbsp;&nbsp;&nbsp;
							<button id="phraseLike" class="btn-sm btn-info btn-like">
								<i class="fa fa-thumbs-up" aria-hidden="true"></i> Tweeter
							</button>&nbsp;&nbsp;&nbsp;
							<button id="phraseSignal" class="btn-sm btn-danger btn-error" data-toggle="modall" data-target="#modal">
								<i class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></i>Signaler un élément
							</button>
						</div>
						<br>
						<div id="motForm" class="form-group">
						<?php
						$idDiv=0;
							foreach ($dataAmbigu as $Ambigu) {
								$idMot = ($Ambigu['mot'])->id_ambigu;
								$MotPosition = ($Ambigu['mot'])->position;
								$MotAmbigu = ($Ambigu['mot'])->motAmbigu;
								$currSelect = "select".$idMot;
								$nbrSelect = "nbr".$currSelect;
								$i = $Ambigu['nbrGlose'];
								$idDiv++;
								echo "<div class='row motGame' id='dm$MotPosition' onmouseover='showShadow(this)' onmouseout='hideShadow(this)'>";
								echo 	"<div id='champs$idDiv' class='champ'>";
								echo 		"<input name='idMot[]' type='text' value='$idMot' hidden>";
								echo		"<div class='col-xs-12 col-sm-3 col-md-3 col-sm-offset-1 col-md-offset-1 text-right text-left-xs'>";
								echo 			"<label class='amb control-label required pull-left' for='champs$idDiv'>";
								echo 				"<h3>$MotAmbigu</h3>";
								echo			"</label>";
								echo 		"</div>";
								echo		"<div class='col-xs-12 col-sm-4 col-md-4'>";
								echo 			"<input name='nbrGlose[]' type='text' id='$nbrSelect' value='$i' hidden>";
								echo			"<select class='form-control gloseValid' name='idGlose[]' id='$currSelect' value=''>";
								echo				"<option selected='' disabled='' value=''> Choisissez une glose ($i existantes)</option>";
								foreach ($Ambigu['gloses'] as $glose) {
									echo			"<option value='$glose->id_glose'>$glose->glose</option>";
								}
								echo			"</select>";
								echo		"</div>";
								echo		"<div class='col-xs-12 col-sm-3 col-md-3'>";
								if (isset($_SESSION['user']) & $Type=="ambigu") {
									echo		"<button id='addBtn' type='button' class='genric-btn info radius' data-toggle='modal' data-target='#modal' onclick='addGlose($currSelect,$idMot)'>Ajouter une glose</button>";
								}
								echo 		"</div>";
								echo 	"</div>";
								echo "</div>";
							}

						?>
						</div>

						<div class="row pull-right" style="padding-bottom: 10px;">
							<button id="valider" class="pull-right genric-btn primary radius" type="submit">Valider</button>
							<a href="<?php echo base_url('index.php/jouer');?>"><button type="button" class="pull-right genric-btn primary-border circle arrow" >passer phrase<span class="lnr lnr-arrow-right"></span></button></a>
						</div>

						</form>
					</div>

				</div>
			</div>
		</section>

		<div class="modal fade" id="addGlose" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<h3 class="modal-title" class="center" id="popupLabel">Ajout d'une glose</h4>
						<button type="button" class="close btnClosePopup" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						
					</div>
					<div class="modal-body">
						<h4 class="h4Message" id="h4Message"></h4><br>
						<form id="FormReset" >
							<input id="glose_input" autocomplete="off" name="glose" placeholder="Saisissez une nouvelle glose" class="form-control ui-autocomplete-input inputPopup" type="text">

							<div id="msgErrorPopup" hidden="hidden" style="display: block;color: red;margin-top: -19px;">Aucune glose déjà existante à vous proposer</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnAddGlose" class="btn btn-primary">Ajouter</button>
					</div>
				</div>
			</div>
		</div>