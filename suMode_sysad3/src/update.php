<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
?>
<?php
#$date = $_POST["date"];
if (isset($_POST['next'])) {
    include 'partials/_dbconnect.php';
    $username1 = $_SESSION["username"];
    $date = $_POST["date"];
    $sql2 = "Select * from MoM where user='$username1' AND date='$date'";
    $result2 = mysqli_query($conn, $sql2);
    $num = mysqli_num_rows($result2);
    if ($num >= 1) {
        $disabled = "";
        $val = $_POST['date'];
        #echo $val;
    } else {
        $disabled = " disabled='disabled'";
        $val = "";
        echo '<div class="alert alert-primary" role="alert">
                You were not the last joiner of this meet :)
            </div>';
    }
} else {
    $disabled = " disabled='disabled'";
    $val = "";
}

?>
<?php
if (isset($_POST['final'])) {
    include 'partials/_dbconnect.php';
    $username1 = $_SESSION["username"];
    $mom = $_POST["mom"];
    #echo $mom;

    $sql = "UPDATE MoM SET MoM='$mom' WHERE user='$username1'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<div class="alert alert-success" role="alert">
            MoM updated succesfully!
        </div>';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Update MoM</title>
</head>

<body>
    <a href="welcome.php">Return to welcome page</a>
    <div class=" container mt-5">
        <form action="/update.php" method="POST">
            <div class="mb-2">
                <label for="date" class="form-label">Input the date you want to update MoM</label>
                <input type="date" class="form-control" id="date" name="date" aria-describedby="emailHelp" value="<?php echo $val; ?>" />
            </div>
            <button type="submit" name="next" class="btn btn-primary">OK</button>
        </form>
        <form action="/update.php" method="POST">
            <div class="mb-2 mt-3">
                <label for="mom" class="form-label">Update MoM here</label>
                <input type="text" class="form-control" id="mom" name="mom" aria-describedby="emailHelp" <?php echo $disabled; ?> />
            </div>
            <button type=" submit" name="final" class="btn btn-primary" <?php echo $disabled; ?>>update</button>
        </form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>