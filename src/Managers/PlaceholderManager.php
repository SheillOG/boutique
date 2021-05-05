<?php

namespace App\Managers;

class PlaceholderManager
{

    public static function load()
    {
        return [
            // Edit font
            '_font' => 'Bebas neue',
            '_fonttitle' => 'Montserrat',
            '_fontsize' => '22px',
            '_fontsizetitle' => '27px',

            // Edit font
            '_colorbgshow' => '#E4D7C0',

            // Edit title on index
            '_title' => 'Nos Plans',

            // Edit name of store
            '_name' => 'Alt Shop',

            // Nav Bar
            '_accueil' => 'Accueil',
            '_login' => 'Se connecter',
            '_produit' => 'Nos plans',
            '_panier' => 'Panier',
            '_logout' => 'Se deconnecter',

            // Button Voir le Produit sur la page Index
            '_voirproduit' => 'Voir le produit',

            // Footer
            '_copyright' => 'AltShop 2021'

    ];
    }

}