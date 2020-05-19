        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center" style="min-height: 100vh">
                <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
                <div class="container conteneur">
                    <div class="banner_content text-center p-5" style="margin-top: 50px;">
                        <h2 style="margin-top: 50px;">Résultat de la partie</h2>
                    </div>
                    <div class="col-lg-12 p-5" style="background-color: #5753967a; text-align:center; color: white;font-family: auto;">
                        <h2 name="resultatPhrase"><?php echo $resultat ?></h2>
                        <?php if(substr($resultat, 0, 13) === 'Félicitation'){
                            echo "<img src='"; echo base_url('assets/img/enigmotCoin.gif'); echo "'>";
                        }
                        ?>
                        <br>
                        <span class="color-yellow" style="font-size: 15px;">La phrase était :</span>
                        <br>
                        <h2><?php echo $phrase ?></h2>
                        <span style="font-size: 15px;">Par <?php echo $createur ?></span>
                        <br>
                        <br>
                        <ul>
                            <span class="color-yellow" style="margin-left: -44px; font-size: 15px;">Les votes précédents étaient :</span>
                            <br>
                            <br>
                            <?php
                                foreach ($dataMots as $mot) {
                                    $i = 0;
                                    echo "<li style='list-style: none; font-size: 20px; padding: 10px; margin-left: -36px;' id='dm".$mot['motObject']->position."' onmouseover='showShadow(this)' onmouseout='hideShadow(this)'><ambmot class='amb'>".$mot['motObject']->motAmbigu."</ambmot>: ";
                                    foreach ($mot['gloses'] as $glose) {
                                        echo $glose['gloseName']." ";
                                        if ($i < count($mot['gloses']) - 1) {
                                            echo $glose['vote'].", ";
                                        } else {
                                            echo $glose['vote']. ".";
                                        }
                                        $i++;
                                    }

                                    echo "</li>";
                                }
                            ?>
                        </ul>

                        <a href="<?php echo base_url($url);?>" class="btn btn-primary">Rejouer</a>
                    </div>

                </div>
            </div>
        </section>