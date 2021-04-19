<?php 

    if (isset($_POST['addCompany'])) {
        $new_company->createCompany();
        echo "<p>Success!! <br> The company has been sended</p>";
        echo "<a href='index.php'>Back</a>";
    };

?>

<form action="#" method="post">
        <h4>Create a new company : </h4>
        <div>
            <label for="name">Company Name:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="tva_number">TVA Number:</label>
            <input type="text" id="tva_number" name="tva_number">
        </div>
        <div>
            <label for="country">Country :</label>
            <input type="text" id="country" name="country">
        </div>
        <div>
            <div>
                <label for="phone">Phone :</label>
                <input type="text" id="phone" name="phone" placeholder="xxx-xxxx">
            </div>
            <div>
                <label>Company Type : </label>
                <select name="type_choice">
                    <option value="1">Client</option>
                    <option value="2">Provider</option>
                </select>
            </div>
            <div class="button">
                <button type="submit" name='addCompany'>Send</button>
            </div>
</form>