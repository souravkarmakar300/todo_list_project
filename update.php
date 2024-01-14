<?php
include "./connect.php";

// Update Query
if (isset($_POST['update'])) {
    $update = mysqli_query($conn, "UPDATE todo_list set list='" . ucwords($_POST['item']) . "' where id='" . $_GET['editid'] . "'");
    header("location:./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Update</title>
    <link rel="stylesheet" href="./css/media.css">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 pt-5">
                <a href="./index.php">Show Item</a>
                <form action="" method="post" class="table-bordered shadow bg-body-secondary" id="from2">
                    <h2 class="text-center text1">TODO List Update</h2>
                    <h6 id="msg" class="text-center text-success"></h6>
                    <input type="text" name="item" class="form-control text2" id="item" placeholder="Enter List Item...">
                    <button class="btn btn-primary mt-3 mb-2 text3" name="update" value="update">Update Item</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>