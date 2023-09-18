<h2 class="pt-5">All Comments</h2>
<?php
if (!empty($errors)){
    echo '<div class="alert alert-danger d-flex align-items-center p-2">
                    <i class="fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                       <h4 class="mb-1 text-dark">Something went wrong ! </h4>';
    foreach ($errors as $error){
        echo '  <span>'.$error.'</span>
                    </div>
                   </div>';
    }
};
?>
<div class="table-responsive small">
    <table class="table  table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" >Author</th>
            <th scope="col" >Comment</th>
            <th scope="col" >Report</th>
            <th scope="col" >Created At</th>
            <th scope="col" >Article Id</th>
            <th scope="col" >Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment) :
            $given_date = new DateTime($comment->getCreatedAt());
            // Obtenir la date actuelle
            $current_date = new DateTime();
            // Calculer la différence entre les deux dates
            $interval = $current_date->diff($given_date);
            // Extraire le nombre de semaines, mois et jours
            $weeks = floor($interval->days / 7);
            $months = $interval->y * 12 + $interval->m;
            $days = $interval->days;
            $hours = $interval->h;
            $minutes = $interval->i;
            // Construction de la phrase résultante
            $result = "";
            if ($weeks > 0) {
                $result .= "$weeks week" . ($weeks > 1 ? 's' : '') . " ";
            }
            if ($months > 0) {
                $result .= "$months mounth ";
            }
            if ($days > 0) {
                $result .= "$days day" . ($days > 1 ? 's' : '') . " ";
            }
            if ($hours > 0) {
                $result .= "$hours hour" . ($hours > 1 ? 's' : '') . " ";
            }
            if ($minutes > 0) {
                $result .= "$minutes min" . ($minutes > 1 ? 's' : '') . " ";
            } ?>
            <tr>
                <td><?= $comment->getId() ?></td>
                <td>
                    <div class="row">
                        <p class="text-secondary text-hover-primary mb-1"><?= $comment->getAuthor()?></p>
                    </div>
                </td>
                <td><?= $comment->getComment()?></td>
                <td>
                    <?= $comment->getReport() ?>
                </td>
                <td><?= $result."ago" ?></td>
                <td><p ><?= $comment->getArticleId() ?></p></td>
                <td>
                    <a class="btn  text-center btn-danger btn-sm " id="delete"  data-comment-id="<?= $comment->getId() ?>" data-action="delete">Delete</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

