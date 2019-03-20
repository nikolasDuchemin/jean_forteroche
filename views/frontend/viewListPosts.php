<?php 

$title = 'Liste des chapitres'; 

ob_start(); 

    ?>

    <?php while ($post = $postsData->fetch()) {
        ?>
        <div class="flex">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p class="date">
                <em>Publié le <?= $post['creation_date_fr'] ?></em>
                <?php 
                if ($post['update_date_fr']) {
                    ?><em>- Édité le <?= $post['update_date_fr'] ?></em><?php
                } 
                ?>
            </p>
        </div>
        
        <div class="bloc">
            <p><?= $post['preview'] ?> [...]</p>
        </div>
        <p class="buttonArea"><a class="button" href="index.php?action=seePost&amp;postId=<?= $post['post_id'] ?>">Lire la suite</a></p>
        <?php
    }

    $postsData->closeCursor(); 

$content = ob_get_clean();

require('template.php'); ?>