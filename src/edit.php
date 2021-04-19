<?php     

    require_once 'includes/header.php'; 
    require_once "Model/ContactsManager.php";
    require_once 'Controller/ContactsController.php';
    require_once 'Model/CompaniesManager.php';
    require_once 'Controller/CompaniesController.php';
    require_once 'Controller/InvoicesController.php';

    $companiesNameId = $companiesModel-> getCompaniesNameID();

 ?>


<?php if (isset($_GET['invoiceID'])) {  ?>
    <?php include_once 'editInvoice.php'  ?>
<?php } ?>

<?php if(isset($_GET['contactID'])){?>
    <?php include_once 'editContact.php'  ?>
<?php } ?>

<?php if (isset($_GET['companyID'])) { ?>
    <?php include_once 'editCompany.php'  ?>
<?php } ?>
<?php require_once 'includes/footer.php'; ?>