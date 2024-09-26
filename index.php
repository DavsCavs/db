<?php

    $host = "localhost";
    $user = "php_app";
    $password = "1234";
    $database = "sql_hr";
    $connection = new mysqli($host, $user, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    echo "Connection successful!";

    $sql = "SELECT e.employee_id, e.first_name, e.last_name, m.first_name AS manager_name FROM employees e
            JOIN employees AS m ON m.employee_id = e.reports_to;";
    $result = $connection->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cutomers</h1>

    <?php
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                $customer = 
                    $row["manager_name"] . ", ".
                    $row["employee_id"] . ", " .  
                    $row["first_name"] . ", " .
                    $row["last_name"];
                    // $row["birth_date"] . ", " .
                    // $row["phone"] . ", " .
                    // $row["address"] . ", " .
                    // $row["city"] . ", " .
                    // $row["state"] . ", " .
                    // $row["points"];
                echo "<li>{$customer}</li>";
            }
            echo "</ul>";
        } else {
            echo "No customers found.";
        }
    ?>



</body>
</html>