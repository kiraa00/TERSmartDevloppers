<!--================Home Banner Area =================-->
<section class="banner_area" style="padding-bottom: 50px;">
    <div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center p-5">
                <div class="page_link">
                    <a href="Home">Acceuil</a>
                    <a href="create">Création</a>
                </div>
                <h2>Création d'une phrase</h2>
            </div>
            <div class="col-lg-12 p-4" style="background-color: #5753967a;">
                <h3>Creation d'une Phrase</h3>
                <?php if($_SESSION["user"]["credit"] < 75) { ?>
                    <div style="margin-top: 15px; font-size: 13px;" class="alert alert-danger" role="alert">Vous n'avez pas assez de crédits pour pouvoir créer une phrase de type rattachement.</div>
                <?php } else { ?>
                    <div style="margin-top: 15px; font-size: 13px;" class="alert alert-success" role="alert">Pour chaque groupe de mot ambigu ajouté, cela vous coûtera 50 crédits.<br>Pour chaque rattachement effectuer, cela vous coûtera 25 crédits.</div>
                <?php } ?>
                <div style="margin-bottom: 20px;" class="form-control" autocomplete="off" id="phrase" required="required" placeholder="Saisissez votre phrase" contenteditable></div>
                <div id="messageErrorR" hidden style="margin-top: 15px; font-size: 13px;" class="alert alert-danger" role="alert"></div>
                <button id="btnAddMotAmb" onclick="addMotAmb()" style="color: white;" class="btn btn-warning" type="button">Rendre le mot sélectionné ambigu</button>
                <div style="margin-top: 15px;" id="divAmbigu" ></div>
                <button id="btnCreer" onclick="sendDataR()" class="btn btn-info" type="submit">Créer la phrase</button>
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
                <input id="glose_input" autocomplete="off" name="glose" placeholder="Saisissez une nouvelle glose" class="form-control ui-autocomplete-input inputPopup" type="text">
                <div id="msgErrorPopup" hidden="hidden" style="display: block;color: red;margin-top: -19px;">Aucune glose déjà existante à vous proposer</div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnAddGlose" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>

<script id="select-script"></script>