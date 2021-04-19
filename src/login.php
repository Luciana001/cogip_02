<?php
require_once 'Model/LoginManager.php';
include_once 'session.php';
$new_administrators_object = new AdministratorsManager();

if (isset($_POST['login'])) {

    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars($_POST['password']);

    $admin = $new_administrators_object->getAdmin($username, $password);

    if($admin){
        $_SESSION['name']=$admin['first_name'];
        $_SESSION['access'] =$admin['access'];
        header('Location: index.php');
    } else {
        echo "There is no username with those credentials";
    }

    // foreach ($administrators as $administrator) {

    //     if ($username === $administrator['username'] && $password === $administrator['password']) {
    //         $nameConnect = $administrator['first_name'];
    //         $access = $administrator['access'];
    //         $_SESSION['access'] = $access;
    //         $_SESSION['name'] = $nameConnect;
    //         //echo $nameConnect . " " . $access;
    //         // echo $_SESSION['access'];
    //         // echo $_SESSION['name'];
    //         $connect = 1;
    //     };
    // };

};

?>

<?php
require_once 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="icon" type="image/png"  href="styles/img/cogip-logo.jpeg">

	

	<title>Connexion</title>

</head>

<body>
<h4> Connection </h4>
<?php if($connect == 'logged'){ ?>
    <div>
        <p> Bon retour parmis nous! </p>
        <a href="index.php">Go Home</a>
    </div>
<?php }  ?>


    <?php if($connect == 'error'){ ?>
        <p>Login or mdp are bad!</p>
    <?php }  ?>
    <div class="formConnexion">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method='POST'>
        <label for="username">Username</label>
            <input type="text" name="username" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['username']; ?>"></input>
            <label for="password">Password</label>
            <input type="text" name="password" value=""></input>
            <input type="submit" name='login' value="Log in"></input>
        </form>
        <a href="index.php">GO BACK</a>
    </div>
</body>
</html>