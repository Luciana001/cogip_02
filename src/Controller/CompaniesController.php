<?php
declare(strict_types = 1);


require_once './Model/CompaniesManager.php';


class CompaniesController extends CompaniesManager
{

    public function createCompany() 
    {
        $name_company = $_POST['name'];
        $tva_number = $_POST['tva_number'];
        // $phone = $_POST['phone'];
        $country = $_POST['country'];
        $company_type = $_POST['type_choice']; 

        $this->addCompany($name_company, $country, $tva_number, $company_type);
    }

    public function updateCompany()
    {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING) ;
        $tva_number = filter_var($_POST['tva_number'], FILTER_SANITIZE_STRING);
        $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING) ;
        $company_type = intval($_POST['type_choice']);
        $company_id = $_GET['companyID'];

        if(!empty($name) && !empty($tva_number) && !empty($country)){
            $result= $this->updateCompanyById($company_id, $name, $country, $tva_number, $company_type);
            return $result;
        } else {
            return false;
        }
    }
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require './View/single-company.php';
    }


}

$companiesController = new CompaniesController();