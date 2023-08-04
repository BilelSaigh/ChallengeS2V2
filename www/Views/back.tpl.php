<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta name="description" content="Gestionnaire de Adeboc">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="https://sweetalert2.github.io/styles/bootstrap4-buttons.css">
    <link href="../Views/assets/simple-image.css" rel="stylesheet"/>
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
                                <a href="/home" class="nav-link active" aria-current="page">
                                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="/dash/orders" class="nav-link text-white">
                                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                                    Orders
                                </a>
                            </li>
                            <li>
                                <a href="/dash/article" class="nav-link text-white">
                                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                                    Articles
                                </a>
                            </li>
                            <li>
                                <a href="/dash/user" class="nav-link text-white">
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
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.27.2/dist/editorjs.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?= ($title == "Users")? '<script src="../Views/assets/js/usersTable.js"></script>':"";?>
    <?= ($title == "New Article")?'
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="../Views/assets/js/simple-image.js"></script>  
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


<script>
  /**
   * Initialize the Editor
   */
  const editor = new EditorJS({
    autofocus: true,
    tools: {
      image: {
        class: SimpleImage,
        inlineToolbar: true,
        config: {
          placeholder: "Paste image URL"
        }
      },
       header: {
          class: Header,
          inlineToolbar: ["marker", "link"],
          config: {
            placeholder: "Header"
          },
          shortcut: "CMD+SHIFT+H"
        },
        list: {
          class: NestedList,
          inlineToolbar: true,
          shortcut: "CMD+SHIFT+L"
        },

        checklist: {
          class: Checklist,
          inlineToolbar: true,
        },

        quote: {
          class: Quote,
          inlineToolbar: true,
          config: {
            quotePlaceholder: "Enter a quote",
            captionPlaceholder: "Quote\'s author",
          },
          shortcut: "CMD+SHIFT+O"
        },

        warning: Warning,

        marker: {
          class:  Marker,
          shortcut: "CMD+SHIFT+M"
        },

        code: {
          class:  CodeTool,
          shortcut: "CMD+SHIFT+C"
        },

        delimiter: Delimiter,

        inlineCode: {
          class: InlineCode,
          shortcut: "CMD+SHIFT+C"
        },

        linkTool: LinkTool,

        raw: RawTool,

        embed: Embed,

        table: {
          class: Table,
          inlineToolbar: true,
          shortcut: "CMD+ALT+T"
        },
    },

    data: {
      time: 1552744582955,
      blocks: [
        {
          type: "image",
          data: {
            url: "https://cdn.pixabay.com/photo/2017/09/01/21/53/blue-2705642_1280.jpg",
            caption: "Here is a caption field",
            withBorder: false,
            withBackground: false,
            stretched: false
          }
        },
        {
          id: "zcKCF1S7X8",
            type: "header",
            data: {
              text: "Editor.js",
              level: 1
            }
          },
          {
            id: "b6ji-DvaKb",
            type: "paragraph",
            data: {
              text: "Hey. Meet the new Editor. On this page you can see it in action — try to edit this text. Source code of the page contains the example of connection and configuration."
            }
          },
      ],
      version: "2.11.10"
    }
  });

  /**
   * Add handler for the Save button
   */
  const saveButton = document.getElementById("save-button");
  const output = document.getElementById("output");

  saveButton.addEventListener("click", () => {
    editor.save().then( savedData => {
      output.innerHTML = JSON.stringify(savedData, null, 4);
    })
  })
</script>':"";?>
    <?= ($title == "home")? '<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script><script src="dashboard.js"></script></body>
':"";?>

</body>
</html>