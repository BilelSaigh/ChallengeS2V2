<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= ucfirst($title)?></title>
    <meta name="description" content="<?php if (isset($page) ): echo $page->getDescription() ; endif ?>">
    <link href="/Views/assets/simple-image.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>
    body {
        font-family: <?= (!empty($front) ? $front->getPolices() : "") ?>;
    }

    p {
        color: <?= (!empty($front) ? $front->getPColor() : "") ?>;
        font-size: <?= (!empty($front) ? $front->getPSize() : "") ?>;
    }

    .btn-primary,
    .btn-primary:hover,
    .btn-primary:active {
        background-color: <?= (!empty($front) ? $front->getBtnColor() : "") ?>;
        border-color: <?= (!empty($front) ? $front->getBtnColor() : "") ?>;
    }
    .blog-header-logo {
        font-family: "Playfair Display", Georgia, "Times New Roman", serif;
        font-size: 2.25rem;
    }
    h1 {
        color: <?= (!empty($front) ? $front->getH1Color() : "") ?>;
        font-family: "Playfair Display", Georgia, "Times New Roman", serif;
    }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }
        .bd-mode-toggle {
            z-index: 1500;
        }
    </style>
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="aperture" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/>
        </symbol>
        <symbol id="cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
        <symbol id="chevron-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
        </symbol>
    </svg>

    <div class="container">
        <header class="border-bottom lh-1 py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="link-secondary" href="/register">Subscribe</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-body-emphasis text-decoration-none fw-bold" href="/"><?= $front->getWebsiteName() ?></a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="link-secondary" href="#" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
                    </a>
                    <a class="btn btn-sm btn-outline-secondary" href="/login">Sign up</a>
                </div>
            </div>
        </header>
        <?php if(!empty($pages)): ?>
            <div class=" py-1 mb-3 border-bottom">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="navbar-toggler  justify-content-end align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                            <?php  foreach ($pages as $page) : ?>
                            <li class="nav-item">
                                <a class="nav-item nav-link link-body-emphasis " href="<?=$page->getSlug() ?>"><?=$page->getTitle() ?></a>
                            </li>
                            <?php  endforeach; ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Articles
                                </a>

                                <ul class="dropdown-menu">
                                    <?php foreach ($categories as $category) :
                                      if ($category->isMenu()== 1):?>
                                        <li><a class="dropdown-item" href="<?= $category->getSlug()?>"><?=$category->getTitle() ?></a></li>
                                        <li><hr class="dropdown-divider"></li>
                                    <?php endif; endforeach;?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <?php endif; ?>
    </div>
    <main>
<!--        <h1 class="text-center py-2">--><?php //= ($title!= "Home")? ucfirst($title):"" ?><!--</h1>-->
        <?php include $this->view ?>
    </main>
    <div class="container  bottom-0  mt-5">
        <footer class="py-3 my-4 " >
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="/" class="nav-link px-2 text-body-secondary">Home</a></li>
                <li class="nav-item"><a href="/sitemap" class="nav-link px-2 text-body-secondary">Sitemap</a></li>
                <li class="nav-item"><a href="https://github.com/Stelleu/PA" class="nav-link px-2 text-body-secondary">Github</a></li>

            </ul>
            <p class="text-center text-body-secondary">&copy; 2023 Bilel Paul & Estelle, Inc</p>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script><!-- Header -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script><!-- Image -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script><!-- Delimiter -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@latest"></script><!-- List -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script><!-- Checklist -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script><!-- Quote -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script><!-- Code -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script><!-- Embed -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script><!-- Table -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script><!-- Link -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script><!-- Warning -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/raw@latest"></script><!-- Raw -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script><!-- Marker -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script><!-- Inline Code -->
    <?=($title!="Home")?'<script src="Views/assets/js/cleanPage.js"></script>':""?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter = document.getElementById('category-filter');
            const articlesContainer = document.getElementById('articles-container');
            const spinner = document.getElementById("spinner");

            categoryFilter.addEventListener('change', function() {
                const selectedCategory = categoryFilter.value;
                spinner.classList.remove("d-none");
                fetch('/filterarticle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({id: selectedCategory})
                })
                    .then(response => {
                        return response.json()
                    })
                    .then(data => {
                        articlesContainer.innerHTML = '';
                        var parseData = JSON.parse(data)
                        spinner.classList.add("d-none");
                        if (data && parseData.success) {
                            if (parseData.content) {
                                const contents = parseData.content;
                                contents.forEach(content => {
                                    console.log(content)
                                    const div = document.createElement("div");
                                    div.classList.add("col")
                                    div.classList.add("pb-5")
                                    const articles = document.createElement("article");
                                    articles.classList.add("card");
                                    articles.classList.add("shadow-sm");
                                    articles.innerHTML = ` <img src="${content.img}?>" class="card-img-top bd-placeholder-img card-img-top" alt="..." width="100%" height="225">
                                                            <div class="card-body">
                                                                <p class="card-text">${content.title}</p>
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <a class="btn btn-primary" href="/${content.slug}" role="button">View</a>
                                                                    <small class="text-body-secondary">${content.created_at}</small>
                                                                </div>
                                                            </div>`;
                                    articlesContainer.appendChild(div);
                                    div.appendChild(articles);
                                })
                            }
                        }else {
                            articlesContainer.innerHTML = '<p> This category is empty for the moment .</p>';
                        }
                    })
                    .catch(error => {
                        articlesContainer.innerHTML = '<p>Something gone wrong, call 0652144189.</p>';
                    });
            });
        });
    </script>


</body>
</html>