<?php
include('connect.php');

if (isset($_POST['btnSubmitData'])) {
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $birthDate = $_POST['birthDate'];

  $clientQuery = "INSERT INTO userinfo(firstName, lastName, birthDate) VALUES ('$firstName', '$lastName', '$birthDate')";
  $clientResult = executeQuery($clientQuery);

}

$query = "SELECT * FROM userinfo";
$result = executeQuery($query);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Client Database</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container-fluid nav">
    <div class="row">
      <div class="col display-3">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contacts</a>
        <a href="#">Database</a>
      </div>
    </div>
  </div>

  <div class="container client text-center">
    <div class="row">
      <div class="col">
        <h1>Client's Database</h1>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-md-6 col-sm-12 d-flex justify-content-center">
        <form method="post" class="postContainer my-3 mb-5 w-100">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mb-3">
              <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
              <input type="text" class="form-control" name="lastName" placeholder="Last Name" required>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
              <input type="text" class="form-control" name="birthDate" placeholder="Birthday" required>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-dark" name="btnSubmitData">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
          ?>
          <div class="col-lg-5 col-md-6 col-sm-8 col-12 boxInfo mx-3 my-4 mb-4" style="border-radius: 20px; padding:20px">
            <div class="userInfo text-center">User Information</div>
            <div class="fName">First Name: <?php echo $user['firstName']; ?></div>
            <div class="col" style="background-color: white; height: 2px; border-radius: 10px; margin-top: 5px"></div>
            <div class="lName">Last Name: <?php echo $user['lastName']; ?></div>
            <div class="col" style="background-color: white; height: 2px; border-radius: 10px; margin-top: 5px"></div>
            <div class="birthDate">Birthday: <?php echo $user['birthDate']; ?></div>
            <div class="col" style="background-color: white; height: 2px; border-radius: 10px; margin-top: 5px"></div>
          </div>
          <?php
        }
      }
      ?>
    </div>
  </div>


  <div class="container">
    <div class="row justify-content-center">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
          ?>
          <div class="col-lg-5 col-md-6 col-sm-8 col-12 boxInfo mx-3 my-4" style="border-radius: 20px; padding:20px">
            <div class="userInfo text-center">User Information</div>
            <div class="fName">First Name: <?php echo $user['firstName']; ?></div>
            <div class="col" style="background-color: white; height: 2px; border-radius: 10px; margin-top: 5px"></div>
            <div class="lName">Last Name: <?php echo $user['lastName']; ?></div>
            <div class="col" style="background-color: white; height: 2px; border-radius: 10px; margin-top: 5px"></div>
            <div class="birthDate">Birthday: <?php echo $user['birthDate']; ?></div>
            <div class="col" style="background-color: white; height: 2px; border-radius: 10px; margin-top: 5px"></div>
          </div>
          <?php
        }
      }
      ?>
    </div>
  </div>




  <div class="container">
    <div class="row justify-content-center">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
          ?>
          <div class="col-lg-5 col-md-6 col-sm-8 col-12 boxInfo mx-3 my-4" style="border-radius: 20px; padding:20px">
            <div class="userInfo text-center">User Information</div>
            <div class="fName">First Name: <?php echo $user['firstName']; ?></div>
            <div class="col" style="background-color: white; height: 2px; border-radius: 10px; margin-top: 5px"></div>
            <div class="lName">Last Name: <?php echo $user['lastName']; ?></div>
            <div class="col" style="background-color: white; height: 2px; border-radius: 10px; margin-top: 5px"></div>
            <div class="birthDate">Birthday: <?php echo $user['birthDate']; ?></div>
            <div class="col" style="background-color: white; height: 2px; border-radius: 10px; margin-top: 5px"></div>
          </div>
          <?php
        }
      }
      ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>