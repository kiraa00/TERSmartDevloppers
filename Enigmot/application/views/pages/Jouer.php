		<!--================Home Banner Area =================-->
		<section class="banner_area">
			<div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
				<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center p-5">
						<div class="page_link">
							<a href="Home">Home</a>
							<a href="create">Jouer Phrase</a>
						</div>
						<h2>Jouer Phrase</h2>
					</div>
					<div class="col-lg-12 p-5" style="background-color: #5753967a; text-align:center; color: white;">
						<?php echo validation_errors(); ?>
						<?php echo form_open('Jouer/saveData'); ?> 
						<input id="idPhrase" name="idPhrase" type="text" value="<?php echo $phrase->id_phrase ?>" hidden/>
						<h3 id="result" class="phraseGame">
							<?php echo $phrase->Phrase ?>
						</h3>

						<div class="form-group">
							<button id="phraseLike" class="btn btn-light btn-like">
								<i class="fa fa-thumbs-up" aria-hidden="true"></i>J'aime cette phrase
							</button>&nbsp;&nbsp;&nbsp;
							<button id="phraseLike" class="btn btn-primary btn-like">
								<i class="fa fa-thumbs-up" aria-hidden="true"></i> Partager
							</button>&nbsp;&nbsp;&nbsp;
							<button id="phraseLike" class="btn btn-info btn-like">
								<i class="fa fa-thumbs-up" aria-hidden="true"></i> Tweeter
							</button>&nbsp;&nbsp;&nbsp;
							<button id="phraseSignal" class="btn btn-danger btn-error" data-toggle="modall" data-target="#modal">
								<i class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></i>Signaler un élément
							</button>
						</div>
						<br>
						<div id="motForm" class="form-group">
						<?php
							foreach ($dataAmbigu as $Ambigu) {
								$idMot = ($Ambigu['mot'])->id_ambigu;
								$MotPosition = ($Ambigu['mot'])->position;
								$MotAmbigu = ($Ambigu['mot'])->motAmbigu;
								$currSelect = "select".$idMot;
								$i = $Ambigu['nbrGlose'];
								echo "<div class='row motGame form-inline' id='dm$MotPosition' onmouseover='showShadow(this)' onmouseout='hideShadow(this)'>";
								echo 	"<div class='row pl-0 m-1'>";
								echo 		"<input name='idMot[]' type='text' value='$idMot' hidden>";
								echo		"<div class='amb mr-2'>";
								echo 			"<h3>$MotAmbigu</h3>";
								echo 		"</div>";
								echo		"<div>";
								echo			"<select class='form-control' name='idGlose[]' id='$currSelect' value='";echo set_value('idGlose[]');echo  "  ' >";
								echo				"<option selected='' disabled='' value='$i'> Choisissez une glose ($i existantes)</option>";
								foreach ($Ambigu['gloses'] as $glose) {
									echo			"<option value='$glose->id_glose'>$glose->glose</option>";
								}
								echo			"</select>";
								echo		"</div>";
								echo 	"</div>";
								echo	"<div class='pl-0 m-1'>";
								if (isset($_SESSION['user'])) {
									echo		"<button id='addBtn' type='button' class='pull-left genric-btn danger circle' data-toggle='modal' data-target='#modal' onclick='addGlose($currSelect,$idMot)'>Ajouter une glose</button>";
								}
								echo "</div>";
								echo "</div>";
							}

						?>
						</div>

						<div>
							<button class="pull-right btn-lg genric-btn success circle arrow" type="submit">Valider<span class="lnr lnr-arrow-right"></span></button>
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