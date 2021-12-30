<?php

    include('function.php');

    $objCrudAdmin = new crudApp();

    $students = $objCrudAdmin->displayData();

    if (isset($_GET['status'])) {
        if ($_GET['status'] = 'edit') {
            $id = $_GET['id'];
            $returnData = $objCrudAdmin->displayDataById($id);
        }
    }

    if (isset($_POST['u_add_info'])) {
        $updateMsg = $objCrudAdmin->updateData($_POST);
        header("Location: index.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>CRUD | APP</title>
</head>
<body>
    <div class="container my-4 p-4 shadow">
        <h2><a class="text-decoration-none" href="index.php">Student Database</a></h2>
        <form class="form" action="" method="post" enctype="multipart/form-data">
        <?php if (isset($updateMsg)) {
            echo $updateMsg;
        } ?>

            <input class="form-control mb-2" type="hidden" name="u_id" id="" value="<?php echo $returnData['std_id'] ?>">
            <input class="form-control mb-2" type="text" name="u_std_name" id="" value="<?php echo $returnData['std_name'] ?>">
            <input class="form-control mb-2" type="number" name="u_std_roll" id="" value="<?php echo $returnData['std_roll'] ?>">
            <label for="image">Upload Your Image</label>
            <input class="form-control mb-2" type="file" name="u_std_image" id="">
            <input class="form-control mb-2" type="hidden" name="old_image" id="" value="<?php echo $returnData['std_image'] ?>">
            <input class="form-control bg-warning" type="submit" value="Update Information" name="u_add_info">
        </form>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>