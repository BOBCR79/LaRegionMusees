<?php
session_start();
require 'config/ini.php';
$currentPage="details";


if (isset($_GET['show'])){
    $i=$_GET['show'];
    $musees=$_SESSION[APP_TAG]['musees'];
}else $i=0;

require 'inc/head.php';
?>
<main>
    <div class="wrapper-w">
        <article class="art">
            <div>
                <h2><a href="<?=($musees[$i]->fields->site_web_du_porteur)?>" title="Visiter le site web" "><?=($musees[$i]->fields->nom_du_lieu)?></a></h2>
                <?php $shortLat=($musees[$i]->fields->geo_2d[0]);
                    $shortLong=($musees[$i]->fields->geo_2d[1]);?>
                <div class="dates">
                    <p>Du <span style="font-weight:bold"><?=($musees[$i]->fields->date_debut)?></span> au <span style="font-weight:bold"><?=($musees[$i]->fields->date_fin)?></span> </p>                    
                    
                    <!--si horaires début&fin présents/si horaire unique/ si seconds horaires  -->
                    <?php if (isset($musees[$i]->fields->horaire_1_fin)):?>
                        <p style="font-weight:bold" class="hours"> de <?=($musees[$i]->fields->horaire_1_debut)." à ".($musees[$i]->fields->horaire_1_fin)?></p>
                    <?php endif ?>
                    <?php if (isset($musees[$i]->fields->horaire_1_debut))if (!isset($musees[$i]->fields->horaire_1_fin)):?>
                        <p style="font-weight:bold" class="hours">  <?=" à ".($musees[$i]->fields->horaire_1_debut)?></p>
                    <?php endif ?>
                    <?php if (isset($musees[$i]->fields->horaire_2_debut)):?>
                        <p style="font-weight:bold" class="hours"> de <?=($musees[$i]->fields->horaire_2_debut)." à ".($musees[$i]->fields->horaire_2_fin)?></p>
                    <?php endif ?>


                </div>
                
            
                <div class="desc">
                    <?=($musees[$i]->fields->description)?>
                </div>
                
                <address>
                <p class="street"><span class="rue"><?=($musees[$i]->fields->adresse_du_lieu)?></span>
                <?=($musees[$i]->fields->code_postal_du_lieu)?> <?=($musees[$i]->fields->ville)?></p></address>
                <div>
                    <p>Téléphone: <?=($musees[$i]->fields->telephone_du_lieu)?></p>
                    <p>Email: <a href="<?=($musees[$i]->fields->courriel_du_lieu)?>"><?=($musees[$i]->fields->courriel_du_lieu)?></a></p>
                </div>
                <?php if (isset($musees[$i]->fields->infos_pratiques)):?>
                    <p class="infos"><?=($musees[$i]->fields->infos_pratiques)?></p>
                <?php endif ?>
                <div class="gps">
                <iframe width="376" height="250" frameborder="0" loading="lazy" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?=($musees[$i]->fields->geo_2d[1])?>%2C<?=($musees[$i]->fields->geo_2d[0])?>%2C<?=($musees[$i]->fields->geo_2d[1])?>%2C<?=($musees[$i]->fields->geo_2d[0])?>&amp;layer=mapnik&amp;marker=<?=($musees[$i]->fields->geo_2d[0])?>%2C<?=($musees[$i]->fields->geo_2d[1])?>" style="border: 1px solid black"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat=<?=$shortLat?>&amp;mlon=<?=$shortLong?>#map=12/<?=$shortLat?>/<?=$shortLong?>">Afficher une carte plus grande</a></small>
                </div>
            </div>
            <div class="large">
            <img src="<?=($musees[$i]->fields->affiche)?>" alt=""></div>
        </article>
    </div>

</main>





<?php

require 'inc/foot.php';