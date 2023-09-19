document.addEventListener("DOMContentLoaded", function() {
    $('.dropdown-item').click(function () {
        const categoryId = $(this).data('category-id');
        const action = $(this).data('action');
        if (action === "delete") {
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
                        url: "deletecategory",
                        data: {id: categoryId},
                        success: function (response) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'The category n°' + categoryId + ' has been deleted.',
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
                        'The category is safe :)',
                        'error'
                    )
                }
            })
        } else {
            const modalElement = document.getElementById("editModal");
            const modal = new bootstrap.Modal(modalElement);
            const form = document.querySelector('#editForm');

            // console.log(form.elements["formCategory"].value )
            $.ajax({
                type: "post",
                url: "editcategory",
                data: { id: categoryId },
                success: function (response) {
                    try {
                        const formData = JSON.parse(response);
                        console.log(formData.content.title)
                        const content = formData.content
                        const hiddenButton = document.createElement("input");
                        hiddenButton.type = "hidden";
                        hiddenButton.name = "id";
                        hiddenButton.value = categoryId;
                        form.appendChild(hiddenButton);
                        form.elements["formCategory"].value = content.title.trim();
                        console.log(content.title.trim())
                        modal.show();
                    }catch (e) {
                        console.error("Error parsing JSON response:", e);
                    }                },
                error: function (error) {
                    console.log(error)
                }
            })
        }
    });
})
