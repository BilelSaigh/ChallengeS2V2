<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/keditor/plugins/font-awesome-4.7.0/css/font-awesome.min.css" data-type="keditor-style" />
    <!-- Start of KEditor styles -->
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/dist/css/keditor.css" data-type="keditor-style" />
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/dist/css/keditor-components.css" data-type="keditor-style" />
    <!-- End of KEditor styles -->
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/keditor/plugins/code-prettify/src/prettify.css" />
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/keditor/css/examples.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/Views/keditor-master/keditor/plugins/bootstrap-3.4.1/css/bootstrap.min.css" data-type="keditor-style" />

</head>

<body>
    <?php include $this->view ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/jquery-1.11.3/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/bootstrap-3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/ckeditor-4.11.4/ckeditor.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/formBuilder-2.5.3/form-builder.min.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/formBuilder-2.5.3/form-render.min.js"></script>
    <!-- Start of KEditor scripts -->
    <script type="text/javascript" src="/Views/keditor-master/dist/js/keditor.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/dist/js/keditor-components.js"></script>
    <!-- End of KEditor scripts -->
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/code-prettify/src/prettify.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/js-beautify-1.7.5/js/lib/beautify.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/plugins/js-beautify-1.7.5/js/lib/beautify-html.js"></script>
    <script type="text/javascript" src="/Views/keditor-master/keditor/js/examples.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script type="text/javascript" data-keditor="script">
        $(function () {
            const alertArea = $('#alertArea');

            $('#content-area').keditor();
            $('.fa-save').click(function () {
                const title = $('#title').val()
                console.log(title)
                    console.log(document.getElementById("title").getAttribute("data-page-id"))
                if (title !== "") {
                    const content = $('#content-area').keditor('getContent', true);
                    const pageId = document.getElementById("title").getAttribute("data-page-id")
                    const description = $('#exampleFormControlTextarea1').val()
                    const selectedRadio = document.querySelector('input[name="listGroupRadio"]:checked');
                    let selectedCategoryId = ""
                    if (selectedRadio) {
                        selectedCategoryId = selectedRadio.getAttribute("data-category-id");
                    }
                    fetch('/dash/savepage', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({
                            content: content,
                            title: title,
                            id: selectedCategoryId,
                            description: description,
                            pageId: pageId
                        })
                    })
                        .then(response => {return response.json();})
                        .then(data => {
                            console.log(data)
                            if (JSON.parse(data).success) {
                                console.log("ici")
                                $('#content-area').html($('#content-area').keditor('getContent', true));
                                const succesMessage = 'Successful backup! The changes have been saved successfully!';
                                showAlert('success', succesMessage);
                            }else {
                                const errorMessage = 'An error occurred.Title already exist!';
                                showAlert('danger', errorMessage);
                            }
                        })
                        .catch(error => {
                            console.log(error)

                            const errorMessage = 'An error occurred. Something went cc wrong!';
                            showAlert('danger', errorMessage);
                        })

                }else{
                    const errorMessage = 'An error occurred. Title is empty!!';
                    showAlert('danger', errorMessage);
                }
            });
            function showAlert(type, message) {
                const wrapper = document.createElement('div')
                wrapper.innerHTML = [
                    `<div class="alert alert-${type} alert-dismissible " role="alert">`,
                    `   <div>${message}</div>`,
                    '</div>'
                ].join('')
                alertArea.append(wrapper);

            }
        });

    </script>
</body>
</html>


