<?php
require_once 'includes/header.php';
require_once 'Model/ContactsManager.php';
require_once 'Model/InvoicesManager.php';

$new_contacts_object = new ContactsManager();
$new_invoices_object = new InvoicesManager();


if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $person =  $new_contacts_object->getPersonByIdWithCompany($code);

    if ($person == FALSE) {
        echo "This code reference $code doesn't exist in the Database. </br> <a href='/''>Go back</a>";
        die();
    }
} else {
    echo "You have to enter a code reference !";
    die();
}
$person_id = $person['person_id'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
    <link rel="icon" type="image/png"  href="styles/img/cogip-logo.jpeg">
    <title>People Detail</title>
</head>

<body style="text-align: center;">
    <h1>
        Contact : <?= $person['first_name'] . " " . $person['last_name'] ?>
    </h1>
    <p><strong>Contact :</strong> <?= $person['first_name'] . " " . $person['last_name'] ?></p>
    <p><strong>Company :</strong> <?= $person['name'] ?></p>
    <p><strong>Email :</strong> <?= $person['email'] ?></p>
    <p><strong>Phone :</strong> <?= $person['phone'] ?></p>
    <h3>
        Contact person for these invoices :
    </h3>
    <p><?php
        $invoices = $new_invoices_object->getInvoicesLinkedToPerson($person_id);
        echo '<strong><hr>' . 'Last invoices: '  . '<br>';
        echo '<br>';
        foreach ($invoices as $invoice) {
            $date = $invoice['invoice_date'];
            $strY = substr($date, 0, 4);
            $strM = substr($date, 5, -3);
            $strD = substr($date, 8, 9);

            echo "F" . $strY . $strM . $strD . "-" . $invoice['invoice_id'] . " | " . $strD . "/" . $strM . "/" . $strY . '<br>';
        }

        ?></p>
    <?php echo '<a href="/">Go back</a>'; ?>
</body>

</html>
