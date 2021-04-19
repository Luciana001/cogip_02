<?php
    require_once 'includes/header.php';
    require_once 'Controller/InvoicesController.php';
    require_once 'Controller/CompaniesController.php';
    require_once 'Controller/ContactsController.php';
    $new_contact = new ContactsController();
    $new_company = new CompaniesController();
    $new_invoice =  new InvoicesController();

    $companiesNameId = $new_company->getCompaniesNameID();

?>

<?php if (isset($_GET['New_Invoice'])) {  ?>
    <?php include_once 'newInvoiceForm.php'  ?>
<?php } ?>

<?php if(isset($_GET['New_Contact'])){?>
    <?php include_once 'newContactForm.php'  ?>
<?php } ?>

<?php if (isset($_GET['New_Company'])) { ?>
    <?php include_once 'newCompanyForm.php'  ?>
<?php } ?>
<?php require_once 'includes/footer.php'; ?>
