<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>MoM</title>
</head>

<body>
  <style>
    h1 {
      text-align: center;
      margin-top: 50px;
    }

    div {
      text-align: center;
    }
  </style>
  <h1>AlphaQ MoMs!</h1>
  <?php
  $servername = "db";
  $username = "root";
  $password = "password";
  $database = "AlphaQMoM";

  $conn = mysqli_connect($servername, $username, $password, $database);

  $sql = "SELECT * FROM `MoM`";
  $result = mysqli_query($conn, $sql);

  $num = mysqli_num_rows($result);
  echo "<br>";
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
        <?php while ($developer = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $developer['user']; ?></td>
            <td><?php echo $developer['date']; ?></td>
            <td><?php echo $developer['MoM']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
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