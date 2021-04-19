<?php
require_once 'includes/header.php';
require_once 'Model/ContactsManager.php';

// aligner les colonnes
// Ajouter header
// try {
//     $db = new PDO("mysql:host=remotemysql.com;dbname=nJpHWU5rJ5;port=3306", "nJpHWU5rJ5", "VnjcIEPzgV");
//     // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (Exception $error) {
//     echo $error->getMessage();
//     exit;
// }

$new_contacts_object = new ContactsManager();
$contacts = $new_contacts_object->getAllContacts();

echo '<strong><hr>' . 'COGIP : contacts diretory  '  . '<br>';
echo '<br>';

// while ($donnees = $results->fetch()) {
//     echo '<a href="product.php?code=' . $donnees['person_id'] . '" >' . $donnees['first_name'] . " 
//     " . $donnees['last_name'] . '</a>' .  " | " . $donnees['phone'] . " | " . $donnees['email'] . " | " . $donnees['name']  . '<br>';
// }
// $results->closeCursor();

// $products = $results->fetchAll(PDO::FETCH_ASSOC);
// foreach ($products as $key => $product) {
//     //var_dump($product['productCode']);
//     echo '<li><a href="product.php?code='. $product['person_id'].'" >'.$product['first_name']." ".$product['last_name'].'</a></li>';
// }

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="icon" type="image/png" href="styles/img/cogip-logo.jpeg">
    <title>Contacts</title>
</head>

<body>


    <table>
        <tr style="text-align: center;">
            <th>Name</th>
            <th>Telephone</th>
            <th>e-mail</th>
            <th>Company</th>
        </tr>

        <?php foreach ($contacts as $contact) { ?>
            <tr>
                <form action="index.php" method="get">
                    <td>
                        <? echo '<a href="peopleDetail.php?code=' . $contact['person_id'] . '" >'.$contact['first_name']." ".$contact['last_name']; ?>
                    </td>
                    <td>
                        |
                        <? echo $contact['phone']; ?> |
                    </td>
                    <td>
                        <? echo $contact['email']; ?> |
                    </td>
                    <td>
                        <? echo $contact['name']; ?>
                    </td>

                </form>
            </tr>
        <?php } ?>

        
</body>

</html>