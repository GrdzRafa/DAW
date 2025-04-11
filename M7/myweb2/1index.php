<?php
// use Frases\Entity\Comment;
use Frases\Entity\Author;
use Frases\Entity\Theme;

include "vendor/autoload.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

$cr = include "config/cli-config.php";

$confuci = new Author();
$confuci->setName("Confuci");
$confuci->setDescription("Pensador xinès.");
$entityManager->persist($confuci);

$descartes = new Author();
$descartes->setName("Descartes");
$descartes->setDescription("Filòsof i matemàtic francès.");
$entityManager->persist($descartes);

$hesiode = new Author();
$hesiode->setName("Hesíode");
$hesiode->setDescription("Poeta de l'Antiga Grècia.");
$entityManager->persist($hesiode);

$temes = array("Aprendre", "Pensament", "Vida", "Justícia", "Esperança");
foreach ($temes as $tema) {
    $theme = new Theme();
    $theme->setName($tema);
    $entityManager->persist($theme);
}

// $entityManager->flush();

$query = $entityManager->createQuery(
    'SELECT u FROM Frases\Entity\Author u'
);
$autors = $query->getResult();

$query = $entityManager->createQuery(
    'SELECT t FROM Frases\Entity\Theme t'
);
$temes2 = $query->getResult();

echo "<h1>Authors</h1>";
echo "<pre>";
var_dump($autors);
echo "</pre>";

echo "<h1>Themes</h1>";
echo "<pre>";
var_dump($temes2);
echo "</pre>";