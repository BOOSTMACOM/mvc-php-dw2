<?php

class HomeController
{
    
    /**
     * Action par défaut
     * Affiche la page d'accueil
     * @return void
     */
    public function index() : void
    {
        include BASE_PATH . 'view/home/index.html.php';
    }
}
