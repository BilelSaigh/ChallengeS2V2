<h2 class="py-3">Edit Article</h2>
<div class="d-flex justify-content-end my-3">
    <a class="btn btn-dark" id="save-button"  role="button">Save</a>
</div>
<?php
if (!empty($errors)):
    echo '<div class="alert alert-danger d-flex align-items-center p-2">
                    <i class="fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                       <h4 class="mb-1 text-dark">Something went wrong ! </h4>';
    foreach ($errors as $error){
        echo '  <span>'.$error.'</span>
                    </div>
                   </div>';
    } else:?>
        <div class="d-flex justify-content-end my-3">
            <div class="accordion" id="version-collapse">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="version-heading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#version-list" aria-expanded="true" aria-controls="version-list">
                            Version History
                        </button>
                    </h2>
                    <div id="version-list" class="accordion-collapse collapse " aria-labelledby="version-heading" data-bs-parent="#version-collapse">
                        <div class="accordion-body">
                            <ul class="list-group" id="versions">
                                <!-- Versions will be added here dynamically -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->modal("form",$addArticle);?>
        <label for="category" class="form-label"> Categories</label>
        <select name="categorie" class="form-select mb-3"  id="categorie">
            <option>Open this select menu</option>
            <?php  foreach ($category as $option):
                ?>
                <option value="<?=  $option->getId() ?>"  <?= ($option->getId() == $article->getCategory())?"selected": ""?> ><?= $option->getTitle()?></option>
            <?php endforeach;?>
        </select>

        <div id="article-data" data-title="<?= htmlspecialchars($article->getTitle()) ?>"
              data-content="<?=(!empty($version->getContent()))? htmlspecialchars($version->getContent()) :" "?>"   data-id="<?=$article->getId()?>"
        ></div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="isComment"  <?= ($article->isComment())?"checked": ""?> >
            <label class="form-check-label" for="flexCheckChecked">
                J'accepte que les utilisateurs puisse commenter cet article
            </label>
        </div>
        <div id="editorjs"></div>
        <pre id="output"></pre>
<?php endif?>
