<?php


declare(strict_types=1);
require_once 'Manager.php';

class AdministratorsManager extends Manager 
{
    public function getAllAdministrators() 
    {
            $db = $this->connectDb();
            $contacts = $db->query("SELECT * FROM administrators");
            $result = $contacts->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    }

    public function getAdmin($username, $password)
    {
        $db = $this->connectDb();
        $sql="SELECT * FROM administrators WHERE username=:username AND password=:password";
        $admin = $db->prepare($sql);
        $admin->bindParam(':username', $username);
        $admin->bindParam(':password', $password);
        $admin->execute();
        $result = $admin->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
