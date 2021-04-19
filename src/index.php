<?php

//echo $_SESSION["access"];

require_once 'session.php';
require_once 'includes/header.php';
require_once 'Model/Manager.php';
require_once 'Model/InvoicesManager.php';
require_once 'Model/ContactsManager.php';
require_once 'Model/CompaniesManager.php';

//New instance of InvoiceManager class
$new_invoices_object = new InvoicesManager();
//Get lasts 5 invoices
$invoices = $new_invoices_object->getLastFive();

//New instance of ContactsManager class
$new_contacts_object = new ContactsManager();
//Get lasts 5 contacts
$contacts = $new_contacts_object->getLastFive();

//New instance of CompaniesManager class
$new_companies_object = new CompaniesManager();
//Get lasts 5 companies
$companies = $new_companies_object->getLastFive();

//============================Buttons Delete=====================================================================
if (isset($_GET['delete_invoice'])) {
    $invoice_id = $_GET['delete_invoice'];
    $new_invoices_object->deleteInvoice($invoice_id);
    echo 'The invoice has been deleted';
}
if (isset($_GET['delete_contact'])) {
    $contact_id = $_GET['delete_contact'];
    $new_contacts_object->deleteContact($contact_id);
    echo 'The contact has been deleted';
}
if (isset($_GET['delete_company'])) {
    $company_id = $_GET['delete_company'];
    $new_companies_object->deleteCompany($company_id);
    echo 'The company has been deleted';
}
//======================================Variables============================================================

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="icon" type="image/png"  href="styles/img/cogip-logo.jpeg">
    <title>Home</title>
</head>

<body>
    <h1>Welcome to COGIP</h1>
    <h4>Bonjour
        <?php if(isset($_SESSION["name"])){ echo $_SESSION["name"].'!'; } ?>
    </h4>


    <?php if (isset($_SESSION["access"]) && ($_SESSION["access"] == "god" || $_SESSION["access"] == "moderator")) { ?>
        <h5>Que voulez-vous faire aujourd'hui?</h5>
        <form action="formAdd.php" method="get">
            <input type='submit' name='New_Invoice' value='+ New Invoice'></input>
            <input type='submit' name='New_Contact' value='+ New Contact'></input>
            <input type='submit' name='New_Company' value='+ New Company'></input>
        </form>
    <?php } ?>

    <h5> Last Invoices :</h5>
    <table>
        <tr style="text-align: center;">
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Company</th>
            <th></th>
        </tr>
        <?php foreach ($invoices as $invoice) { ?>
            <tr>
                <form action="index.php" method="get">
                    <td>
                        <? echo  '<a href="invoiceDetail.php?code=' . $invoice['invoice_id'] . '" >'."F". $invoice['invoice_date']."-".$invoice['invoice_id']; ?>
                    </td>
                    <td>
                        
                        <? echo $invoice['invoice_date']; ?> 
                    </td>
                    <td>
                        <? echo $invoice['name']; ?>
                    </td>
                    <td>
                        <?php if (isset($_SESSION["access"]) && $_SESSION["access"] == "god") { ?>
                            <button type="submit"
                            name="delete_invoice" 
                            id="<?= $invoice['invoice_id'] ?>" 
                            value="<?= $invoice['invoice_id'] ?>"><img src="styles/img/delete.svg" style="height: 30px; width:30px;" alt="delete">
                            </button>
                            <a
                                href="edit.php?invoiceID=<?= $invoice['invoice_id'] ?>"
                            >
                                <img src="styles/img/edit.svg" style="height: 30px; width:30px;" alt="edit">
                            </a>
                        <?php } ?>
                    </td>
                </form>
            </tr>
        <?php } ?>

    </table>
    <h5> Last Contacts :</h5>
    <table>
        <tr style="text-align: center;">
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Company</th>
            <th> </th>
        </tr>
        <?php foreach ($contacts as $contact) { ?>
            <tr>
                <form action="index.php" method="get">
                    <td>
                        <? echo '<a href="peopleDetail.php?code=' . $contact['person_id'] . '" >'.$contact['first_name']." ".$contact['last_name']; ?>
                    </td>
                    <td>
                        
                        <? echo $contact['phone']; ?> 
                    </td>
                    <td>
                        <? echo $contact['email']; ?> 
                    </td>
                    <td>
                        <? echo $contact['name']; ?>
                    </td>
                    <td>
                        <?php if (isset($_SESSION["access"]) && $_SESSION["access"] == "god") { ?>
                            <button type="submit" 
                            name="delete_contact" 
                            id="<?= $contact['person_id'] ?>"
                            value="<?php if(  $contact['person_id'] < 10){ echo '0'. $contact['person_id'];}else echo  $contact['person_id'] ; ?>"><img src="styles/img/delete.svg" style="height: 30px; width:30px;" alt="delete">
                            </button>
                            <a
                                href="edit.php?contactID=<?= $contact['person_id'] ?>"
                            >
                                <img src="styles/img/edit.svg" style="height: 30px; width:30px;" alt="edit">
                            </a>
                        <?php } ?>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <h5> Last Companies :</h5>
    <table>
        <tr style="text-align: center;">
            <th>Name </th>
            <th>TVA </th>
            <th>Country </th>
            <th>Type </th>
            <th> </th>
        </tr>
        <?php foreach ($companies as $company) { ?>
            <tr>
                <form action="index.php" method="get">
                    <td>
                        <? echo '<a href="companiesDetail.php?code=' . $company['id_comp'] . '" >' . $company['name']; ?>
                    </td>
                    <td>
                        
                        <? echo $company['number_vta']; ?> 
                    </td>
                    <td>
                        <? echo $company['country']; ?> 
                    </td>
                    <td>
                        <? echo $company['type']; ?>
                    </td>
                    <td>
                        <?php if (isset($_SESSION["access"]) && $_SESSION["access"] == "god") { ?>
                            <button type="submit" 
                            name="delete_company" 
                            id="<?= $company['id_comp'] ?>"
                            value="<?php if( $company['id_comp'] < 10){ echo '0'.$company['id_comp'];}else echo $company['id_comp'] ; ?>"><img src="styles/img/delete.svg" style="height: 30px; width:30px;" alt="delete">
                            </button>
                            <a
                                href="edit.php?companyID=<?= $company['id_comp'] ?>"
                            >
                                <img src="styles/img/edit.svg" style="height: 30px; width:30px;" alt="edit">
                            </a>
                        <?php } ?>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <?php require_once 'includes/footer.php'; ?>
