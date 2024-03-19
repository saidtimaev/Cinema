<?php ob_start(); ?>



    
    <section class="presentation">
        <h1 class="titre-section"></h1>
        <p class="description-section">Découvrez notre recherche de films, acteurs, réalisateurs, rôles et plus encore...</p>
        <div class="container-carousel">       
            <button class="slide-arrow" id="slide-arrow-prev">
                &#8249;
            </button>
            <button class="slide-arrow" id="slide-arrow-next">
                &#8250;
            </button>
            <ul class="slides-container" id="slides-container">
                <?php 
                    foreach($requeteFilmsMieuxNotes2->fetchAll() as $film){ ?>
                        <li class="slide">
                            <div class="card-carousel">
                                <figure class="image-affiche-film">
                                    <img src="<?= $film["film_affiche"] ?>" alt=""></img>
                                </figure>
                                <div class="titre-date">
                                    <p class="titre-film"><?= $film["film_titre"] ?> </p>
                                    
                                </div>
                                <div class="duree-note">
                                    <p class="duree-film"><span class="bold">Durée :</span> <?= $film["film_duree"] ?></p>
                                    <p class="note-film">
                                        <span class="bold">Note :</span> 
                                        <?php for($i=0; $i<5; $i++){ 
                                            if($i < $film["film_note"]){?>
                                            <i class="fa-solid fa-star jaune"></i>
                                        <?php } else { ?>
                                            <i class="fa-solid fa-star"></i>
                                        <?php }} ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                <?php } ?>
                
           
            </ul>
            
    
        </div>
    </section>
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
                        <div class="infos-hidden">
                            <p class="titre-film text-align-left"><?= $film["film_titre"] ?></p>
                            <p class="realisateur-film"><span class="bold">Réalisateur :</span> <?= $film["realisateur"] ?></p>
                            <p class="date-sortie-film"><span class="bold">Année :</span> <?= $film["film_date_sortie"] ?></p>
                            <p class="note-film">
                                <span class="bold">Note :</span> 
                                <?php for($i=0; $i<5; $i++){ 
                                    if($i < $film["film_note"]){?>
                                    <i class="fa-solid fa-star jaune"></i>
                                <?php } else { ?>
                                    <i class="fa-solid fa-star"></i>
                                <?php }} ?>
                            </p>
                        </div>
                        <p class="titre-film"><?= $film["film_titre"] ?></p>
                    </div>
            <?php } ?>
        </div>
        <div class="bouton">
            <button class="b1">Afficher plus</button>                               
        </div>
    </section>
    <section class="classement-film">
        <div class="infos-section">
            <h1 class="titre-section">Classement films</h1>
            <p class="description-section">Découvrez les films les mieux notés</p>
        </div>
        <div class="containerCards">
            <?php 
                foreach($requeteFilmsMieuxNotes->fetchAll() as $film){ ?>
                    <div class="card">
                        <figure class="image-affiche-film">
                            <img src="<?= $film["film_affiche"] ?>" alt=""></img>
                        </figure>
                        <div class="infos-hidden">
                            <p class="titre-film text-align-left"><?= $film["film_titre"] ?></p>
                            <p class="realisateur-film"><span class="bold">Réalisateur :</span> <?= $film["realisateur"] ?></p>
                            <p class="date-sortie-film"><span class="bold">Année :</span> <?= $film["film_date_sortie"] ?></p>
                            <p class="note-film">
                                <span class="bold">Note :</span> 
                                <?php for($i=0; $i<5; $i++){ 
                                    if($i < $film["film_note"]){?>
                                    <i class="fa-solid fa-star jaune"></i>
                                <?php } else { ?>
                                    <i class="fa-solid fa-star"></i>
                                <?php }} ?>
                            </p>
                        </div>
                        <p class="titre-film"><?= $film["film_titre"] ?></p>
                    </div>
            <?php } ?>
        </div>
        <div class="bouton">
            <button class="b1">Afficher plus</button>                               
        </div>
    </section>
    <section class="genres">
        <div class="infos-section">
            <h1 class="titre-section">Genres</h1>
            <p class="description-section">Retrouvez les films par genre</p>
        </div>
        <div class="containerCards">
            <?php 
                foreach($requeteGenres->fetchAll() as $genre){ ?>
                    <div class="card">
                        <figure class="image-affiche-genre">
                            <img src="<?= $genre["genre_affiche"] ?>" alt=""></img>
                        </figure>
                        <div class="infos-hidden">
                            <p class="nombre-films-genre"><span class="bold">Films :</span> <?= $genre["nombre_films"] ?></p>
                        </div>
                        <p class="genre-libelle"><?= $genre["genre_libelle"] ?></p>
                        
                    </div>
            <?php } ?>
        </div>
        <div class="bouton">
            <button class="b1">Afficher plus</button>                               
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