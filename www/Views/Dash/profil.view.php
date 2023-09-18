<h2 class="pt-5"><?= $user->getFirstname()." ". $user->getLastname() ?></h2>
<div class="d-flex justify-content-end my-3">
<!--    Take off the "read only"-->
    <button type="button" class="btn btn-dark " id="editProfil">
        Edit Profil
    </button>
    <button type="button" class="btn btn-danger " id="deleteUser">
        Delete my account
    </button>
    <button type="button" class="btn btn-dark " id="saveBtn">
        Save
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

<div class="container">
    <div class="row">
        <form id="profil" data-role="<?= $_SESSION["user"]["role"] ?>" data-id="<?= $_SESSION["user"]["id"] ?> ">
            <div class="mb-3 row">
                <label for="firstname" class="col-sm-2 col-form-label">Firstname</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="firstname" value="<?=  trim($user->getFirstname())  ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lastname" class="col-sm-2 col-form-label">Lastname</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="lastname" value="<?= trim($user->getLastname())  ?>">
                </div>
            </div>
           <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" readonly class="form-control-plaintext" id="email" value="<?=  trim($user->getEmail()) ?>">
                </div>
            </div>
           <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" readonly class="form-control-plaintext" id="password" value="<?= $user->getPassword() ?>">
                </div>
            </div>
            <?php if($_SESSION["user"]["role"] === 0 ):  ?>
               <div class="mb-3 row">
                    <label for="websiteName" class="col-sm-2 col-form-label">Website Name</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="websiteName" value="<?= trim($front->getWebsiteName() ) ?>">
                    </div>
                </div>
          <?php endif;?>
        </form>
    </div>
</div>

