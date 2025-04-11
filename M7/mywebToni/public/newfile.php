<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use \Frases\Entity\ON_Author;
use \Frases\Entity\ON_Theme;

$ch = require_once __DIR__.'/../config/cli-config.php';


if (($autor=$entityManager->find(ON_Author::class,1))==null) {
    $autor = new ON_Author();
    $autor->setNom("Confucio");
    $autor->setDescripcio("Pensador xinès");
    $entityManager->persist($autor);
} else {
    echo $autor->getId()."<br>";
}

if (sizeof($autor=$entityManager->getRepository('Frases\Entity\ON_Author')->findBy(array('nom'=>'Descartes')))==0) {
    $autor = new ON_Author();
    $autor->setNom("Descartes");
    $autor->setDescripcio("Filòsof i matemàtic francès.");
    $entityManager->persist($autor);
} else {
    echo $autor[0]->getId()."<br>";
}

if (($autor=$entityManager->getRepository('Frases\Entity\ON_Author')->findOneBy(array("nom"=>"Hesiode")))==null) {
    $autor = new ON_Author();
    $autor->setNom("Hesiode");
    $autor->setDescripcio("Poeta de l'Antiga Grècia.");
    $entityManager->persist($autor);
} else {
    echo $autor->getId()."<br>";
}

$temas = array ("Aprendre","Pensament","Vida","Esperança");
foreach($temas as $tema) {
    $aux = new ON_Theme();
    $aux->setNom($tema);
    $entityManager->persist($aux);
}

$entityManager->flush();


// FORMA 1: AMB SQL
$query = $entityManager->createQuery("SELECT a FROM Frases\Entity\ON_Author a");
$autors = $query->getResult();

echo "<pre>SQL---------------------------<br>";
// var_dump($autors);
foreach ($autors as $autor) {
    echo $autor->getNom();
    echo "<br>";
}
echo "<pre><br>";


$qb = $entityManager->createQueryBuilder();
// $qb->select('a')->from('Frases\Entity\ON_Author', 'a');
$qb->select('a')->from(ON_Author::class, 'a');
$query = $qb->getQuery();
$autors = $query->getResult();

echo "<pre>QueryBuilder---------------------------<br>";
// var_dump($autors);
foreach ($autors as $autor) {
    echo $autor->getNom();
    echo "<br>";
}
echo "<pre>";

echo "<br><br>";


// FORMA 2: AMB DOCTRINE
$autors = $entityManager->getRepository("Frases\Entity\ON_Author")->findAll();
$temes = $entityManager->getRepository("Frases\Entity\ON_Theme")->findAll();
echo "<pre>Doctrine---------------------------<br>";
//var_dump($autors);
foreach ($autors as $autor) {
    echo $autor->getNom();
    echo "<br>";
}
echo "</pre>";


echo "<pre>---------------------------<br>";
//var_dump($temes);
foreach ($temes as $tema) {
    echo $tema->getNom();
    echo "<br>";
}
echo "</pre>";
