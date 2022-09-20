<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Quizz\Core\Controller\FastRouteCore;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Couche Controller
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route)
{
    $route->addRoute('GET', '/', 'Quizz\Controller\HomeController');
    $route->addRoute('GET', '/lister', 'Quizz\Controller\Questionnaire\ListController');
    $route->addRoute('GET', '/detail/{id:\d+}', 'Quizz\Controller\Questionnaire\ViewController');
    $route->addRoute('GET', '/hello/{id:\d+}', 'Quizz\Controller\helloController');
    $route->addRoute('GET', '/eleve', 'Quizz\Controller\eleve');
    $route->addRoute(['GET','POST'],'/eleve/{id:\d+}', 'Quizz\Controller\modifierEleve');
    $route->addRoute(['GET','POST'], '/add', 'Quizz\Controller\ajoutEleve');
    $route->addRoute(['GET','POST'], '/eleve/{id:\d+}/del', 'Quizz\Controller\supprimeEleve');
});
// Dispatcher -> Couche view
echo FastRouteCore::getDispatcher($dispatcher);

