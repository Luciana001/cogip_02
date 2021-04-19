<?php 

    if (isset($_POST['addInvoice'])) {
        if(isset($_POST['date_invoice'])){
            $new_invoice->createInvoice();
        }
    
        echo "<p>Success!! <br> The invoice has been sended</p>";
        echo "<a href='index.php'>Back</a>";
    };

    if(isset($_POST['company_choice'])){
        $company = $new_company->getCompanyById($_POST['company_choice']);
        //Loads the workers in Contact Name select box
        $workers = $new_contact ->getPeopleLinkedToCompany($company['id_comp']);
    };


 ?>

<?php if (isset($_GET['New_Invoice'])) {  ?>
    <form action="#" name="myForm" method="post">
        <h4>Create a new invoice : </h4>
        <div>
            <label>Company Name : </label>
            <select name="company_choice" onchange="myForm.submit();">
                <? if (isset($_POST["company_choice"])): ?>
                <option value="<?= $company['id_comp'] ?>"><?php echo $company['name'] ?></option>
                <? else: ?>
                <option value="Select one">Select one</option>
                <?php foreach ($companiesNameId as $company) {  ?>
                    <option value="<?= $company['id_comp'] ?>"><?php echo $company['name'] ?></option>
                <?php } ?>
                <? endif; ?>
                </select>
            </div>
            <div>
                <label>Contact Name : </label>
                <select name="contact_choice">
                <option value="Select one">Select one</option>
                <?php foreach($workers as $key => $name){  ?>
                    <option value="<?= $name['person_id'] ?>"><?php echo $name['first_name']." ".$name['last_name'] ?></option>
                <?php } ?>
                </select>
            </div>
            <div>
                <label for="date">Date invoice:</label>
                <input type="date" id="date" name="date_invoice">
            </div>
            <div class="button">
                <button type="submit" name='addInvoice'>Send</button>
            </div>
        </form>
    <?php } ?>