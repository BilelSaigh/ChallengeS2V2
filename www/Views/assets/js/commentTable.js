document.addEventListener("DOMContentLoaded", function() {
    const deleteBtn = document.querySelectorAll("#delete");

    deleteBtn.forEach(button => {
        button.addEventListener("click", () => {
            console.log("ok")
            const commentId =$("#delete").data('comment-id');
            console.log(commentId)
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "deletecomment",
                        data: {id: commentId},
                        success: function (response) {
                            console.log(response)
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'The comment n°' + commentId + ' has been deleted.',
                                'success'
                            )
                            document.location.reload();
                        },
                        error: function (error) {
                            swalWithBootstrapButtons.fire(
                                'Error',
                                'Something went wrong !',
                                'error'
                            )
                        }
                    })
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'The comment is safe :)',
                        'error'
                    )
                }
            })
        })
    })
})
