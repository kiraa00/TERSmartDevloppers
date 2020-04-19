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
						<h3 id="result" class="phraseGame">Les <amb id="ma1" class="ma color-red" title="Ce mot est ambigu (id : 1)">verts</amb> sont contre le nucléaire.</h3>
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
						<div class="form-group">
							<div style='margin-bottom: 15px; padding-bottom: -20px;' id='"+divId+"' class='row row-eq-height'>
								<div class="col-xs-12 col-sm-3 col-md-3 col-sm-offset-1 col-md-offset-1 text-right text-left-xs amb">
									disposition
								</div>
								<div class="">
									<select class="form-control">
										<option selected="" disabled="" value="">Choisissez une glose (3 existantes)</option>
										<option value="1554">service</option>
										<option value="1555">agencement</option>
										<option value="1556">état d'esprit</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-2 col-md-2">
									<button type="button" class="btn btn-primary addGloseModal" data-toggle="modal" data-target="#modal">Ajouter une glose</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>