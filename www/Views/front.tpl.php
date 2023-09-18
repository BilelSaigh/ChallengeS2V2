<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$title ?></title>
    <meta name="description" content="Ceci est ma super page">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<body>
    <main>
        <div class="container">
            <?php include $this->view; ?>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?= ($title == "Subscription")? '<script type=text/javascript> 
        const elements = document.getElementsByClassName("form-select");
        console.log(elements)
        if (elements.length > 0) {
            const element = elements[0]; // Access the first element in the collection
            element.value = 4;
            element.style.display = "none";
        }
        </script>
' :"";?>

</body>
</html>