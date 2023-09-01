
<h2 class="pt-5">User Profile</h2>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modify Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $this->modal("form",$editUser);?>
            </div>

        </div>
    </div>
</div>
<div class="small">
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $connectedUser->getFirstname()?></td>
                <td><?= $connectedUser->getLastname()?></td>
                <td><?= $connectedUser->getEmail() ?></td>           
                    <!-- ... Dropdown menu ... -->
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item profile" href="#" data-user-id="<?= $connectedUser->getId() ?>" data-action="edit">Edit</a>
                            <a class="dropdown-item profile" href="#" data-user-id="<?= $connectedUser->getId() ?>" data-action="delete">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
