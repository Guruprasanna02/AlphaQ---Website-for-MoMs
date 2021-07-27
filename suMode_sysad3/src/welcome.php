<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
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

    <title>Welcome</title>
    <style>
        .form-control {
            top: 5px;
            left: 5000px;
            width: 500px;
        }

        .me-2 {
            margin-top: 5;
            margin-right: .5rem !important;
            margin-left: .25rem !important;
        }
    </style>
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <h1 class="text-center mt-5">Welcome <?php echo $_SESSION["username"] ?> !</h1>
    <?php
    include 'partials/_dbconnect.php';
    $sql1 = "SELECT * FROM `MoM`";
    $result1 = mysqli_query($conn, $sql1);
    ?>

    <div class="container">
        <table class="table" align="center">
            <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Date</th>
                    <th scope="col">MoM</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($developer = mysqli_fetch_assoc($result1)) { ?>
                    <tr>
                        <td><?php echo $developer['user']; ?></td>
                        <td><?php echo $developer['date']; ?></td>
                        <td><?php echo $developer['MoM']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="container mt-4">
            Filter with username and date -
            <form action="/welcome.php" method="POST">
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Username</label>
                    <input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'partials/_dbconnect.php';
        $username = $_POST["uname"];
        $date = $_POST["date"];

        $sql2 = "Select * from MoM where user='$username' AND date='$date'";
        $result2 = mysqli_query($conn, $sql2);
        $num = mysqli_num_rows($result2);
        if ($num >= 1) {
            while ($developer = mysqli_fetch_assoc($result2)) {
                echo '<div class="container">
                        <table class="table" align="center">
                            <thead>
                                <tr>
                                    <th scope="col">User</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">MoM</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>' . $developer['user'] . '</td>
                                        <td>' . $developer['date'] . '</td>
                                        <td>' . $developer['MoM'] . '</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>';
            }
        } else {
            echo '<div class="container mt-2">
                    Invalid input
                </div>';
        }
    }

    ?>


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