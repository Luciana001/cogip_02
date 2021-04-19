<?php
require_once 'includes/header.php';
require_once 'Model/InvoicesManager.php';
require_once 'Model/CompaniesManager.php';
require_once 'Model/ContactsManager.php';

$new_invoices_object = new InvoicesManager();
$new_companies_object = new CompaniesManager();
$new_contacts_object = new ContactsManager();

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $product = $new_invoices_object->getInvoice($code);

    if ($product == FALSE) {
        echo "This code reference $code doesn't exist in the Database. </br> <a href='invoice.php''>Go back</a>";
        die();
    }
    $date = $product['invoice_date'];
    $strY = substr($date, 0, 4);
    $strM = substr($date, 5, -3);
    $strD = substr($date, 8, 9);
    $newDate = "F" . $strY . $strM . $strD . "-" . $product['invoice_id'];
}

$company_id = $product['company_id'];
$invoice_id = $product['invoice_id'];

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

        Invoice : <?= $newDate ?>

    </h1>


    <h3><strong>
            <hr>Company linked to the invoice<br></h3>
    <p>
        <?php
        $company = $new_companies_object->getCompanyById($company_id);
        echo $company['name'] . ' | ' . $company['number_vta'] . ' | ' . $company['type'] .  '<br>';
        ?>
    <h3><strong>
            <hr>Contact person<br></h3>
    </p>
    <p>
        <?php
        [$person] = $new_contacts_object->getPersonLinkedToInvoice($invoice_id);
        // var_dump($person);
            echo   $person["first_name"] . " " . $person["last_name"]  .  " | " . $person["email"] . " | " . $person["phone"] .  '<br>';
        ?>

        <?php echo '<a href="invoice.php">Go back</a>'; ?>
    </p>
    <?php require_once 'includes/footer.php'; ?>
