<!DOCTYPE html>
<html>
<head>
    <title>Filtered Student Names</title>
</head>
<body>
    <?php
    // Step 1: Connect to the MySQL database
    $servername = "localhost"; // Replace with your database server name
    $username = "root";     // Replace with your database username
    $password = "";     // Replace with your database password
    $dbname = "sistemaalumnos9";         // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Step 2: Retrieve the student names based on the provided ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query to fetch the student name based on the ID
        $sql = "SELECT name FROM users WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Step 3: Display the names of students using HTML
            while ($row = $result->fetch_assoc()) {
                echo "<p>Student Name: " . $row["name"] . "</p>";
            }
        } else {
            echo "No student found with the given ID.";
        }
    } else {
        echo "Please provide an ID parameter.";
    }

    // Step 4: Close the database connection
    $conn->close();
    ?>
</body>
</html>
