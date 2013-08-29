<?php

require '../vendor/autoload.php';

$app = new Silex\Application();

$app->error(function(Exception $e){
    echo $e->getMessage();die;
});

// Register our Twig view path
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__ . '/../resources/twig'
));

// Register assetic and set up CSSMin
$app->register(new SilexAssetic\AsseticServiceProvider(), array(
    'assetic.path_to_web' => __DIR__,
    'assetic.options' => array(
        'auto_dump_assets' => true,
        'debug' => false
    ),
    'assetic.filters' => $app->protect(function($fm) {
        $fm->set('cssmin', new Assetic\Filter\CssMinFilter());
    })
));

// Do we want to dump all our assets? Only if in debug mode!
if ($app['assetic.options']['auto_dump_assets']){
    $dumper = $app['assetic.dumper'];
    if (isset($app['twig'])) {
        $dumper->addTwigAssets();
    }
    $dumper->dumpAssets();
}

// Create a route to test
$app->get('/', function () use ($app) {
    return $app['twig']->render("index.twig");
});

$app->run();
