<!DOCTYPE html>
<html>
<head>
    <title>Basic CRUD Operations</title>
    <style type="text/css">
        body{
            text-align:center;
            font-family: verdana;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <h2>Basic Crud Operation In Php by Waqar Ahmed</h2>

    <?php
    # Make sure replace database data with your own data
    // Database connection parameters
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // CREATE operation
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Record created successfully.<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // READ operation
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Users:</h2>";
        echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['email']."</td>";
            echo "<td><a href='?edit=".$row['id']."'>Edit</a> | <a href='?delete=".$row['id']."'>Delete</a></td></tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }

    // UPDATE operation
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit_mode = true;

        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $email = $row['email'];
        } else {
            echo "Record not found.";
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully.<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // DELETE operation
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sql = "DELETE FROM users WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully.<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>


