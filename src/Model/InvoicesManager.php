<?php


declare(strict_types=1);
require_once 'Manager.php';

class InvoicesManager extends Manager 
{
    public function getAllInvoices () 
    {
            $db = $this->connectDb();
            $invoices = $db->query("SELECT * FROM invoices JOIN companies ON company_id = id_comp JOIN type_of_company ON id_type = typeId ");
            $result = $invoices->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    }

    public function getLastFive()
    {
        $db = $this->connectDb();
        $lastInvoices = $db->query("SELECT * FROM invoices JOIN companies 
        ON company_id = id_comp ORDER BY id_comp DESC LIMIT 0,5 ");
        $result = $lastInvoices->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getInvoice($code)
    {
        $db = $this->connectDb();
        try {
            $results = $db->prepare(
                "SELECT *
                FROM invoices
                 
                 # The question mark instead of the ID
                 WHERE invoice_id=?"
            );
            //To bind the id variable to the first question mark. 
            $results->bindParam(1, $code, PDO::PARAM_STR);
            //To execute the query set into results object
            $results->execute();
            $product = $results->fetch(PDO::FETCH_ASSOC);
            return $product;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }


    public function getInvoicesLinkedToCompany($company_id)
    {
        $db = $this->connectDb();
        $invoices = $db->query("SELECT * FROM invoices as i JOIN people ON personId = person_id WHERE i.company_id = $company_id  ");
        $result = $invoices->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getInvoicesLinkedToPerson($person_id)
    {
        $db = $this->connectDb();
        $invoices = $db->query("SELECT * FROM invoices JOIN companies ON company_id = id_comp WHERE personId = $person_id  ORDER BY id_comp DESC LIMIT 0,5  ");
        $result = $invoices->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addInvoice ($company, $contact_id, $date)
    {
        $db = $this->connectDb();
        $db->query("INSERT INTO invoices (company_id,personId,invoice_date) VALUES ($company,$contact_id,$date)");
    }

    public function updateInvoiceById($invoice_id, $company_id, $person_id, $invoice_date)
    {
        $db = $this->connectDb();
        try{ 
            $sql = "UPDATE `invoices` SET `company_id`=:company_id,`personId`=:person_id,`invoice_date`=:invoice_date WHERE invoice_id =:invoice_id";
            $result = $db->prepare($sql);
            $result->bindParam(':company_id', $company_id);
            $result->bindParam(':person_id', $person_id);
            $result->bindParam(':invoice_id', $invoice_id);
            $result->bindParam(':invoice_date', $invoice_date);

            $result->execute();
            return true;
       }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
       }
    }

    public function deleteInvoice($invoice_id)
    {
        $db = $this->connectDb();
        $req = $db->query("DELETE FROM invoices WHERE invoice_id = $invoice_id");
        $req->bindParam(':invoice_id', $invoice_id, PDO::PARAM_INT);
    }
}