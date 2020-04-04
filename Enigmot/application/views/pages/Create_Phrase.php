		<!--================Home Banner Area =================-->
		<section class="banner_area">
			<div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
				<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center p-5">
						<div class="page_link">
							<a href="Home">Home</a>
							<a href="create">Create Phrase</a>
						</div>
						<h2>Create Phrase</h2>
					</div>
						<div class="col-lg-12 p-5" style="background-color: #5753967a;">
						<h3>Creation d'une Phrase</h3>
						<form method="post" action="Create_Phrase/insertPhrase">
						    <div id="phrase_space" class="form-group">
						    	<!-- hidden phrase à enregistré -->
						    	<input id="phraseH" name="phraseH" type="hidden" value="">
								<div class="input-group col-9">
									  <input type="text" class="form-control" name="phraseD" autocomplete="off" id="phrase" required="required" placeholder="Saisissez votre phrase">
								</div>
								<div class="col-9 pt-2">
								<button id="Mot_butt" class="genric-btn primary circle medium
						        " type="button">Ajouter un mot ambigu</button>
								</div>						 
						    </div>
						    <div id="Mots_space" class="row"></div>
						    <div class="row">
								<div class="col-md-9">
								</div>
								<div class="col-md-3">
									<button class="genric-btn danger circle arrow" type="submit">Ajouter la phrase</button>
								</div>
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
						            	<h3 class="modal-title" class="center"id="myModalLabel">Ajouter Glose</h4>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						                
						            </div>
						            <form id="glose_form" method="post">
						                <div class="modal-body">
						                    <input id="glose_input" name="glose" placeholder="Saisissez une glose" class="form-control" type="text">
						                </div>
						                <div class="modal-footer">
						                    <button type="button" class="registerbtn" onclick="hide_form()">Cancel</button>
						                    <button type="button" id="btnAddGlose" class="registerbtn2">Ajouter la glose</button>
						                </div>
									</form>
								</div>
							</div>
						</div>