<?php
include('connect.php');

$userID = $_GET['id'];

if (isset($_POST['btnEdit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $birthDate = $_POST['birthDate'];

    $updateQuery = "UPDATE userinfo SET firstName='$firstName', lastName='$lastName', birthDate='$birthDate' WHERE userInfoID='$userID'";
    executeQuery($updateQuery);

    header('Location: ./');
}

$query = "SELECT * FROM userinfo WHERE userInfoID = '$userID'";
$result = executeQuery($query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleView.css">

</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card shadow rounded-5 p-5 mt-3">
                    <div class="editClient">
                        Edit Client Information
                    </div>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($user = mysqli_fetch_assoc($result)) {
                            ?>

                            <form method="post">
                                <label for="firstName" style="margin-top:10px; font-weight:bold;">First Name</label>
                                <input value="<?php echo $user['firstName']; ?>" class="mt-3 form-control" type="text"
                                    name="firstName" placeholder="First Name" required>
                                <label for="firstName" style="margin-top:12px; font-weight:bold;">Last Name</label>
                                <input value="<?php echo $user['lastName']; ?>" class="mt-3 form-control" type="text"
                                    name="lastName" placeholder="Last Name" required>
                                <label for="firstName" style="margin-top:12px; font-weight:bold;">Birthday</label>
                                <input value="<?php echo $user['birthDate']; ?>" class="mt-3 form-control" type="date"
                                    name="birthDate" placeholder="Birthday" required>
                                <button class="btnSave btn btn-dark btn-lg" type="submit" name="btnEdit">
                                    Save
                                </button>
                            </form>

                            <?php
                        }
                    } else {
                        echo "<div class='text-center text-danger'>Client not found!</div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>