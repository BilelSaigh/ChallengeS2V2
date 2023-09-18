const articleData = document.getElementById("editorjs");
const content = JSON.parse(articleData.getAttribute("data-content"));
const editor = new EditorJS({
    readOnly: true,
    tools: {
        image: SimpleImage,
        header:  Header,
        list:NestedList,
        checklist: Checklist,
        quote: Quote,
        warning: Warning,
        marker:  Marker,
        code: CodeTool,
        delimiter: Delimiter,
        inlineCode: InlineCode,
        linkTool: LinkTool,
        raw: RawTool,
        embed: Embed,
        table: Table,
    },
    data: content
});

const reportButtons = document.querySelectorAll(".btn-report");

reportButtons.forEach(button => {
    button.addEventListener("click", () => {
        const id = button.dataset.commentId; // Changed variable name and fixed the data attribute name
        console.log(id);
        fetch(`/dash/reportcomment`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
            .then(response => response.json())
            .then(data => {
                location.reload()
                if (JSON.parse(data).success) {
                    location.reload();
                } else {
                    swalWithBootstrapButtons.fire(
                        'Error',
                        'Something went wrong!',
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error('Error during AJAX request', error);
            });
    });
});

const commentForm = document.getElementById("commentForm");

commentForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission
    const commentInput = document.getElementById("floatingTextarea2");
    const articleIdInput = document.querySelector('input[name="article_id"]');

    const comment = commentInput.value;
    const articleId = articleIdInput.value;

    const requestData = {
        comment: comment,
        article_id: articleId
    };
    console.log(requestData)


    fetch("/dash/addcomment", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    })
        .then(response => {
           return  response.json()
        })
        .then(data => {
            console.log(JSON.parse(data).success)
            if (JSON.parse(data).success) {
                location.reload();
            } else {
                console.error("Error adding comment");
            }
        })
        .catch(error => {
            console.error("Error during AJAX request", error);
        });
});

