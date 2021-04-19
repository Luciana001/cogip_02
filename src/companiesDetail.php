<?php
require_once 'includes/header.php';
require_once 'Model/CompaniesManager.php';
require_once 'Model/ContactsManager.php';
require_once 'Model/InvoicesManager.php';

$new_companies_object = new CompaniesManager();
$new_contacts_object = new ContactsManager();
$new_invoices_object = new InvoicesManager();

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $company = $new_companies_object->getCompanyById($code);

    // if($product == FALSE) {
    //     echo "This code reference $code doesn't exist in the Database. </br> <a href='companies.php''>Go back</a>";
    //     die();
    // }
}

$company_id = $company['id_comp'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
    <link rel="icon" type="image/png"  href="styles/img/cogip-logo.jpeg">
    <title>Companies Detail</title>
</head>

<body style="text-align: center;">
    <h1>
        Company : <?= $company['name'] ?>
    </h1>
    <p><strong>TVA :</strong> <?= $company['number_vta'] ?></p>
    <p><strong>Type :</strong> <?= $company['type'] ?></p>

    <h3><strong>
            <hr>Contact persons<br></h3>
    <p>
        <?php
        $people = $new_contacts_object->getPeopleLinkedToCompany($company_id);

        foreach ($people as $person) {
            echo $person['first_name'] . ' ' . $person['last_name'] . ' | ' . $person['phone'] . ' | ' . $person['email'] . '<br>';
        }

        ?>
    <h3><strong>
            <hr>Invoices<br></h3>
    <p>
        <?php
        $invoices = $new_invoices_object->getInvoicesLinkedToCompany($company_id);

        foreach ($invoices as $invoice) {
            $date = $invoice['invoice_date'];
            $strY = substr($date, 0, 4);
            $strM = substr($date, 5, -3);
            $strD = substr($date, 8, 9);

            echo "F" . $strY . $strM . $strD . "-" . $invoice['invoice_id'] . " | " . $strD . "/" . $strM . "/" . $strY . " | " . $invoice['first_name'] . ' ' . $invoice['last_name'] . '<br>';
        }

        ?>

        <?php echo '<a href="companies.php">Go back</a>'; ?>
    </p>
    <?php require_once 'includes/footer.php'; ?>
