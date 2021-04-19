<?php
require_once 'includes/header.php';


try {
    $db = new PDO("mysql:host=remotemysql.com;dbname=nJpHWU5rJ5;port=3306", "nJpHWU5rJ5", "VnjcIEPzgV");
    // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $error) {
    echo $error->getMessage();
    exit;
}

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    try {
        $results = $db->prepare(
            "SELECT *
            FROM people
            JOIN companies
            ON company_id = id_comp
            # The question mark instead of the ID
            WHERE person_id=?"
        );
        //To bind the id variable to the first question mark. 
        $results->bindParam(1, $code, PDO::PARAM_STR);
        //To execute the query set into results object
        $results->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
    // To retreive the information for the one product that matches the ID
    $product = $results->fetch(PDO::FETCH_ASSOC);

    if ($product == FALSE) {
        echo "This code reference $code doesn't exist in the Database. </br> <a href='/''>Go back</a>";
        die();
    }
} else {
    echo "You have to enter a code reference !";
    die();
}
$id = $product['person_id'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
    <link rel="icon" type="image/png"  href="styles/img/cogip-logo.jpeg">
    <title>Product</title>
</head>

<body style="text-align: center;">
    <h1>
        Contact : <?= $product['first_name'] . " " . $product['last_name'] ?>
    </h1>
    <p><strong>Contact :</strong> <?= $product['first_name'] . " " . $product['last_name'] ?></p>
    <p><strong>Company :</strong> <?= $product['name'] ?></p>
    <p><strong>Email :</strong> <?= $product['email'] ?></p>
    <p><strong>Phone :</strong> <?= $product['phone'] ?></p>
    <h3>
        Contact person for these invoices :
    </h3>
    <p><?php
        $results = $db->query("SELECT * FROM invoices JOIN companies ON company_id = id_comp WHERE personId = $id  ORDER BY id_comp DESC LIMIT 0,5  ");
        echo '<strong><hr>' . 'Last invoices: '  . '<br>';
        echo '<br>';
        while ($donnees = $results->fetch()) {
            $date = $donnees['invoice_date'];
            $strY = substr($date, 0, 4);
            $strM = substr($date, 5, -3);
            $strD = substr($date, 8, 9);

            echo "F" . $strY . $strM . $strD . "-" . $donnees['invoice_id'] . " | " . $strD . "/" . $strM . "/" . $strY . '<br>';
        }
        $results->closeCursor();


        ?></p>
    <?php echo '<a href="/">Go back</a>'; ?>
    <?php require_once 'includes/footer.php'; ?>
