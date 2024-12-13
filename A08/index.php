<?php
include('connect.php');

$airlineNameFilter = isset($_GET['airlineName']) ? $_GET['airlineName'] : '';
$aircraftTypeFilter = isset($_GET['aircraftType']) ? $_GET['aircraftType'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : '';


$airportQuery = "SELECT * FROM flightlogs";

if ($airlineNameFilter != '' || $aircraftTypeFilter != '') {
    $airportQuery .= " WHERE";

    if ($airlineNameFilter != '') {
        $airportQuery .= " airlineName='$airlineNameFilter'";
    }

    if ($airlineNameFilter != '' && $aircraftTypeFilter != '') {
        $airportQuery .= " AND";
    }

    if ($aircraftTypeFilter != '') {
        $airportQuery .= " aircraftType='$aircraftTypeFilter'";
    }
}

if ($sort != '') {
    $airportQuery .= " ORDER BY $sort";
    if ($order != '') {
        $airportQuery .= " $order";
    }
}

$airportResult = executeQuery($airportQuery);

$airlineNameQuery = "SELECT DISTINCT(airlineName) FROM flightlogs";
$airlineNameResults = executeQuery($airlineNameQuery);

$aircraftTypeQuery = "SELECT DISTINCT(aircraftType) FROM flightlogs";
$aircraftTypeResults = executeQuery($aircraftTypeQuery);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Airport </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

</head>

<body>
    <h1 class="text-center mt-4">
        Airport
    </h1>
    <h2 class="text-center">
        Departure
    </h2>
<div class="container">
    <div class="row">
        <div class="col">
            <form method="get">
                <div class="card p-5 mt-4 text-center">
                    <div class="filter">Filter</div>

                    <div class="row d-flex justify-content-center">
                        <div class="col mt-5">
                            <label for="airlineSelect" class="airlineName">Airline Name</label>
                            <select id="airlineSelect" name="airlineName" class="my-1 form-control"
                                style="width: fit-content; text-align: center;">
                                <option value="" class="airlineOption">Choose</option>
                                <?php
                                if (mysqli_num_rows($airlineNameResults) > 0) {
                                    while ($airlineNameRow = mysqli_fetch_assoc($airlineNameResults)) {
                                        ?>
                                        <option <?php if ($airlineNameFilter == $airlineNameRow['airlineName']) {
                                            echo "selected";
                                        }
                                        ?> value="<?php echo $airlineNameRow['airlineName']; ?>">
                                            <?php echo $airlineNameRow['airlineName']; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col mt-5">
                            <label for="aircraftTypeSelect" class="aircraftName">Aircraft Type</label>
                            <select id="aircraftTypeSelect" name="aircraftType" class="form-control"
                                style="width: fit-content; text-align: center;">
                                <option value="">Pick</option>
                                <?php
                                if (mysqli_num_rows($aircraftTypeResults) > 0) {
                                    while ($aircraftTypeRow = mysqli_fetch_assoc($aircraftTypeResults)) {
                                        ?>
                                        <option <?php if ($aircraftTypeFilter == $aircraftTypeRow['aircraftType']) {
                                            echo "selected";
                                        }
                                        ?> value="<?php echo $aircraftTypeRow['aircraftType']; ?>">
                                            <?php echo $aircraftTypeRow['aircraftType']; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-1 d-flex justify-content-center">
                        <div class="col mt-5">
                            <label for="sort" class="sortName">Sort By</label>
                            <select id="sort" name="sort" class=" form-control" style="width: fit-content; text-align: center;">
                                <option value="">None</option>
                                <option <?php if ($sort == "arrivalDatetime") {
                                    echo "selected";
                                } ?> value="arrivalDatetime">Arrival Date and Time</option>
                                <option <?php if ($sort == "flightNumber") {
                                    echo "selected";
                                } ?> value="flightNumber">Flight Number</option>
                                <option <?php if ($sort == "departureDatetime") {
                                    echo "selected";
                                } ?> value="departureDatetime">Departure Date and Time</option>
                                <option <?php if ($sort == "passengerCount") {
                                    echo "selected";
                                } ?> value="passengerCount">Passenger Counts</option>
                                <option <?php if ($sort == "flightDurationMinutes") {
                                    echo "selected";
                                } ?> value="flightDurationMinutes">Flight Duration</option>
                            </select>
                        </div>

                        <div class="col mt-5">
                            <label for="order" class="orderName">Order</label>
                            <select id="order" name="order" class=" form-control" style="width: fit-content; text-align: center;">
                                <option <?php if ($order == "ASC") {
                                    echo "selected";
                                } ?> value="ASC">Ascending</option>
                                <option <?php if ($order == "DESC") {
                                    echo "selected";
                                } ?> value="DESC">Descending</option>
                            </select>
                        </div>
                    </div>

                    <div class="container mt-3">
                        <button type="submit" class="btn btn-dark mt-2 btn-lg">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card p-5 mt-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Flight Number</th>
                                <th scope="col">Departure Airport Code</th>
                                <th scope="col">Arrival Airport Code</th>
                                <th scope="col">Departure Date and Time</th>
                                <th scope="col">Arrival Date and Time</th>
                                <th scope="col">Flight Duration Minutes</th>
                                <th scope="col">Airline Name</th>
                                <th scope="col">Aircraft Type</th>
                                <th scope="col">Passenger Count</th>
                                <th scope="col">Ticket Price</th>
                                <th scope="col">Credit Card Number</th>
                                <th scope="col">Credit Card Type</th>
                                <th scope="col">Pilot Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($airportResult) > 0) {
                                while ($airportRow = mysqli_fetch_assoc($airportResult)) {
                                    ?>
                                    <tr>
                                        <th scope="row mx-5"><?php echo $airportRow['flightNumber'] ?></th>
                                        <td><?php echo $airportRow['departureAirportCode'] ?></td>
                                        <td><?php echo $airportRow['arrivalAirportCode'] ?></td>
                                        <td><?php echo $airportRow['departureDatetime'] ?></td>
                                        <td><?php echo $airportRow['arrivalDatetime'] ?></td>
                                        <td><?php echo $airportRow['flightDurationMinutes'] ?></td>
                                        <td><?php echo $airportRow['airlineName'] ?></td>
                                        <td><?php echo $airportRow['aircraftType'] ?></td>
                                        <td><?php echo $airportRow['passengerCount'] ?></td>
                                        <td><?php echo $airportRow['ticketPrice'] ?></td>
                                        <td><?php echo $airportRow['creditCardNumber'] ?></td>
                                        <td><?php echo $airportRow['creditCardType'] ?></td>
                                        <td><?php echo $airportRow['pilotName'] ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>