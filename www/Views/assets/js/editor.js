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
                    text: "Editeur de texte",
                    level: 1
                }
            },
            {
                id: "b6ji-DvaKb",
                type: "paragraph",
                data: {
                    text: "Start writting..."
                }
            },
        ],
    },

    onChange: function(api, event) {
        console.log("something changed", event)
    }
});

const saveButton = document.getElementById("save-button");
const output = document.getElementById("output");
saveButton.addEventListener("click", () => {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
    if ( document.getElementById("title").value !== "" &&  document.getElementById("categorie").value !== "" ) {
        const title = document.getElementById("title").value;
        const comment = (document.getElementById("isComment")).checked;
        const category = document.getElementById("categorie").value;
        const imageInput = document.getElementById('imgArticle').value;

        editor.save().then(savedData => {
            const formArticle = {
                article: savedData,
                title: title,
                category: category,
                comment: comment,
                img: imageInput // Maintenant "url" sera accessible ici
            }
            fetch('/dash/newarticle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formArticle)
            }).then(response => {
                console.log(response.json())
                return response.json()
            })
                .then(data => {
                    const response = JSON.parse(data)
                    if (response && response.success) {
                        swalWithBootstrapButtons.fire(
                            'Saved!',
                            'Article saved',
                            'success'
                        )
                        setTimeout(function() {
                            window.location.href = '/dash/article';
                        }, 3000);
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Error',
                            'Something went wrong, the title is already used !',
                            'error'
                        )
                    }
                })
                .catch(error => {
                    console.log(error.toString())
                    console.error('Erreur lors de l\'enregistrement des données', JSON.parse(error))
                    swalWithBootstrapButtons.fire(
                        'Error',
                        'Something went wrong!',
                        'error'
                    );
                })
        })
    }else{
        swalWithBootstrapButtons.fire(
            'Error',
            'The title or the category are empty !',
            'error'
        );
    }

})
