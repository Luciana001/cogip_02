<?php 

    if (isset($_POST['addContact'])) {
        $new_contact->createContact();
        echo "<p>Success!! <br> The contact has been sended</p>";
        echo "<a href='index.php'>Back</a>";
    };

?>

<form action="#" method="post">
            <h4>Create a new contact : </h4>
            <div>
                <label for="lastName">Name :</label>
                <input type="text" id="lastName" name="lastName">
            </div>
            <div>
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName">
            </div>
            <div>
                <label for="phone">Phone :</label>
                <input type="text" id="phone" name="phone" placeholder="xxx-xxxx">
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="text" id="email" name="email">
            </div>
            <div>
                <label>Company Name : </label>
                <select name="company_choice">
                <?php foreach($companiesNameId as $key => $name){  ?>
                <option value="<?= $name['id_comp'] ?>"><?php echo $name['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="button">
            <button type="submit" name='addContact'>Send</button>
        </div>
</form>