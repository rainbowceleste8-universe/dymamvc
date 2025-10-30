<?php
require_once '../config/database.php';
$database = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB, DB_USER, DB_PASSWORD);

//$stmt = $database->prepare("SELECT *
//FROM article");
//$stmt->execute();
//var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));

require_once '../app/controllers/ArticleController.php';
$controller = new ArticleController($database);
$request_uri = explode("?", $_SERVER['REQUEST_URI']);
switch($request_uri[0]) {
    case"/delete":
        $controller->deleteArticle($_GET['id_article']);
        break;
    case"/add" :
        // Cas où l'URI est/add
        $controller->addArticle($_POST['articleTitre'], $_POST['articleContenu'], $_FILES['photo_intro']);
        break;
    default:
        // Comportement par defaut
        $controller->afficherIndex();
        break;
        // break pour sortir du switch
}

