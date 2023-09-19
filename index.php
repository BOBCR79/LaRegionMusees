<?php
session_start();
require 'config/ini.php';

if (!isset($_SESSION[APP_TAG]['musees'])){/* conservation des données le temps de la session*/
$url= "https://data.laregion.fr/api/records/1.0/search/?dataset=agenda-d-occitanie-musees&q=";
$file=file_get_contents($url);
$dataImport= json_decode($file);
$musees=$dataImport->records;
$_SESSION[APP_TAG]['musees']=$musees;
}else $musees=$_SESSION[APP_TAG]['musees'];
$count=count($musees);


require 'inc/head.php';
?>

    <main class="">
        <section class="wrapper">
        <?php for($i=0;$i<$count;$i++): ?>
            <a href="musee.php?show=<?=$i?>">
                <article class="">
                            
                    <h2><?=($musees[$i]->fields->nom_du_lieu)?></h2>
                  
                    <div class="dates">
                        <p>Du <span style="font-weight:bold"><?=($musees[$i]->fields->date_debut)?></span> au <span style="font-weight:bold"><?=($musees[$i]->fields->date_fin)?></span> </p>                    
                                
                    </div>
                    <div class="desc_short">
                        <?=($musees[$i]->fields->description)?>
                    </div>
                    <img src="<?=($musees[$i]->fields->affiche)?>" class="picture" alt="">
                 
                </article>
            </a>
           
        <?php endfor?>
        </section>
    </main>

    <?php
    require 'inc/foot.php';