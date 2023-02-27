<!DOCTYPE html>
<html>
<head>
    <title>Easter Calculator</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <!-- Add custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="my-5 text-center">Easter Calculator</h1>
        <form method="post" class="my-5">
            <div class="form-group row">
                <label for="start" class="col-sm-2 col-form-label">Start Year:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="start" id="start" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="end" class="col-sm-2 col-form-label">End Year:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="end" id="end" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary">Calculate</button>
                </div>
            </div>
        </form>

        <?php
            // Check if the form has been submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get the user input
                $start_year = intval($_POST['start']);
                $end_year = intval($_POST['end']);

                // Validate the input
                if ($start_year < 1 || $end_year < $start_year) {
                    echo "<div class='alert alert-danger'>Please enter a valid range of years.</div>";
                } else {
                    // Display the results in a table
                    echo "<table class='table table-striped table-bordered table-hover'>";
                    echo "<thead class='thead-dark'><tr><th>Count</th><th>Year</th><th>Easter Date</th></tr></thead>";
                    echo "<tbody>";
                    $count = 0;
                    for ($year = $start_year; $year <= $end_year; $year++) {
                        $count++;
                        $easter_date = calculate_easter_date($year);
                        $formatted_date = date('F j, Y', strtotime($easter_date));
                        echo "<tr><td>$count</td><td>$year</td><td>$formatted_date</td></tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
            }

            // Function to calculate the date of Easter for a given year
            function calculate_easter_date($year) {
                $a = $year % 19;
                $b = floor($year / 100);
                $c = $year % 100;
                $d = floor($b / 4);
                $e = $b % 4;
                $f = floor(($b + 8) / 25);
                $g = floor(($b - $f + 1) / 3);
                $h = (19 * $a + $b - $d - $g + 15) % 30;
                $i = floor($c / 4);
                $k = $c % 4;
                $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
                $m = floor(($a + 11 * $h + 22 * $l) / 451);
                $month = floor(($h + $l - 7 * $m + 114) / 31);
                $day = ($h + $l - 7 * $m + 114) % 31 + 1;
                return date('Y-m-d', strtotime("$year-$month-$day"));
            }
        ?>

    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</body>
</html>
