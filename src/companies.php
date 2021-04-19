<?php
require_once 'includes/header.php';
require_once 'Model/CompaniesManager.php';


$new_object_companies = new CompaniesManager();
$suppliers = $new_object_companies->getCompanies(1);
$clients = $new_object_companies->getCompanies(2);

echo '<strong>' . 'Companies Directory : '  . '<br>';
// $results = $db->query("SELECT * FROM companies JOIN type_of_company ON id_type = typeId WHERE id_type=1 ");
// echo '<strong>' . '<br>';
// echo '<br>';
// while ($donnees = $results->fetch()) {
//     echo '<a href="companiesDetail.php?code=' . $donnees['id_comp'] . '" >' . $donnees['name'] . '</a>' . " | "
//         . $donnees['number_vta'] . " | " . $donnees['country'] . " | " . $donnees['type'] . '<br>';
// }
// $results->closeCursor();

// $results = $db->query("SELECT * FROM companies JOIN type_of_company ON id_type = typeId WHERE id_type=2 ");
// echo '<strong><hr>' . 'Client : '  . '<br>';
// echo '<br>';
// while ($donnees = $results->fetch()) {
//     echo '<a href="companiesDetail.php?code=' . $donnees['id_comp'] . '" >' . $donnees['name'] . '</a>' . " | "
//         . $donnees['number_vta'] . " | " . $donnees['country'] . " | " . $donnees['type'] . '<br>';
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
    <link rel="icon" type="image/png"  href="styles/img/cogip-logo.jpeg">
    <title>Companies</title>
</head>

<body>

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
    <?php require_once 'includes/footer.php'; ?>
