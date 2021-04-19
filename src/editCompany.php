<?php 

    if (isset($_POST['addCompany'])) {
        $result = $companiesController->updateCompany();

        if($result){
            echo "<span class='text text-success'>Company updated!</span><br/>";
            echo "<a href='index.php'>Back</a>";

        } else {
            echo "<span class='text text-danger'>There was an error</span><br/>";
            echo "<a href='index.php'>Back</a>";
        }
      
    };

    if(isset($_GET['companyID'])){
        $company_id = $_GET["companyID"];
        $company = $companiesController->getCompanyById($company_id);
        $typesOfCompany = $companiesController->getTypeOfCompany();
    }

?>
<?php require_once 'includes/header.php' ?>
<form action="#" method="post">
        <h4>Edit company : </h4>
        <div>
            <label for="name">Company Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $company['name'] ?>">
        </div>
        <div>
            <label for="tva_number">TVA Number:</label>
            <input type="text" id="tva_number" name="tva_number" value="<?php echo $company['number_vta'] ?>">
        </div>
        <div>
            <label for="country">Country :</label>
            <input type="text" id="country" name="country" value="<?php echo $company['country'] ?>">
        </div>
        <div>
            <div>
                <label>Company Type : </label>
                <select name="type_choice">
                    <?php foreach($typesOfCompany as $typeOfCompany) {?> 
                        <option value="<?php echo $typeOfCompany["typeId"] ?>" <?php if($company['typeId'] == $typeOfCompany['typeId']) echo 'selected' ?>><?php echo $typeOfCompany["type"] ?></option>
                    <?php }?>
                </select>
            </div>
            <div class="button">
                <button type="submit" name='addCompany'>Send</button>
            </div>
</form>
<?php require_once 'includes/footer.php' ?>