		<section class="banner_area">
			<div class="banner_inner d-flex align-items-center">
				<div class="container">
					<div class="banner_content text-center">
						<h2>Creation d'une Phrase</h2>
						<form method="post" action="insertPhrase">
						    <div id="phrase_space" class="form-group">
						        <input type="text" name="phraseD" id="phrase" required="required" placeholder="Saisissez votre phrase"></textarea>
						        <button id="Mot_butt" class="registerbtn" type="button">Ajouter un mot ambigu</button>
						    </div>
						    <div id="Mots_space" class="form-group"></div>
						    <button class="registerbtn2" type="submit">Ajouter la phrase</button>

						</form> 
						<div class="modal fade" id="addGlose" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
						            <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						                <h4 class="modal-title" id="myModalLabel">Ajouter Glose</h4>
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
							
					</div>
				</div>
				
			</div>
			
		</section>


