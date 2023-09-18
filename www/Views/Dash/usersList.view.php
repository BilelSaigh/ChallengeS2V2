<h2 class="pt-5">All Users</h2>
<div class="d-flex justify-content-end my-3">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark " data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add User
    </button>
</div>
<?php
    if (!empty($errors)){
            echo '<div class="alert alert-danger d-flex align-items-center p-2">
                    <i class="fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                       <h4 class="mb-1 text-dark">Something went wrong ! </h4>';
        foreach ($errors as $error){
            echo '  <span>'.$error.'</span>
                    </div>
                   </div>';
        }
    };
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $this->modal("form",$addUser);?>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modify User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $this->modal("form",$editUser);?>
            </div>

        </div>
    </div>
</div>

<div class="table-responsive small">
    <table class="table  table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" >Full Names</th>
            <th scope="col" >Email</th>
            <th scope="col" >Role</th>
            <th scope="col" >Since</th>
            <th scope="col" >Status</th>
            <th scope="col" >Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) :
            $given_date = new DateTime($user->getDateInserted());
            // Obtenir la date actuelle
            $current_date = new DateTime();
            // Calculer la différence entre les deux dates
            $interval = $current_date->diff($given_date);
            // Extraire le nombre de semaines, mois et jours
            $weeks = floor($interval->days / 7);
            $months = $interval->y * 12 + $interval->m;
            $days = $interval->days;
            $hours = $interval->h;
            $minutes = $interval->i;
            // Construction de la phrase résultante
            $result = "";
            if ($weeks > 0) {
                $result .= "$weeks week" . ($weeks > 1 ? 's' : '') . " ";
            }
            if ($months > 0) {
                $result .= "$months mounth ";
            }
            if ($days > 0) {
                $result .= "$days day" . ($days > 1 ? 's' : '') . " ";
            }
            if ($hours > 0) {
                $result .= "$hours hour" . ($hours > 1 ? 's' : '') . " ";
            }
            if ($minutes > 0) {
                $result .= "$minutes min" . ($minutes > 1 ? 's' : '') . " ";
            } ?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td>
                    <div class="row">
                        <p  class="text-secondary text-hover-primary mb-1"><?= $user->getFirstname()." ". $user->getLastname()?></p>
                    </div>
                </td>
                <td><?= $user->getEmail() ?></td>
                <td>
                    <?= match ($user->getRole()){
                        1 => '<p class="text-info mb-1"> Editor </p>',
                        2 => '<p class="text-secondary-emphasis mb-1">Moderator</p>',
                        3 => '<p class="text-warning-emphasis  mb-1">Customer</p>',
                        default => '<p class="text-primary mb-1">Admin</p>'
                    }
                    ?>
                </td>
                <td><?= $result."ago" ?></td>
                <td><p class="badge text-center rounded-pill <?= ($user->getStatus()==1)?" text-bg-success" : "text-bg-danger"?> px-4"><?= $user->getStatus() ?></p></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-user-id="<?= $user->getId() ?>" data-action="edit">Edit</a>
                            <a class="dropdown-item" href="#" data-user-id="<?= $user->getId() ?>" data-action="delete">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

