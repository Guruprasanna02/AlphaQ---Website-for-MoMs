<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/_dbconnect.php';
  $username1 = $_POST["uname"];
  $password1 = $_POST["password"];

  $sql = "Select * from allUsers where user='$username1' AND password='$password1'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    $index = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username1;
    if (isset($_POST['remember'])) {
      setcookie('unamecookie', $username1, time() + 86400);
      setcookie('passcookie', $password1, time() + 86400);
      header("location: welcome.php");
    }
    header("location: welcome.php");
  } else {
    $error = "Invalid credentials";
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

  <title>index</title>
</head>

<body>
  <div class="container">
    <h1 class="text-center mt-5">AlphaQ - Login to view/update MoMs</h1>
    <form action="/index.php" method="POST">
      <div class="mb-3">
        <label for="uname" class="form-label">Username</label>
        <input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp" value="<?php if (isset($_COOKIE['unamecookie'])) {
                                                                                                              echo $_COOKIE['unamecookie'];
                                                                                                            } ?>">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($_COOKIE['passcookie'])) {
                                                                                            echo $_COOKIE['passcookie'];
                                                                                          } ?>">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <?php
    if ($error) {
      echo '<div class="alert alert-danger mt-2" role="alert">
              <strong>Invalid Credentials.</strong>
            </div>';
    }
    ?>
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
