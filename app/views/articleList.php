<?php
include('includes/header.inc.php');
?>

   
        <div class="container p-4 my-3">
            <h1 class="text-primary text-center p-4">Liste des Articles</h1>
                <div class="d-flex">
                
                <img class="rounded" src="/images/gouttes-eau-dans-goutte-eau_1051578-145899.jpg"/>
                <div class="p-4 card text-bg-info">
                    <a href="/formulaire.php">Publier un nouvel article</a>
                    <div class="row">
                        <?php
                        foreach ($articles as $article) {
                        ?>
                        <div class="col-12 col-md-6 col-lg-4 my-3">
                            <?php 
                        if($article['photo_intro'] != NULL) {
                            ?>
                            <img src="<?= $article['photo_intro'] ?>" class="img-fluid"/>
                        <?php
                        }
                        ?>
                        <?= htmlspecialchars($article['titre']); ?>
                        <p><?= htmlspecialchars($article['contenu']) ?></p>
                        <a class="btn btn-primary" href="/delete?id_article=<?= $article['id'] ?>">Supprimer</a><br>
                    </div>
                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
include('includes/footer.inc.php');
?>
                    
