<?php
if (!empty($article)):?>

<section id="articles">
    <div class="container">
        <div class="row">
            <div class="col">
                <article>
                    <div id="editorjs" data-content="<?= htmlspecialchars($version->getContent())?>"></div>
                </article>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid card shadow-0 border" style="background-color: #f0f2f5;" >
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6">
                     <div class="row d-flex justify-content-center">
                <?php
                if (!empty($errors)){
                    foreach ($errors as $error){
                        echo '<div class="alert alert-danger d-flex align-items-center p-5">
                                                        <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                                                        <div class="d-flex flex-column">
                                                            <h4 class="mb-1 text-dark">Something went wrong ! </h4>
                                                            <span>'.$error.'</span>
                                                        </div>
                                                    </div>';
                    }
                }?>


                        <h4  class="card-title py-3 ps-3" >Comments</h4>
                        <?php if (!empty($comments)) :?>
                            <?php foreach ($comments as $comment) : ?>
                                <div class="card mb-4">
                                    <p class="text-muted small mb-0 px-2 py-2 text-end">
                                        <?= $comment->getCreatedAt()?>
                                    </p>
                                    <div class="card-body">
                                        <p><?= $comment->getComment()?></p>

                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <i class="bi bi-person-circle"></i>
                                                <p class="small mb-0 ms-2"><?= $comment->getAuthor()?></p>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <button type="button" class="btn btn-report" data-comment-id="<?= $comment->getId() ?>"><i class="bi bi-flag-fill"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; else:?>
                            <p>  Be the first to comment<p>
                            <?php  endif;
                            if (!empty($_SESSION["user"])) :
                            ?>
                            <div class=" card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <h4>Add comment</h4>
                                <form id="commentForm" method="post">
                                        <input type="text" class="form-control" value="<?= $article->getId() ?>"  hidden="hidden" name="article_id">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInputDisabled"  disabled>
                                        <label for="floatingInputDisabled"><?= $_SESSION["user"]["firstname"]." ".$_SESSION["user"]["lastname"] ?></label>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="comment"></textarea>
                                        <label for="floatingTextarea2">Comments</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary my-3">Submit</button>
                                </form>
                            </div>

                    </div>
                </div>
            </div>
        </div>

<?php else:?>
    <div class="alert alert-info" role="alert">
        You need to be connected for comment
    </div>
<?php endif;?>
    </section>

<?php elseif(!empty($menuCategory)):?>
    <section class="container">
        <div class="row mb-2">
            <div class="col-md">
                    <?php foreach ($articles as $article) :
                        $dateOrigine = $article->getCreatedAt();
                        $dateObj = new DateTime($dateOrigine);
                        $mois = $dateObj->format('M');
                        $jour = $dateObj->format('j');
                        $dateFormatee = $mois . ' ' . $jour;
                            foreach ($categories as $category) :
                                if ($category->getId() === $article->getCategory()) : ?>
                                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 flex-column position-static">
                                            <strong class="d-inline-block mb-2 text-primary-emphasis"><?= ucfirst($category->getTitle()) ?></strong>
                                            <h3 class="mb-0"><?= $article->getTitle() ?></h3>
                                            <div class="mb-1 text-body-secondary"><?= $dateFormatee?></div>
                                            <p class="card-text mb-auto"><?= $article->getSlug()?></p>
                                            <a href="<?= $article->getSlug()?>" class="icon-link gap-1 icon-link-hover stretched-link">
                                                Continue reading
                                                <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                                            </a>
                                        </div>
                                        <div class="col-auto d-none d-lg-block">
                                            <img src="<?= $article->getImgUrl()?>" width="200" height="250" >
                                        </div>
                                    </div>
                    <?php endif;endforeach;endforeach; ?>
            </div>
        </div>
    </section>

<?php  else :  ?>
    <div class="container">
        <div class="row g-5">
            <div class="col-md-8">
                <?php  if(!empty($pageContent->getContent())) :echo $pageContent->getContent() ;  endif ?>
            </div>
            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div>
                        <?php if (!empty($recentArticles)) : ?>
                            <h4 class="fst-italic">Recent posts</h4>
                            <ul class="list-unstyled">
                                <?php foreach ($recentArticles as $article):
                                        if ($article->getCategory() === $pageContent->getCategory() ):?>
                                            <li>
                                                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="<?= $article->getSlug() ?>">
    <!--                                                <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>-->
                                                    <img src="<?= $article->getImgUrl() ?>" class="bd-placeholder-img" width="100%" height="96">
                                                    <div class="col-lg-8">
                                                        <h6 class="mb-0"><?= $article->getTitle() ?></h6>
                                                        <small class="text-body-secondary"> <?php $dateString = $article->getCreatedAt() ;
                                                            $date = new DateTime($dateString);
                                                            $formattedDate = $date->format('F j, Y');
                                                            echo $formattedDate; ?>
                                                        </small>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php endif;
                                endforeach;?>
                            </ul>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
