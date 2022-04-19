<?php

define("BASE_PATH","../");

date_default_timezone_set('Europe/Paris');

// On vérifie si un controller est appelé depuis l'url
if(!empty($_GET['controller']))
{
    // On récupère le controller depuis l'url
    $controller = $_GET['controller'];
}
else
{
    // Sinon on utilise le controller par défaut
    $controller = 'Home';
}

$controllerClassName = ucfirst($controller) . "Controller";


// On vérifie si le fichier de controller existe
if(file_exists(BASE_PATH . 'controller/' . $controllerClassName . '.php'))
{
    // On inclut le fichier de controller
    require BASE_PATH . 'controller/' . $controllerClassName . '.php';

    $instance = new $controllerClassName();

    
    // Appel de la fonction présente dans le controller appelé
    if(!empty($_GET['action']))
    {
        // On récupère l'action depuis l'url
        $action = $_GET['action'];
    }
    else
    {
        // Sinon on utilise l'action par défaut
        $action = 'index';
    }

    // On vérifie si la fonction existe dans le controller appelé
    if(method_exists($instance, $action))
    {
        // On appelle la fonction
        $instance->$action();
    }
    else
    {
        // Sinon on appelle la fonction error404() par défaut
        require BASE_PATH . 'controller/ErrorController.php';
        $instance = new ErrorController();
        $instance->error404();
    }


}
else
{
    // Sinon on inclut le fichier de controller error par défaut
    require BASE_PATH . 'controller/ErrorController.php';
    $instance = new ErrorController();
    $instance->error404();
}
