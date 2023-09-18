
<div class="container">
    <?php if (!empty($articles)): ?>
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-6 px-0">
                <h1 class="display-4 fst-italic"><?= $articles[0]->getTitle()?></h1>
                <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
                <p class="lead mb-0"><a href="<?= $articles[0]->getSlug()?>" class="text-body-emphasis fw-bold">Continue reading...</a></p>
            </div>
        </div>
    <?php endif;?>

    <div class="row g-5">
        <div class="col-md-8">
            <h3 class="pb-4 mb-4 fst-italic border-bottom"> All Articles </h3>
            <!-- Ajoutez le menu déroulant pour sélectionner une catégorie -->
            <select id="category-filter" class="form-select mb-3">
                <option value="all">All Categories</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->getId() ?>"><?= $category->getTitle() ?></option>
                <?php endforeach ?>
            </select>
            <!-- Ajoutez le conteneur pour afficher les articles filtrés -->
            <div id="articles-container" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($articles as $article) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="<?= (!empty($article->getImgUrl()))? $article->getImgUrl():"https://picsum.photos/seed/picsum/200/300"; ?>" class="card-img-top bd-placeholder-img card-img-top" alt="..." width="100%" height="225">
                            <div class="card-body">
                                <p class="card-text"><?= $article->getTitle()?></p>
                                <!-- <p class="card-text">--><?php //= $article->getDescription()?><!--</p>-->
                                <div class="d-flex justify-content-between align-items-center">
                                    <a class="btn btn-primary" href="/<?= $article->getSlug()?>" role="button">View</a>
                                    <small class="text-body-secondary"><?= $article->getCreatedAt()?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <div id="spinner" class="d-none">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>


        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-body-tertiary rounded">
                    <h4 class="fst-italic">About</h4>
                    <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Sitemap</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="/sitemap">Sitemap</a></li>
                    </ol>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="https://github.com/Stelleu/PA">GitHub</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>



