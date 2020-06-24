<?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $name = $firstname . ' ' . $lastname;
    $company = $_POST['company'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $message = $_POST['message'];

    $servername = "ec2-3-215-83-17.compute-1.amazonaws.com";
    $username = "rcfujmvnvlzxon";
    $password = "53b7389205abb917739e964104e911099ed69873c88f5358737313f9f4759e28";
    $dbname = "d744dj1t5nm5g7";


    // Check connection
    try {
        $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        insertToDB($conn);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

    function insertToDB($conn) {
        global $name;
        global $company;
        global $address;
        global $city;
        global $message;

        try {
            $query = "INSERT INTO info(name, company, address, city, message) VALUES (:name, :company, :address, :city, :message)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':message', $message);
            $stmt->execute();
            header("Location: success.html");
        } 
        catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }