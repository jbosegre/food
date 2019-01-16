<?php
/**
 * Created by PhpStorm.
 * User: jbosegre
 * Date: 1/14/2019
 * Time: 10:26 AM
 */

//Require the autoload file

ini_set ("display_errors", 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//define a default route
$f3->route('GET /', function (){
   //echo '<h1>Hello, World!</h1>';

    $view = new View;
    echo $view->render('view/home.html');
});

//define breakfast route
$f3->route('GET /breakfast', function(){
    $view = new View;
    echo $view->render('view/breakfast.html');
});

//define lunch route
$f3->route('GET /lunch', function(){
    $view = new View;
    echo $view->render('view/lunch.html');
});

//define pancakes route
$f3->route('GET /breakfast/pancakes', function(){
    $view = new View;
    echo $view->render('view/pancakes.html');
});

$f3->route('GET /@meal/@food', function($f3, $params){
    print_r($params);
    echo "<h3>I Like " . $params['food'] . " for " . $params["meal"] . "</h3>";
});

//Run fat Free
$f3->run();

