<?php ob_start(); ?>

    <section class="dernieres-sorties">
        <h1 class="titre-section">Dernières sorties</h1>
        <p class="description-section">Découvrez les films sortis récemment</p>
        <button class="b1">Afficher plus</button>
        <div class="containerAffiches">
            <div class="affiche">
                <figure class="image-affiche-film">
                    <img></img>
                </figure>
                <p class="titre-film"></p>
                <p class="date-sortie-film"></p>
                <p class="note-film"></p>
            </div>
        </div>
    </section>
    <section>
        
    </section>
    <section>
        
    </section>
    <section>
        
    </section>
    <section>
        
    </section>























<?php
$titrePage = "Liste d'acteurs";
$content = ob_get_clean();
require "view/template.php";
?>