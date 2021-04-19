
<?php 

    if(isset($_GET['invoiceID'])){
        $invoice_id = $_GET["invoiceID"];
        $invoice = $invoicesController->getInvoice($invoice_id);
        $companyOfInvoice = $companiesController->getCompanyById($invoice["company_id"]);
        $company_id = $companyOfInvoice['id_comp'];
        $workers = $contactsController->getPeopleLinkedToCompany($company_id);
        $person = $contactsController->getPersonByIdWithCompany($invoice["personId"]);
        
    }

    if(isset($_POST['company_choice'])){
        $companySelected = $companiesController->getCompanyById($_POST['company_choice']);
        $newWorkers = $contactsController->getPeopleLinkedToCompany($companySelected['id_comp']);
    };
    
    if(isset($_POST["updateInvoice"])){
        $result = $invoicesController->updateInvoice();

        if($result){
            echo "<span class='text text-success'>Invoice updated!</span>";
        } else {
            echo "<span class='text text-danger'>There was an error</span>";
        }
    }
    
?>

<form action="#" name="myForm" method="post">
        <h4>Edit invoice : </h4>
        <div>
            <label>Company Name : </label>
            <select name="company_choice" onchange="myForm.submit();">
                <option value="Select one">Select one</option>
                <?php if(isset($_POST['company_choice'])) {?>
                    <?php foreach ($companiesNameId as $company) {  ?>
                    <option value="<?= $company['id_comp'] ?>" <?php if($company['name'] == $companySelected['name']) echo 'selected' ?>><?php echo $company['name'] ?></option>
                    <?php } ?>
                <?php } else {  ?>
                    <?php foreach ($companiesNameId as $company) {  ?>
                        <option value="<?= $company['id_comp'] ?>" <?php if($company['name'] == $companyOfInvoice['name']) echo 'selected' ?>><?php echo $company['name'] ?></option>
                    <?php }; ?>
                <?php } ?>
                </select>
            </div>
            <div>
                <label>Contact Name : </label>
                <select name="contact_choice">
                    <option value="Select one">Select one</option>
                    <?php if(isset($_POST['company_choice'])) {?>
                    <?php foreach ($newWorkers as $contact) {  ?>
                        <option value="<?=  $contact['person_id'] ?>"><?php echo $contact['first_name']." ".$contact['last_name'] ?></option>
                    <?php } ?>
                <?php } else {  ?>
                    <?php foreach($workers as $contact){  ?>
                        <option value="<?=  $contact['person_id'] ?>" <?php if($contact['first_name'] == $person['first_name']) echo 'selected' ?>><?php echo $contact['first_name']." ".$contact['last_name'] ?></option>
                    <?php } ?>
                <?php } ?>
                   
                </select>
            </div>
            <div>
                <label for="date">Date invoice:</label>
                <input type="date" id="date" name="date_invoice" value="<?php echo $invoice["invoice_date"] ?>">
            </div>
            <div class="button">
                <button type="submit" name='updateInvoice'>Send</button>
            </div>
        </form>