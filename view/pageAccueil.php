<?php ob_start(); ?>

    <!-- <section class="presentation">
        <h1 class="titre-section"></h1>
        <p class="description-section">Découvrez notre recherche de films, acteurs, réalisateurs, rôles et plus encore...</p>
        <div class="containerCarousel">
            
               
                    <div class="card">
                        <figure class="image-affiche-film">
                            <img src="<?= "https://fr.web.img6.acsta.net/medias/nmedia/00/02/38/57/affblade2.jpg" ?>" alt=""></img>
                        </figure>
                        <p class="titre-film"><?= "Blade 2" ?></p>
                        <p class="date-sortie-film"><?= "1993" ?></p>
                        <p class="duree-film"><?= "95" ?></p>
                        <p class="note-film"><?= "5" ?></p>
                    </div>
          
        </div>
    </section> -->
    <section class="dernieres-sorties">
        <div class="infos-section">
            <h1 class="titre-section">Dernières sorties</h1>
            <p class="description-section">Découvrez les films sortis récemment</p>
        </div>
        <div class="containerCards">
            <?php 
                foreach($requeteSortiesRecentes->fetchAll() as $film){ ?>
                    <div class="card">
                        <figure class="image-affiche-film">
                            <img src="<?= $film["film_affiche"] ?>" alt=""></img>
                        </figure>
                        <p class="titre-film"><?= $film["film_titre"] ?></p>
                        <p class="date-sortie-film"><?= $film["film_date_sortie"] ?></p>
                        <p class="note-film">Note : <?= $film["film_note"] ?></p>
                    </div>
            <?php } ?>
        </div>
        <button class="b1">Afficher plus</button>
    </section>
    <section class="classement-film">
        <div class="infos-section">
            <h1 class="titre-section">Classement films</h1>
            <p class="description-section">Découvrez les films les mieux notés</p>
        </div>
        <button class="b1">Afficher plus</button>
        <div class="containerCards">
            <?php 
                foreach($requeteFilmsMieuxNotes->fetchAll() as $film){ ?>
                    <div class="card">
                        <figure class="image-affiche-film">
                            <img src="<?= $film["film_affiche"] ?>" alt=""></img>
                        </figure>
                        <p class="titre-film"><?= $film["film_titre"] ?></p>
                        <p class="date-sortie-film"><?= $film["film_date_sortie"] ?></p>
                        <p class="note-film"><?= $film["film_note"] ?></p>
                    </div>
            <?php } ?>
        </div>
    </section>
    <section class="genres">
        <div class="infos-section">
            <h1 class="titre-section">Genres</h1>
            <p class="description-section">Retrouvez les films par genre</p>
        </div>
        <button class="b1">Afficher plus</button>
        <div class="containerCards">
            <?php 
                foreach($requeteGenres->fetchAll() as $genre){ ?>
                    <div class="card">
                        <figure class="image-affiche-genre">
                            <img src="<?= $genre["genre_affiche"] ?>" alt=""></img>
                        </figure>
                        <p class="genre-libelle"><?= $genre["genre_libelle"] ?></p>
                        
                    </div>
            <?php } ?>
        </div>
    </section>
    <section class="acteurs">
        <div class="infos-section">
            <h1 class="titre-section">Acteurs</h1>
            <p class="description-section">Retrouvez des infos sur vos acteurs préférés</p>
        </div>
        <button class="b1">Afficher plus</button>
        <div class="containerCards">
            <?php 
                foreach($requeteActeurs->fetchAll() as $acteur){ ?>
                    <div class="card">
                        <figure class="image-acteur">
                            <img src="<?= $acteur["personne_photo"] ?>" alt=""></img>
                        </figure>
                        <p class="acteur"><?= $acteur["personne_prenom"]. " ".$acteur["personne_nom"]  ?></p>
                        
                    </div>
            <?php } ?>
        </div>
    </section>
    <section class="realisateurs">
        <div class="infos-section">
            <h1 class="titre-section">Realisateurs</h1>
            <p class="description-section">Retrouvez des infos sur vos réalisateurs préférés</p>
        </div>
        <button class="b1">Afficher plus</button>
        <div class="containerCards">
            <?php 
                foreach($requeteRealisateurs->fetchAll() as $realisateur){ ?>
                    <div class="card">
                        <figure class="image-realisateur">
                            <img src="<?= $realisateur["personne_photo"] ?>" alt=""></img>
                        </figure>
                        <p class="realisateur"><?= $realisateur["personne_prenom"]. " ".$realisateur["personne_nom"]  ?></p>
                        
                    </div>
            <?php } ?>
        </div>
    </section>























<?php
$titrePage = "Accueil";
$content = ob_get_clean();
require "view/template.php";
?>