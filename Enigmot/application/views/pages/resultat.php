        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
                <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
                <div class="container">
                    <div class="banner_content text-center p-5">
                        <div class="page_link">
                            <a href="Home">Home</a>
                            <a href="create">Jouer Phrase</a>
                        </div>
                        <h2>Résultat de votre partie</h2>
                    </div>
                    <div class="col-lg-12 p-5" style="background-color: #4a2fff; text-align:center; color: white;font-family: auto;">
                        <h2 name="resultatPhrase"><?php echo $resultat ?></h2>
                        <br>
                        <span class="color-yellow">la phrase était :</span>
                        <br>
                        <h2><?php echo $phrase ?></h2>
                        <span>par <?php echo $createur ?></span>
                        <br>
                        <br>
                        <ul>
                            <span class="color-yellow">Les votes précédents:</span>
                            <br>
                            <br>
                            <?php
                                foreach ($dataMots as $mot) {
                                    echo "<li class=''><amb>".$mot['motName']."</amb>: ";
                                    foreach ($mot['gloses'] as $glose) {
                                        echo $glose['gloseName']." ";
                                        echo $glose['vote'].", ";
                                    }

                                    echo "</li>";
                                }
                            ?>
                        </ul>

                        <a href="<?php echo base_url('index.php/jouer');?>" class="btn btn-primary">Rejouer</a>
                    </div>

                </div>
            </div>
        </section>