<?php

require_once '../app/models/Article.php';

class ArticleController {
    private $articleModel;

    public function __construct($database) {
       $this->articleModel = new Article();
       $this->articleModel->setDb($database);

    }

    public function afficherIndex() {
        $articles = $this->articleModel->getAllArticles();
        $meta_titre = "Accueil";
        require '../app/views/articleList.php';
    }

    public function addArticle($articleTitre, $articleContenu, $articlePhotoIntro) {
        // On verifie si le fichier uploade est bien une image
        // En testant si son type MIME commence par "image/"
        if(substr($articlePhotoIntro['type'], 0, 6) == "image/") {
            // Cas ou l'on a bien uploadé une image

            // On copie le fichier depuis la mémoire du serveur vers un emplacement physique
            move_uploaded_file($articlePhotoIntro['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/images/" . $articlePhotoIntro['name']);
            $cheminDefinitif = "/images/" . $articlePhotoIntro['name'];
        } else {
            // Cas ou l'on a uploadé autre chose qu'une image, ou alors rien du tout donc on laisse le chemin NULL
            $cheminDefinitif = NULL;
        }
        $this->articleModel->requeteInsertArticle($articleTitre, $articleContenu, $cheminDefinitif);
        header('Location: /');
    }

    public function deleteArticle($articleId) {
        $this->articleModel->requeteSupprimerArticle($articleId);
        header('Location:/');
    }

    public function afficherFormulaire() {
        $meta_titre = "Nouvelle publication";
        require '../app/views/articleForm.php';

    }
}