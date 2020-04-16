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
					<div class="col-lg-12 p-4" style="background-color: #5753967a;">
						<h3>Creation d'une Phrase</h3>
						<div id="messageError" hidden style="margin-top: 15px; font-size: 13px;" class="alert alert-danger" role="alert"></div>
						<div id="messageSuccess" hidden style="margin-top: 15px; font-size: 13px;" class="alert alert-success" role="alert"></div>
						<input type="text" class="form-control" name="phraseD" autocomplete="off" id="phrase" required="required" placeholder="Saisissez votre phrase">
						<button id="Mot_butt" class="genric-btn primary circle medium "type="button">Ajouter un mot ambigu</button>
						<div style="margin-top: 20px;" id="Mots_space" ></div>
						<button id="btnAjouter" onclick="sendData()" class="genric-btn danger circle medium" type="submit">Ajouter la phrase</button>
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
							<input id="glose_input" autocomplete="off" name="glose" placeholder="Saisissez une glose" class="form-control" type="text">
						</div>
						<div class="modal-footer">
							<button type="button" class="registerbtn" onclick="hide_form()">Cancel</button>
							<button type="button" id="btnAddGlose" class="registerbtn2">Ajouter la glose</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script id="select-script"></script>