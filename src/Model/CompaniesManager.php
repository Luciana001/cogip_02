<?php

declare(strict_types=1);

// namespace Becode\MVCBoilerplate\model;

require_once('Manager.php');

class CompaniesManager extends Manager
{

    // private $name;

    // public function __construct(string $name)
    // {
    //     $this->name = $name;
    // }

    public function getCompanies($type)
    {
        $db = $this->connectDb();

        $suppliers = $db->query("SELECT * FROM companies JOIN type_of_company ON id_type = typeId WHERE id_type=$type");
        $result = $suppliers->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getLastFive()
    {
        $db = $this->connectDb();
        $lastsCompanies = $db->query("SELECT * FROM companies JOIN type_of_company  ON id_type = typeId ORDER BY id_comp DESC LIMIT 0,5 ");
        $result = $lastsCompanies->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCompaniesNameID()
    {
        $db = $this->connectDb();
        $companiesNameID = $db->query("SELECT id_comp,name FROM companies");
        $result = $companiesNameID->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTypeOfCompany()
    {
        $db = $this->connectDb();
        $typesOfCompany = $db->query("SELECT type, typeId FROM type_of_company");
        $result = $typesOfCompany->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCompanyById($id)
    {
        $db = $this->connectDb();
        $company = $db->query("SELECT * FROM companies JOIN type_of_company ON id_type = typeId WHERE id_comp = $id  ORDER BY id_comp ");
        $result =$company->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    //To display company by id
    public function getCompany(int $companyId)
    {

        $db = $this->connectDb();

        $req = $db->prepare('SELECT ... AS ... 
            FROM ... 
            WHERE id = ?');

        $req->bindParam(1, $this->companyId, PDO::PARAM_STR);
        $req->execute();
        $company = $req->fetch();

        return $company;
    }

    public function addCompany($name_company, $country, $tva_number, $company_type)
    {
        $db = $this->connectDb();
        $db->query("INSERT INTO companies (name,country,number_vta,id_type) VALUES ('$name_company', '$country', '$tva_number', '$company_type')");
    }

    public function updateCompanyById($company_id, $name, $country, $number_vta, $id_type)
    {
        $db = $this->connectDb();
        try{ 
            $sql = "UPDATE `companies` SET `name`=:name,`country`=:country,`number_vta`=:number_vta, `id_type`=:id_type WHERE id_comp =:company_id ";
            $result = $db->prepare($sql);
            $result->bindparam(':company_id',$company_id);
            $result->bindparam(':name',$name);
            $result->bindparam(':id_type',$id_type);
            $result->bindparam(':country',$country);
            $result->bindparam(':number_vta',$number_vta);

            $result->execute();
            return true;
       }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
       }
    }

    public function deleteCompany($company_id)
    {
        $db = $this->connectDb();
        $db->query("DELETE FROM invoices WHERE company_id= $company_id");
        $db->query("DELETE FROM people WHERE company_id= $company_id");
        $db->query("DELETE FROM companies WHERE id_comp= $company_id");
    }
}

$companiesModel = new CompaniesManager();