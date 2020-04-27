<?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $name = $firstname . ' ' . $lastname;
    $company = $_POST['company'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $message = $_POST['message'];

    $servername = "ec2-18-233-32-61.compute-1.amazonaws.com";
    $username = "bxpodyavxegeqz";
    $password = "f5e6dc32b892e2c948a998f38a1a6d8feb061aa441cef26fadf0a0ca8ce22205";
    $dbname = "db1f6hgmq9ijf8";


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