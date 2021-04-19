<?php 

    if (isset($_POST['addContact'])) {
      
        $result = $contactsController->updateContact();
        if(!$result){
            echo "<span class='text text-danger'>There was an error, please fill up all fields</span>";
        } else {
            echo "<span class='text text-success'>Contact updated!</span>";;
           
        }
    };

    if(isset($_GET['contactID'])){
        $person_id = $_GET["contactID"];
        $person = $contactsModel->getPersonByIdWithCompany($person_id);
        if(!$person){
            echo 'There is no person with that ID';
        } else {
            
?>

        <form action="#" method="post">
                    <h4>Edit contact : </h4>
                    <div>
                        <label for="lastName">Last name :</label>
                        <input type="text" id="lastNamxe" name="lastName" value="<?php echo $person["last_name"] ?>">
                    </div>
                    <div>
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" value="<?php echo $person["first_name"] ?>">
                    </div>
                    <div>
                        <label for="phone">Phone :</label>
                        <input type="text" id="phone" name="phone" placeholder="xxx-xxxx" value="<?php echo $person["phone"] ?>">
                    </div>
                    <div>
                        <label for="email">Email :</label>
                        <input type="text" id="email" name="email" value="<?php echo $person["email"] ?>">
                    </div>
                    <div>
                        <label>Company Name : </label>
                        <select name="company_choice">
                        <?php foreach($companiesNameId as $company){  ?>
                        <option value="<?= $company['id_comp'] ?>" <?php if($company['name'] == $person['name']) echo 'selected' ?>>
                            <?php echo $company['name']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="button">
                    <button type="submit" name='addContact'>Send</button>
                </div>
        </form>
    <?php } ?>
<?php } ?>

<?php require_once 'includes/footer.php'; ?>