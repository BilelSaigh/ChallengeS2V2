<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta name="description" content="Gestionnaire de Adeboc">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
 </head>
<body>
    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Company name</a>

            <ul class="navbar-nav flex-row d-md-none">
                <li class="nav-item text-nowrap">
                    <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
                        <svg class="bi"><use xlink:href="#search"/></svg>
                    </button>
                </li>
                <li class="nav-item text-nowrap">
                    <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <svg class="bi"><use xlink:href="#list"/></svg>
                    </button>
                </li>
            </ul>

            <div id="navbarSearch" class="navbar-search w-100 collapse">
                <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
            </div>
        </header>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar  border-right col-md-3 col-lg-2 text-bg-dark d-flex flex-column flex-shrink-0 p-3 ">
                <div class="offcanvas-md offcanvas-end bg-dark " tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"><a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                                    <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                                                    <span class="fs-4">Sidebar</span>
                                                </a>
                                                <hr>
                                                <ul class="nav nav-pills flex-column mb-auto">
                                                    <li class="nav-item">
                                                        <a href="dash/home" class="nav-link active" aria-current="page">
                                                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                                                            Home
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="dash/orders" class="nav-link text-white">
                                                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                                                            Orders
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="dash/addProduct" class="nav-link text-white">
                                                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                                                            Products
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="dash/users" class="nav-link text-white">
                                                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                                                            Customers
                                                        </a>
                                                    </li>
                                                </ul>
                                                <hr>
                                                <div class="dropdown">
                                                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                                        <strong>mdo</strong>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                                        <li><a class="dropdown-item" href="dash/article">New article...</a></li>
                                                        <li><a class="dropdown-item" href="dash/settings">Settings</a></li>
                                                        <li><a class="dropdown-item" href="dash/profil">Profile</a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="dash/logout">Sign out</a></li>
                                                    </ul>
                                                </div>

                    </div>
                </div>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php include $this->view ?>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script><script src="dashboard.js"></script></body>
</body>
</html>