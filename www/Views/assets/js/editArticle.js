const articleData = document.getElementById("article-data");
const fillTtitle = document.getElementById("title")
const title = articleData.getAttribute("data-title");
const articleId = articleData.dataset.id;
fillTtitle.value = title
const saveButton = document.getElementById("save-button");

let content = JSON.parse(articleData.getAttribute("data-content"));
if (content === "{}"){
    content = {}
}
let previousContentText
let currentContent = '';
if(content.blocks){

     previousContentText = content.blocks.map(block => block.data.text).join("");
}else {
    previousContentText =''
}

const versionList = document.getElementById("versions");

// Charger la liste des versions
fetch('/dash/versionlist',{
    method: 'POST',
        headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({id: articleId})
})
    .then(response => {
        return response.json()
    })
    .then(data => {
        let parseData = JSON.parse(data)
        if (data && parseData.success) {
            if (parseData.versions){
                const versions = parseData.versions;
                // Ajouter chaque version à la liste
                versions.forEach(version => {
                    const listItem = document.createElement("li");
                    listItem.classList.add("list-group-item");
                    listItem.innerHTML = `
                            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#version-${version.id}" aria-expanded="false" aria-controls="version-${version.id}">
                                Version ${version.id}
                            </button>
                            <div class="collapse" id="version-${version.id}">
                                <div class="card card-body">
                                   Version du ${version.created_at}
                                    <button class="btn btn-primary mt-2" onclick="restoreVersion(${version.id})">Restore</button>
                                </div>
                            </div>
                        `;
                    versionList.appendChild(listItem);
                });
            }
        }
    })
    .catch(error => {
        console.error('Erreur lors du chargement de la liste des versions', error);
    });

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
})
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
    data: content,

    onChange: function(api, event) {
        if (event.type === 'addBlock' || event.type === 'deleteBlock') {
            return;
        }
        if (event.type === 'block-changed') {
            editor.save()
                .then(savedData => JSON.stringify(savedData))
                .then(newContentJSON => {
                    const newContent = JSON.parse(newContentJSON);
                    if (newContent.blocks.length > 0 && JSON.stringify(newContent.blocks) !== JSON.stringify([{ type: 'paragraph', data: {} }])) {
                        const newContentText = normalizeText(newContent.blocks.reduce((text, block) => text + block.data.text, ""));
                        const previousContentTextNormalized = normalizeText(previousContentText);

                        if (newContentText !== previousContentTextNormalized) {
                            saveInMemento(newContentJSON);
                            currentContent = newContentJSON;
                            previousContentText = newContentText; // Mettre à jour le texte du contenu précédent
                        }
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la sauvegarde des données', error);
                });
        }
    }
});

function saveInMemento(content) {
    const formMemento = {
        content: content,
        id: articleId,
        title:articleData.getAttribute("data-title"),
        img:document.getElementById('imgArticle').value,
        category:document.getElementById("categorie").value,
        comment: (document.getElementById("isComment")).checked
    };
    fetch('/dash/savememento', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formMemento)
    })
        .then(response => {
            console.log(response.json());return response.json();
        })
        .then(parsedData => {
            console.log(parsedData)
            if (JSON.parse(parsedData).success) {
                const data = JSON.parse(parsedData)
                const restoredContent = JSON.parse(data.restoredContent);
                editor.blocks.clear();
                editor.blocks.render({ blocks: restoredContent.blocks });
            } else {
                swalWithBootstrapButtons.fire(
                    'Error',
                    'Something went wrong !',
                    'error'
                );
            }
        })
        .catch(error => {
            console.error('Erreur lors de l\'enregistrement dans le Memento', error);
            swalWithBootstrapButtons.fire(
                'Error',
                'Something went wrong !',
                'error'
            );
        });
}


function normalizeText(text) {
    const normalizedText = text
        .replace(/&nbsp;/g, ' ')
        .replace(/&amp;/g, '&')
        .replace(/&lt;/g, '<')
        .replace(/&gt;/g, '>')
        .replace(/&quot;/g, '"')
        .replace(/&apos;/g, "'");

    return normalizedText.trim();
}
function restoreVersion(versionId) {
    fetch(`/dash/restoreversion`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: versionId })
    })
        .then(response => {
           return  response.json()
        })
        .then(data => {
            const parsedData = JSON.parse(data)
            console.log(parsedData)
            if (parsedData.success) {
                const restoredContent = JSON.parse(parsedData.restoredContent); // Parse the JSON content
                editor.blocks.clear();
                console.log(restoredContent)
                editor.blocks.render({blocks: restoredContent.blocks});
                saveInMemento(JSON.stringify(restoredContent))

            } else {
                swalWithBootstrapButtons.fire(
                    'Error',
                    'Something went wrong !',
                    'error'
                );
            }
        })
        .catch(error => {
            console.error('Erreur lors de la restauration de la version', error);
            swalWithBootstrapButtons.fire(
                'Error',
                'Something went wrong !',
                'error'
            );
        });
}

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
                id: articleId,
                img: imageInput // Maintenant "url" sera accessible ici
            }
            console.log(formArticle)
            fetch('/dash/newarticle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formArticle)
            }).then(response => {
                return response.json()
            })
                .then(data => {
                    const response = JSON.parse(data)
                    console.log(response)
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
