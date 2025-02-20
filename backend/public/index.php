<?php
require __DIR__ . '/../vendor/autoload.php';  // <-- geht ein Verzeichnis zurück und sucht dort den vendor Ordner


use Slim\Factory\AppFactory;  // <-- Importiert die AppFactory Klasse aus dem Slim Framework

$app = AppFactory::create();  // <-- Erstellt eine neue Instanz der AppFactory Klasse

$routes = require __DIR__ . '/../src/routes.php';  // <-- Lädt die Routen aus der routes.php Datei
$routes($app);  // <-- Führt die Routen aus



$app->run();  