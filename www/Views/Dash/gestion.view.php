<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Front edit</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h3 class="pt-3" >Menu</h3>
            <p  class="pb-3">Add / Remove on menu .</p>
            <div class="row text-center">
                <div class="col-sm-3 align-center">
                    <div class="form-group">
                        <label for="menuPrinc">Add to the principal Menu:</label>
                        <select class="form-select princMenu" aria-label="Default select example">
                            <option selected > Choose the page you wanna add to the menu</option>
                            <?php foreach ($pages as $page) :
                                if ($page->getStatus() && !$page->getMenu()) :?>
                                    <option value="<?=  $page->getId() ?>"><?= $page->getTitle() ?></option>
                                <?php endif; endforeach; ?>
                        </select>

                        <button class="btn btn-primary my-5" id="saveMenu"> Save </button>
                    </div>
                </div>
                <div class="col-sm-3 align-center">
                    <div class="form-group">
                        <label for="menuPrinc">Add to the sub-menu Article:</label>
                        <select class="form-select princSubMenu" aria-label="Default select example">
                            <option selected > Choose the categories you wanna add to the menu</option>
                            <?php foreach ($categories as $category) :
                                if  (!$category->isMenu()) :?>
                                    <option value="<?=  $category->getId() ?>"><?= $category->getTitle() ?></option>
                                <?php endif; endforeach; ?>
                        </select>
                        <button class="btn btn-primary my-5" id="addSubMenu"> Save </button>
                    </div>
                </div>
                <div class="col-sm-3 align-center">
                    <div class="form-group">
                        <label for="menuPrinc">Delete to the principal Menu:</label>
                        <select class="form-select delMenu" aria-label="Default select example">
                            <option selected > Choose the page you wanna delete</option>
                            <?php
                            foreach ($pages as $page) :
                                if ($page->getMenu() == 1) :?>
                                    <option value="<?=  $page->getId() ?>"><?= $page->getTitle() ?></option>
                                <?php endif; endforeach; ?>
                        </select>
                        <button class="btn btn-danger my-5" id="delMenu"> Delete </button>
                    </div>
                </div>
                <div class="col-sm-3 align-center">
                    <div class="form-group">
                        <label for="menuPrinc">Delete to the Sub Menu:</label>
                        <select class="form-select delSubMenu" aria-label="Default select example">
                            <option selected > Choose the page you wanna delete</option>
                            <?php
                            foreach ($categories as $category) :
                                if ($category->isMenu() == 1) :?>
                                    <option value="<?=  $category->getId() ?>"><?= $category->getTitle() ?></option>
                                <?php endif; endforeach; ?>
                        </select>
                        <button class="btn btn-danger my-5" id="delSubMenu"> Delete </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h3 class="pt-3">Front edit </h3>
            <p  class="pb-3">Edit your front page.</p>
            <form action="" method="post" id="fontForm">
                <div  class="row text-center">
                        <div class="col-sm-3 align-center">
                            <div class="form-group">
                                <label for="colorPicker">Paragraph color :</label>
                                <input type="color" id="pColorPicker" class="form-control" name="pColorPicker" value="<?= (!empty($setting) ? $setting->getPColor() : "" )?>">
                            </div>
                            <div class="form-group">
                                <label for="fontSelector">Polices :</label>
                                <select class="form-select font" aria-label="Default select example" name="fontSelector">
                                    <option <?= (!empty($setting) && $setting->getPolices() =="Arial, sans-serif")?"selected": " "  ?> value="Arial, sans-serif">Arial</option>
                                    <option  <?= (!empty($setting) && $setting->getPolices() == "Verdana, sans-serif")?"selected": " "  ?>    value="Verdana, sans-serif">Verdana</option>
                                    <option <?= (!empty($setting) && $setting->getPolices() =="Courier New, monospace")?"selected": " "  ?>    value="Courier New, monospace">Courier New</option>
                                    <option  <?= (!empty($setting) && $setting->getPolices() == "Times New Roman, serif")?"selected": " " ?>   value="Times New Roman, serif">Times New Roman</option>
                                    <option  <?= (!empty($setting) && $setting->getPolices() == "Georgia, serif")?"selected": " "  ?>   value="Georgia, serif">Georgia</option>
                                    <option  <?= (!empty($setting) && $setting->getPolices() == "Roboto, sans-serif")?"selected": " "  ?>   value="Roboto, sans-serif">Roboto</option>
                                    <option  <?= (!empty($setting) && $setting->getPolices() == "Helvetica Neue, sans-serif")?"selected": " "  ?>   value="Helvetica Neue, sans-serif">Helvetica Neue</option>
                                    <option  <?= (!empty($setting) && $setting->getPolices() == "Liberation Sans, sans-serif")?"selected": " "  ?>   value="Liberation Sans, sans-serif">Liberation Sans</option>
                                    <option  <?= (!empty($setting) && $setting->getPolices() == "Segoe UI, sans-serif")?"selected": " "  ?>   value="Segoe UI, sans-serif">Segoe UI</option>
                                    <option  <?= (!empty($setting) && $setting->getPolices() == "System-ui,-apple-system, sans-serif")?"selected": " "  ?>   value="System-ui,-apple-system, sans-serif">System-ui,-apple-system</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="fontSizeSelector">Paragraph size :</label>
                                <select class="form-select fontSize" aria-label="Default select example" name="fontSize">
                                    <option <?= (!empty($setting) && $setting->getPSize() == "12px")?"selected": " " ?>  value="12px">12</option>
                                    <option  <?= (!empty($setting) && $setting->getPSize() == "14px")?"selected": " " ?>  value="14px">14</option>
                                    <option <?= (!empty($setting) && $setting->getPSize() == "16px")?"selected": " " ?>  value="16px">16</option>
                                    <option <?= (!empty($setting) && $setting->getPSize() == "18px")?"selected": " " ?>  value="18px">18</option>
                                    <option  <?= (!empty($setting) && $setting->getPSize() == "20px")?"selected": " " ?> value="20px">20</option>
                                    <option <?= (!empty($setting) && $setting->getPSize() == "24px")?"selected": " " ?>  value="24px">24</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="colorPicker">H1 color :</label>
                                <input type="color" id="hColorPicker" class="form-control" name="hColor" value="<?= (!empty($setting) ? $setting->getH1Color() : "" )?>">
                            </div>

                            <div class="form-group">
                                <label for="buttonColorPicker">Button Color:</label>
                                <input type="color" id="buttonColorPicker" class="form-control" name="btnsColor" value="<?= (!empty($setting) ? $setting->getBtnColor() : "" )?>">
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-primary my-2 text-center" id="newFront" name="newFront" value="Save changes ">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    const addMenu = document.getElementById("saveMenu")
    const addSubMenu = document.getElementById("addSubMenu")
    const delSubMenu = document.getElementById("delSubMenu")
    const delMenu = document.getElementById("delMenu")
    const newFront = document.getElementById("newFront")
    addMenu.addEventListener('click',e =>{
        const princMenu = document.querySelector('.princMenu');
        $.ajax({
            type:'post',
            url:'/dash/setmenu',
            data: { addMenu: 'addMenu', page: princMenu.value},
            success:function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    text: 'The page has been added to your menu',
                    showConfirmButton: false,
                    timer: 1500
                });
                location.reload()

            },
            error:function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'A problem has been encountered',
                    text: 'Call the 0652144163',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    })
    addSubMenu.addEventListener('click',e =>{
        const princMenu = document.querySelector('.princSubMenu');
        $.ajax({
            type:'post',
            url:'/dash/setmenu',
            data: { addSubMenu: 'addSubMenu', page: princMenu.value},
            success:function (response) {
                console.log(response)
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    text: 'The page has been added to your menu',
                    showConfirmButton: false,
                    timer: 1500
                });
                location.reload()

            },
            error:function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'A problem has been encountered',
                    text: 'Call the 0652144163',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    })
    delSubMenu.addEventListener('click', e =>{
        const delMenu = document.querySelector('.delSubMenu')
        $.ajax({
            type:'post',
            url:'/dash/setmenu',
            data: { delSubMenu: 'delSubMenu', page: delMenu.value},
            success:function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    text: 'The page has been delete from your menu',
                    showConfirmButton: false,
                    timer: 1500
                });
                location.reload()
            },
            error:function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'A problem has been encountered',
                    text: 'Call the 0652144163',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    })
    delMenu.addEventListener('click', e =>{
        const delMenu = document.querySelector('.delMenu')
        $.ajax({
            type:'post',
            url:'/dash/setmenu',
            data: { delMenu: 'delMenu', page: delMenu.value},
            success:function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    text: 'The page has been delete from your menu',
                    showConfirmButton: false,
                    timer: 1500
                });
                location.reload()
            },
            error:function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'A problem has been encountered',
                    text: 'Call the 0652144163',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    })

    var form = document.getElementById("fontForm");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        var pColor = form.elements["pColorPicker"].value;
        var font = form.elements["fontSelector"].value;
        var fontSize = form.elements["fontSize"].value;
        var hColor = form.elements["hColor"].value;
        var btnsColor = form.elements["btnsColor"].value;

        console.log("Paragraph Color: " + pColor);
        console.log("Font: " + font);
        console.log("Font Size: " + fontSize);
        console.log("H1 Color: " + hColor);
        console.log("Button Color: " + btnsColor);

        $.ajax({
            type:'post',
            url:'/dash/font',
            data: {
                newFront: 'saveFont',
                pColor: pColor,
                font: font,
                fontSize: fontSize,
                hColor: hColor,
                btnsColor: btnsColor,
            },
            success:function (response) {
                console.log(response)
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    text: 'The page has been delete from your menu',
                    showConfirmButton: false,
                    timer: 1500
                });
                // location.reload()
            },
            error:function (error) {
                console.log(error)
                Swal.fire({
                    icon: 'error',
                    title: 'A problem has been encountered',
                    text: 'Call the 0652144163',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })

    });


</script>