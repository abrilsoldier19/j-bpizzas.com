


<?php
    // Connect to the database (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistemaalumnos9";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Replace $alumnoId with the desired Alumno_id value to filter the data
    $alumnoId = 6;
    
    // Query to fetch the student name based on Alumno_id
    $sql = "SELECT name FROM users WHERE id IN (SELECT Alumno_id FROM calificacions WHERE Alumno_id = $alumnoId)";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "Student Name: " . $row["name"] . "<br>";
        }
    } else {
        echo "No students found with the given Alumno_id.";
    }
    
    // Close the connection
    $conn->close();
    ?>





