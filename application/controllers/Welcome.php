<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->layout->title('Company List');
		$getCompaniesListFromHubSpot 				=	getCompaniesListFromHubSpot();
		$this->data['company_list']					=	$getCompaniesListFromHubSpot;
        $this->layout->view('pages/company-list',$this->data);
	}

	public function insertCompanyData(){
	    $getCompanyData = getCompanyData();
	    $companyList = $getCompanyData->data;
	    $insert = 'false';

	    if (!empty($companyList)) {
	        foreach ($companyList as $obj) {
	            $company_data = array(
	                "properties" => [
	                    array("name" => "name", "value" => $obj->nombre),
	                    array("name" => "pais", "value" => $obj->pais),
	                    array("name" => "city", "value" => $obj->ciudad),
	                    array("name" => "address", "value" => $obj->dirección),
	                    array("name" => "cif", "value" => $obj->CIF)
	                ]
	            );

	            $insertDataOnHubSpot = insertDataOnHubSpot($company_data);
	            $data = json_decode($insertDataOnHubSpot);

	            if ($data->status == true) {
	                $insert = 'true'; // Set insert to true if any record is successfully inserted.
	            }
	        }
	    }
	    if ($insert == 'true') {
	    	echo json_encode(array('status'=>'true','message'=>'record(s) inserted successfully'));
	    } else {
	    	echo json_encode(array('status'=>'false','message'=>'record(s) not successfully'));
	    }
	}

	public function company_edit($company_id){
		$this->layout->title('Company Edit');
		$this->data['company_id']				=	$company_id;
		$this->data['company_info']				=	getSinleCompanyInfo($company_id);
        $this->layout->view('pages/company-edit',$this->data);
	}


	public function updateCompany(){
		if(isset($_POST)){
			$this->form_validation->set_rules('name','Company Name','trim|required');
			$this->form_validation->set_rules('city','City','trim|required');
			$this->form_validation->set_rules('pais','Pais','trim|required');
			$this->form_validation->set_rules('address','Address','trim|required');
			$this->form_validation->set_rules('cif','CIF','trim|required');
			if($this->form_validation->run()==false){
				$error['name']						=	form_error('name','<p class="text-danger mb-0">','</p>');
				$error['city']						=	form_error('city','<p class="text-danger mb-0">','</p>');
				$error['pais']						=	form_error('pais','<p class="text-danger mb-0">','</p>');
				$error['address']					=	form_error('address','<p class="text-danger mb-0">','</p>');
				$error['cif']						=	form_error('cif','<p class="text-danger mb-0">','</p>');
				$this->output->set_content_type('application/json')->set_output(json_encode($error));
			}else{
				$company_id 						=	$this->input->post('company_id');
				$name 								=	$this->input->post('name');
				$city 								=	$this->input->post('city');
				$pais 								=	$this->input->post('pais');
				$address 							=	$this->input->post('address');
				$cif 								=	$this->input->post('cif');

				$company_data = array(
	                "properties" => [
	                    array("name" => "name", "value" => $name),
	                    array("name" => "pais", "value" => $pais),
	                    array("name" => "city", "value" => $city),
	                    array("name" => "address", "value" => $address),
	                    array("name" => "cif", "value" => $cif)
	                ]
	            );
	            $updateCompanyInfo 					=	updateCompanyInfo($company_id,$company_data);
			}
		}
	}

	function downloadCSV(){
		$getCompanyData = 	getCompanyData();
	    $companyList 	= 	$getCompanyData->data;


	    $newHeaders 	= 	array('nombre'=>'Name', 'pais'=>'Pais','ciudad'=>'City','dirección'=>'Address','CIF'=>'CIF');
		array_unshift($companyList, (object) $newHeaders);
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="exported_data.csv"');
		$output = fopen('php://output', 'w');


		foreach ($companyList as $row) {
			$row 				=	array(
				$row->nombre,
				$row->pais,
				$row->ciudad,
				$row->dirección,
				$row->CIF
			);
		    fputcsv($output, $row);
		}
		fclose($output);
		exit;
	}
}
