<?php
declare(strict_types = 1);

require_once './Model/ContactsManager.php';

class ContactsController extends ContactsManager
{
    public function createContact() 
    {
        $last_name = $_POST['lastName'];
        $first_name = $_POST['firstName'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $company_id = intval($_POST['company_choice']);

         $result = $this->addContact($first_name, $last_name, $email,  $company_id, $phone);

         if(!$result) {
             echo "There was an error";
         } else {
             echo "ok";
         }
    }

    public function updateContact()
    {
        $last_name = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
        $first_name = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING) ;
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT) ;
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $company_id = intval($_POST['company_choice']);
        $person_id = $_GET['contactID'];

        if(filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($first_name) && !empty($last_name)){
            $result= $this->updateContactById($person_id, $first_name, $last_name, $email, $company_id, $phone);
            return $result;
        } else {
            return false;
        }
        
    }

    //render function with both $_GET and $_POST vars available if it would be needed.
    // public function render(array $GET, array $POST)
    // {
    //     //you should not echo anything inside your controller - only assign vars here
    //     // then the view will actually display them.

    //     //load the view
    //     require './View/single-company.php';
    // }
}

$contactsController = new ContactsController();