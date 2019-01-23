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
$f3->route('GET /', function ($f3){
   //echo '<h1>Hello, World!</h1>';

    //$view = new View;
    //echo $view->render('view/home.html');

    //save variables
    $f3->set('username', 'jshmo');
    $f3->set('password', sha1('Password01'));
    $f3->set('title', 'Working with Templates');

    //load a template
    $template = new Template();
    echo $template->render('view/info.html');

    //alternate syntax
    //echo Template::instance()->render('views/info.html');
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

$f3->route('GET /@meal/@food', function($params){
    print_r($params);
    $meal = $params['meal'];
    $validMeals = ['breakfast', 'lunch', 'dinner'];

    if(!in_array($meal, $validMeals)){
        echo "<h3>Sorry, but we do not serve $meal</h3>";
    } else {
        switch ($meal){
            case 'breakfast':
                $time = " in the morning"; break;
            case 'lunch':
                $time = " At noon and afternoon"; break;
            case 'dinner':
                $time = " in the evening"; break;
        }
    }
    echo "<h3>I Like " . $params['food'] . " for " . $meal . "</h3>";
});

$f3->route('GET /@dessert/@treat', function($params){
    print_r($params);
    $dessert = $params['dessert'];
    $treat = $params['treat'];
    $invalidDessert = ['cake', 'cookies', 'brownies'];

    if(in_array($treat, $invalidDessert)){
        echo "<h3>Sorry, but we do not serve $treat</h3>";
    }
    echo "<h3>I Like " . $treat . " for dessert</h3>";

    $view = new View;
    echo $view->render('view/pancakes.html');
});

$f3->route('GET /order', function(){
    $view = new View;
    echo $view->render('view/form1.html');
});

$f3->route('POST /order-process', function($f3){
    print_r($_POST);

    $food = $_POST['food'];
    echo "You Ordered $food";

    if($food == 'pancakes') {
        $f3->reroute("/breakfast/pancakes");
    } else {
        echo ", but We don't have $food";
    }


});

//Run fat Free
$f3->run();

