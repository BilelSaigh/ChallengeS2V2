<form
        method="<?= $config["config"]["method"]??"GET" ?>"
        action="<?= $config["config"]["action"] ?>"
        class="<?= $config["config"]["class"]?>"
        id="<?= $config["config"]["id"]?>"
>

    <?php foreach ($config["inputs"] as $name=>$input):?>
        <?php if($input["type"] == "select"): ?>
            <label for="<?= $name?>" class="form-label"> <?= $name?> </label>
            <select name="<?= $name;?>" class="<?= $input["class"]?>"  id="<?= $input["id"]??""?>">
                <?php  foreach ($input["options"] as $option => $value): ?>
                    <option value="<?=  $value ?>"><?= $option?></option>
                <?php endforeach;?>
            </select>
        <?php else: ?>
        <div class="mb-3">
            <label for="<?= $name?>" class="form-label"> <?= ($name == "Image")?"Image de couverture": $name?> </label>
            <input
                            name="<?= $name;?>"
                            type="<?= $input["type"]?>"
                            placeholder=" <?= $input["placeholder"]?>"
                            class="<?= $input["class"]?>"
                            id="<?= $input["id"]??""?>"
                     <?= $input["disabled"]?"disabled": "" ?>
                     <?= $input["accept"] ?? "" ?>
            >
        </div>
        <?php endif;?>
    <?php endforeach; ?>


    <?php
    if($config == "textarea"):
    foreach ($config["textarea"] as $name=>$input):?>
        <div class="mb-3">
            <label for="<?= $name?>" class="form-label"> <?= $name?> </label>
            <textarea
                            name="<?= $name;?>"
                            class="<?= $input["class"]?>"
                            rows="<?= $input["rows"] ?>"
            ></textarea>
        </div>
    <?php endforeach; endif;?>

    <?php if($config["config"]["id"] == "adminForm"): ?>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" name="submit" class="btn btn-primary text-center mx-3 py-2" value="<?= (isset($_POST['edit']))?"Save changes": $config["config"]["submit"] ?>">
        </div>
    <?php elseif($config["config"]["submit"] != ""): ?>
        <input type="submit" name="submit" class="btn btn-primary text-center  py-2" value="<?= $config["config"]["submit"] ?>">
    <?php if(!empty($config["config"]["cancel"])) : ?>
        <input type="reset" class="btn btn-danger" value="<?= $config["config"]["cancel"] ?>">
    <?php endif; endif; ?>
</form>