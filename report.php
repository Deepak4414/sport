<?php
include('config.php');

if (isset($_POST['reg'])) {
    $specific_reg = $_POST['reg'];

    $userSql = "SELECT * FROM event WHERE reg = '$specific_reg' ORDER BY `id`";
    $userResult = $conn->query($userSql);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Event Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #ccdd8d; 
                margin: 0;
                padding: 0;
            }

            .main {
                max-width: 800px;
                margin: 20px auto;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1, h2 {
                text-align: center;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                padding: 12px;
                text-align: left;
                border: 1px solid #ddd;
            }

            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <h1>Event Report for Registration No: <?php echo $specific_reg; ?></h1>
            <table>
                <tr>
                    <th>Registration No</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Branch</th>
                </tr>

                <?php
                if ($userResult->num_rows > 0) {
                    while ($row = $userResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["reg"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["year"] . "</td>";
                        echo "<td>" . $row["branch"] . "</td>";
                        echo "</tr>";
                    }
                } 
                ?>
            </table>

            <h2>Events</h2>
            <table>
                <tr>
                    <th>Event</th>
                </tr>

                <?php
                $eventSql = "SELECT events FROM event WHERE reg = '$specific_reg' ORDER BY `id`";
                $eventResult = $conn->query($eventSql);

                if ($eventResult->num_rows > 0) {
                    while ($eventRow = $eventResult->fetch_assoc()) {
                        $eventsArray = explode(',', $eventRow["events"]);

                        foreach ($eventsArray as $event) {
                            echo "<tr>";
                            echo "<td>" . $event . "</td>";
                            echo "</tr>";
                        }
                    }
                } 
                ?>
            </table>
        </div>
    </body>
    </html>

    <?php
    $conn->close();
} 
?>
