<?php
include "./connect.php";
error_reporting(1);

$msg = "";


// Insert Query
if (isset($_POST["add"])) {
    $item = $_POST["item"];

    if (empty($item)) {
        echo "<script>alert('Please Insert Item...')</script>";
    } else {
        $query = mysqli_query($conn, "INSERT INTO todo_list(list)values('" . ucwords($item) . "')");
        $msg = " Item added Successfully";
    }
}
// Delete Query
if ($_GET["mode"] == "delete") {
    $delete = mysqli_query($conn, "DELETE FROM todo_list WHERE id='" . $_GET['deleteid'] . "'");
    // header("location:index.php");
    $msg = " Item Delete";

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO List</title>
    <link rel="stylesheet" href="./css/media.css">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 pt-5">
                <form action="" method="post" class="table-bordered shadow bg-body-secondary" id="from1">
                    <h2 class="text-center text1">TODO List</h2>
                    <h6 id="msg" class="text-success bg-body-secondary">
                     <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>
                    </h6>
                    <input type="text" name="item" class="form-control text2" id="item" placeholder="Enter Item...">
                    <button class="btn btn-primary mt-3 mb-2 text3" name="add" value="add">Add Item</button>
                </form>
            </div>
            <div class="col-md-4 pt-1">
                <table class="table table-bordered shadow" id="userTable">
                    <h2 class="text-center">Item List</h2>
                    <thead>
                        <tr>
                            <th class="text4">Item ID No</th>
                            <th class="text4">Item</th>
                            <th colspan="5" class="text4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Read Query -->
                        <?php
                        $i      = 1;
                        $select = mysqli_query($conn, "SELECT * FROM todo_list order by id desc");
                        while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                            <tr>
                                <td class="text5">
                                    <?php echo $i++; ?>
                                </td>
                                <td class="text5">
                                    <?php echo $row['list']; ?>
                                </td>
                                <td><a href="index.php?deleteid=<?php echo $row['id']; ?>;&mode=delete"
                                        onclick="return confirm('Are you sure?')"> <abbr title="Delete"> <i
                                                class="fa-solid fa-trash-can text-danger"></i> </abbr> </a></td>

                                <td><a href="./update.php?editid=<?php echo $row['id']; ?>;"><abbr title="Edit"><i
                                                class="fa-solid fa-pen-to-square"></i></abbr></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable({
                searching: true,
            });
        });
    </script>
    <!-- <script>
        $("#from1").on('submit', function (e) {
                        e.preventDefault();
                        let item = $("#item").val();
            if( item= " "){
                alert('Please Insert Item...');
            }else{
                $("#msg").text("Data inserted successfully")

            }
        })
    </script> -->
</body>

</html>