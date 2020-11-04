<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(){

    }

    public function load(ObjectManager $manager)
    {
        $categorieRonde = new Categorie();
        $categorieRonde->setLibelle("rondes");
        $manager->persist($categorieRonde);

        $categorieTriangle = new Categorie();
        $categorieTriangle->setLibelle("triangulaires");
        $manager->persist($categorieTriangle);

        $categorieCarree = new Categorie();
        $categorieCarree->setLibelle("carrées");
        $manager->persist($categorieCarree);

        $manager->flush();

        $produitRougeCaree = new Produit();
        $produitRougeCaree->setLibelle("gommettes rouges carrées");
        $produitRougeCaree->setTarif(20);
        $produitRougeCaree->setIdCategorie($categorieCarree);
        $manager->persist($produitRougeCaree);

        $produitVertCaree = new Produit();
        $produitVertCaree->setLibelle("gommettes vert carrées");
        $produitVertCaree->setTarif(22);
        $produitVertCaree->setIdCategorie($categorieCarree);
        $manager->persist($produitVertCaree);

        $produitBleuCaree = new Produit();
        $produitBleuCaree->setLibelle("gommettes bleu carrées");
        $produitBleuCaree->setTarif(22);
        $produitBleuCaree->setIdCategorie($categorieCarree);
        $manager->persist($produitBleuCaree);

        $produitBleuRond = new Produit();
        $produitBleuRond->setLibelle("gommettes bleu rondes");
        $produitBleuRond->setTarif(12);
        $produitBleuRond->setIdCategorie($categorieRonde);
        $manager->persist($produitBleuRond);

        $produitBleuTriangle = new Produit();
        $produitBleuTriangle->setLibelle("gommettes bleu triangulaires");
        $produitBleuTriangle->setTarif(12);
        $produitBleuTriangle->setIdCategorie($categorieTriangle);
        $manager->persist($produitBleuTriangle);

        $manager->flush();

        $tagGommette = new Tag();
        $tagGommette->setNom("gommette");
        $manager->persist($tagGommette);

        $tagRouge = new Tag();
        $tagRouge->setNom("rouge");
        $manager->persist($tagRouge);

        $tagVert = new Tag();
        $tagVert->setNom("vert");
        $manager->persist($tagVert);

        $tagBleu = new Tag();
        $tagBleu->setNom("bleu");
        $manager->persist($tagBleu);

        $tagNoir = new Tag();
        $tagNoir->setNom("noir");
        $manager->persist($tagNoir);

        $tagRond = new Tag();
        $tagRond->setNom("rond");
        $manager->persist($tagRond);

        $tagCarree = new Tag();
        $tagCarree->setNom("carré");
        $manager->persist($tagCarree);

        $tagTriangle = new Tag();
        $tagTriangle->setNom("Triangle");
        $manager->persist($tagTriangle);

        $manager->flush();


    }
}
