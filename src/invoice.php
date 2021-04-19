<?php
// mettre les titres au dessus des colonnes
// aligner les tirets qui séparent les valeurs
// Ajouter header

require_once 'includes/header.php';
require_once 'Model/InvoicesManager.php';
require_once 'Model/CompaniesManager.php';
require_once 'Model/ContactsManager.php';

$new_object_companies = new CompaniesManager();
$suppliers = $new_object_companies->getCompanies(1);
$clients = $new_object_companies->getCompanies(2);

$new_invoices = new InvoicesManager();
$invoices = $new_invoices->getAllInvoices();

$new_contacts_object = new ContactsManager();
$contacts = $new_contacts_object->getAllContacts();
// echo $contacts;


// while ($invoices == true) {
//     $date = $invoices['invoice_date'];
//     $strY = substr($date, 0, 4);
//     $strM = substr($date, 5, -3);
//     $strD = substr($date, 8, 9);

//     echo '<a href="invoiceDetail.php?code=' . $invoices['invoice_id'] . '" >' . "F" . $strY . $strM . $strD . "-" . $invoices['invoice_id'] . '</a>' .  " | " . $strD . "/" . $strM . "/" . $strY .  " | " . $invoices['name'] . " | " . $invoices['type'] . '<br>';
// }
// $results->closeCursor();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="icon" type="image/png" href="styles/img/cogip-logo.jpeg">
    <title>Home</title>
</head>

<body>
    <?php if (isset($_GET['Invoice'])) {
        echo '<strong><hr>' . 'COGIP : invoice diretory  '  . '<br>';
        echo '<br>'; ?>
        <table>
            <tr style="text-align: center;">
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Company</th>
                <th>Type</th>
            </tr>

            <?php foreach ($invoices as $invoice) { ?>
                <tr>
                    <form action="index.php" method="get">
                        <td>
                            <? echo  '<a href="invoiceDetail.php?code=' . $invoice['invoice_id'] . '" >'."F". $invoice['invoice_date']."-".$invoice['invoice_id']; ?>
                        </td>
                        <td>
                            |
                            <? echo $invoice['invoice_date']; ?> |
                        </td>
                        <td>
                            <? echo $invoice['name']; ?> |
                        </td>
                        <td>
                            <? echo $invoice['type']; ?>
                        </td>

                    </form>
                </tr>
        <?php }
        } ?>

        <?php if (isset($_GET['Companies'])) {
            echo '<strong><hr>' . 'COGIP : companies diretory  '  . '<br>';
            echo '<br>'; ?>
            <h5>Clients :</h5>
            <table>
                <tr style="text-align: center;">
                    <th>Name |</th>
                    <th>TVA |</th>
                    <th>Country |</th>
                </tr>
                <?php foreach ($clients as $company) { ?>
                    <tr>
                        <form action="index.php" method="get">
                            <td>
                                <? echo '<a href="companiesDetail.php?code=' . $company['id_comp'] . '" >' . $company['name']; ?>
                            </td>
                            <td>
                                |
                                <? echo $company['number_vta']; ?> |
                            </td>
                            <td>
                                <? echo $company['country']; ?> |
                            </td>

                        </form>
                    </tr>
                <?php } ?>
            </table>

            <?php echo '<br>';
            echo '<br>';
            ?>


            <h5>Suppliers :</h5>
            <table>
                <tr style="text-align: center;">
                    <th>Name |</th>
                    <th>TVA |</th>
                    <th>Country |</th>
                </tr>
                <?php foreach ($suppliers as $company) { ?>
                    <tr>
                        <form action="index.php" method="get">
                            <td>
                                <? echo '<a href="companiesDetail.php?code=' . $company['id_comp'] . '" >' . $company['name']; ?>
                            </td>
                            <td>
                                |
                                <? echo $company['number_vta']; ?> |
                            </td>
                            <td>
                                <? echo $company['country']; ?> |
                            </td>

                        </form>
                    </tr>
                <?php } ?>
            </table>
        <?php }
        ?>
        <?php if (isset($_GET['Contacts'])) {
            echo '<strong><hr>' . 'COGIP : contacts diretory  '  . '<br>';
            echo '<br>'; ?>
            <table>
                <tr style="text-align: center;">
                    <th>Name</th>
                    <th>Telephone</th>
                    <th>e-mail</th>
                    <th>Company</th>
                </tr>

                <?php foreach ($contacts as $contact) { ?>
                    <tr>
                        <form action="index.php" method="get">
                            <td>
                                <? echo '<a href="peopleDetail.php?code=' . $contact['person_id'] . '" >'.$contact['first_name']." ".$contact['last_name']; ?>
                            </td>
                            <td>
                                |
                                <? echo $contact['phone']; ?> |
                            </td>
                            <td>
                                <? echo $contact['email']; ?> |
                            </td>
                            <td>
                                <? echo $contact['name']; ?>
                            </td>

                        </form>
                    </tr>
            <?php }
            } ?>

           
</body>

</html>