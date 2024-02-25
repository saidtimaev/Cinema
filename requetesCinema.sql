-- a. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et 
-- réalisateur

SELECT film_titre, film_duree, personne_prenom, personne_nom
FROM film
INNER JOIN realisateur ON realisateur.id_realisateur = film.id_realisateur
INNER JOIN personne ON personne.id_personne = realisateur.id_personne
WHERE id_film = 1


-- b. Liste des films dont la durée excède 2h15 classés par durée (du + long au + court)

SELECT film_titre, film_duree
FROM film
WHERE film_duree > 135
ORDER BY film_duree DESC


-- c. Liste des films d’un réalisateur (en précisant l’année de sortie)

SELECT film_titre, film_date_sortie
FROM film
WHERE id_realisateur = 2

-- d. Nombre de films par genre (classés dans l’ordre décroissant)

SELECT genre_libelle, COUNT(genre_film.id_film) AS nbFilms
FROM genre_film
INNER JOIN film ON film.id_film = genre_film.id_film
INNER JOIN genre ON genre.id_genre = genre_film.id_genre
GROUP BY genre_film.id_genre 
ORDER BY nbFilms DESC


-- e. Nombre de films par réalisateur (classés dans l’ordre décroissant)

SELECT personne_nom, COUNT(film.id_film) AS nbFilms
FROM film
INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
INNER JOIN personne ON personne.id_personne = realisateur.id_personne
GROUP BY film.id_realisateur
ORDER BY nbFilms DESC


-- f. Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe

SELECT role_nom, personne_nom, personne_prenom, personne_sexe
FROM casting_film
INNER JOIN film ON casting_film.id_film = film.id_film
INNER JOIN role ON casting_film.id_role = role.id_role
INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne
WHERE casting_film.id_film = 2

-- g. Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de 
-- sortie (du film le plus récent au plus ancien)

SELECT film_titre, role_nom, film_date_sortie
FROM casting_film
INNER JOIN film ON casting_film.id_film = film.id_film
INNER JOIN role ON casting_film.id_role = role.id_role
WHERE casting_film.id_acteur = 22
ORDER BY film_date_sortie DESC

-- h. Liste des personnes qui sont à la fois acteurs et réalisateurs

SELECT acteur.id_personne, personne_nom
FROM acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne
WHERE acteur.id_personne = ANY
  (SELECT id_personne
  FROM realisateur
  WHERE id_personne);

--   SELECT personne.id_personne, personne_nom, personne_prenom, id_acteur, id_realisateur
-- FROM personne
-- LEFT JOIN realisateur ON personne.id_personne = realisateur.id_personne
-- LEFT JOIN acteur ON personne.id_personne = acteur.id_personne
-- WHERE id_acteur IS NOT NULL AND id_realisateur IS NOT NULL

SELECT personne.id_personne, personne_nom, personne_prenom
FROM personne
INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne

-- i. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)
