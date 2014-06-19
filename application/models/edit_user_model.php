<?php
	error_reporting(0);

	class edit_user_model extends CI_Model {

		 function __construct() {
		 	parent:: __construct();
		 	$this->load->database();
		 }

		 function AddUserForm($postvalue) {
		 	
		 	$postWebsiteId = $postvalue['WebsiteId'];
		 	$this->db->select('*');
		 	$this->db->from('user');
		 	$this->db->where('WebsiteId', $postWebsiteId);
		 	$query = $this->db->get();
		 	$result_array = $query->result_array();
		 	$webid = $result_array[0]['WebsiteId'];
		 	$user_id = $result_array[0]['Id']; 

		 	if($postWebsiteId == $webid) {
		 		$this->db->where('WebsiteId', $webid);
		 		$updateUserFormValues = $this->db->update('user', $postvalue);
		 		$value = array('status' => "updated", 'user_id' => $user_id);
		 		return $value;
		 	} else {
		 		$insertUserFormValues = $this->db->insert('user', $postvalue);
		 		$value = array('status' => "inserted", 'user_id' => $this->db->insert_id());
		 		return $value;
		 	}	
		 	
		 }

		 function DeleteUserMasterTables($userId) {
		 	
		 	$delete = $this->db->query("DELETE FROM `user_practice_area` WHERE UserId = '".$userId."'");
		 	
		 	$deleteUserFederalCourts = $this->db->query("DELETE FROM `user_federal_courts` WHERE UserId = '".$userId."'");
		 	
		 	$deleteUserSpecificAreasofLaw = $this->db->query("DELETE FROM `user_specific_areas_of_law` WHERE UserId = '".$userId."'");
		 	
		 	$deleteUserSpecificLanguages = $this->db->query("DELETE FROM `user_specific_languages` WHERE UserId = '".$userId."'");
		 	
		 	$deleteUserState = $this->db->query("DELETE FROM `user_state` WHERE UserId = '".$userId."'");
		 	
		 	$deleteUserStateCourts = $this->db->query("DELETE FROM `user_state_courts` WHERE UserId = '".$userId."'");
		 }

		 function InsertPracticeArea($user_id, $prac_Id, $sub_prac_name, $status) {
		 	$this->db->select('*');
		 	$this->db->from('sub_practice_areas');
		 	$this->db->where('FieldValue', $sub_prac_name);
		 	$query = $this->db->get();
		 	$result_array = $query->result_array();
		 	$SubPractiseAreaId = $result_array[0]['Id'];
		 	$value = array('UserId' => $user_id, 'PracticeAreaId' => $prac_Id, 'SubPracticeAreaId' => $SubPractiseAreaId);
		 	$insertUserPracticeareaValue = $this->db->insert('user_practice_area', $value);
		 	return $insertUserPracticeareaValue;
		 }


		 function checkCityExistance($cityname, $stateId) {
		 	$this->db->select('FieldValue');
		 	$this->db->from('city');
		 	$this->db->where('StateId', $stateId);
		 	$query = $this->db->get();
		 	$result = $query->result_array();

			for($i=0;$i<count($result);$i++) {
		 		if($result[$i]['FieldValue'] == $cityname) {
		 			$return = "existed";
		 			break;
		 		} else {
		 			$return = "notexisted";
		 		}
		 	}
		 	return $return;
		 }

		 function addNewCityMasterTable($cityname, $stateId) {
		 	$query = $this->db->query("INSERT INTO `city` (FieldValue, StateId) VALUES ('$cityname', '$stateId')");
		 	return $query;
		 }

		 function AddUserPracticeArea($user_id, $prac_Id, $sub_prac_name, $status) {
		 	$this->db->select('*');
		 	$this->db->from('sub_practice_areas');
		 	$this->db->where('FieldValue', $sub_prac_name);
		 	$query = $this->db->get();
		 	$result_array = $query->result_array();
		 	
		 	$SubPractiseAreaId = $result_array[0]['Id'];
		 	$value = array('UserId' => mysql_real_escape_string($user_id), 'PracticeAreaId' => mysql_real_escape_string($prac_Id), 'SubPracticeAreaId' => mysql_real_escape_string($SubPractiseAreaId));

		 	if($status == "updated") {

		 		$this->db->where('UserId', $user_id);
		 		$insertUserPracticeareaValue = $this->db->delete('user_practice_area');

		 		// if($UpdateUserPracticeareaValue == 1) {
		 		// 	$insertUserPracticeareaValue = $this->db->insert('user_practice_area', $value);
		 		// }
		 	} else {
		 		$insertUserPracticeareaValue = $this->db->insert('user_practice_area', $value);
		 	}
		 	return $insertUserPracticeareaValue;
		 }

		 function InsertUserState($user_id, $state_id_get, $city_name_get, $status) {
		 	$this->db->select('*');
		 	$this->db->from('city');
		 	$this->db->where('FieldValue', $city_name_get);
		 	$query = $this->db->get();
		 	$result_array = $query->result_array();
		 	$CityId = $result_array[0]['Id'];
		 	$userStateValue = array("StateId" => $state_id_get, "UserId" => $user_id, "CityId" => $CityId);
		 	$insertStateDetails = $this->db->insert('user_state', $userStateValue);
		 	return $insertStateDetails;
		 }

		 function AddUserState($user_id, $state_id_get, $city_name_get, $status) {
		 	$this->db->select('*');
		 	$this->db->from('city');
		 	$this->db->where('FieldValue', $city_name_get);
		 	$query = $this->db->get();
		 	$result_array = $query->result_array();
		 	$CityId = $result_array[0]['Id'];
		 	$userStateValue = array("StateId" => $state_id_get, "UserId" => $user_id, "CityId" => $CityId);

		 	if($status == "updated") {
		 		$this->db->where('UserId', $user_id);
		 		$insertStateDetails = $this->db->delete('user_state');
		 	} else {
		 		$insertStateDetails = $this->db->insert('user_state', $userStateValue);
		 	}
		 	
		 	return $insertStateDetails;
		 }

		 function getCityValues($stateValues) {
		 	$this->db->select('*');
		 	$this->db->from('state_courts');
		 	$this->db->where('FieldValue', $stateValues);
		 	$query = $this->db->get();
		 	$result_PA = $query->result_array();
		 	
	 		/*$this->db->select('*');
		 	$this->db->from('city');
		 	$this->db->where('StateId', $result_PA[0]['Id']);
		 	$querySP = $this->db->get();
		 	$result  = $querySP->result_array();*/

		 	$querySP = $this->db->query("SELECT * FROM city where StateId='".$result_PA[0]['Id']."' order by FieldValue ASC");
		 	$result  = $querySP->result_array();		 	
		 	return $result;
		 }

		 function InsertUserSPAOL($user_id, $specificareasoflaw_ID, $status) {
		 	$value = array('UserId' => $user_id, 'SpecificAreasofLawId' => $specificareasoflaw_ID);
		 	$insert = $this->db->insert('user_specific_areas_of_law', $value);
		 	return $insert;
		 }

		 function AddUserSPAOL($user_id, $specificareasoflaw_ID, $status) {
		 	$value = array('UserId' => $user_id, 'SpecificAreasofLawId' => $specificareasoflaw_ID);

		 	if($status == "updated") {
		 		$this->db->where('UserId', $user_id);
		 		$insert = $this->db->delete('user_specific_areas_of_law');
		 	} else {
		 		$insert = $this->db->insert('user_specific_areas_of_law', $value);
		 	}
		 	
		 	
		 	return $insert;
		 }

		function InsertUserSpecificlanguage($user_id, $specificlanguagesid_explode_ID, $status){
			$value = array('UserId' => $user_id, 'SpecificLanguagesId' => $specificlanguagesid_explode_ID);
		 	$insertUserSpecificlanguage = $this->db->insert('user_specific_languages', $value);
		 	return $insertUserSpecificlanguage;
		}

		 function AddUserSpecificlanguage($user_id, $specificlanguagesid_explode_ID, $status) {
		 	$value = array('UserId' => $user_id, 'SpecificLanguagesId' => $specificlanguagesid_explode_ID);

		 	if($status == "updated") {
		 		$this->db->where('UserId', $user_id);
		 		$insert = $this->db->delete('user_specific_languages');
		 	} else {
		 		$insertUserSpecificlanguage = $this->db->insert('user_specific_languages', $value);
		 	}
		 	return $insertUserSpecificlanguage;
		 }

		 function InsertUserStateCourtsDetails($user_id, $statecourtId_explode_id,  $status){
		 	$value = array('UserId' => $user_id, 'StateCourtsId' =>  $statecourtId_explode_id);
		 	$insertState = $this->db->insert('user_state_courts', $value);

		 	return $insertState;
		 }

		 function addUserStateCourtsDetails($user_id, $statecourtId_explode_id, $status) {
		 	$value = array('UserId' => $user_id, 'StateCourtsId' =>  $statecourtId_explode_id);

		 	if($status == "updated") {
		 		$this->db->where('UserId', $user_id);
		 		$insert = $this->db->delete('user_state_courts');
		 	} else {
		 		$insertState = $this->db->insert('user_state_courts', $value);
		 	}

		 	return $insertState;
		 }

		 function AddFedaralDetails($user_id, $fedaral_id_get_explode, $status) {
		 	$value = array('UserId' => $user_id, 'FederalCourtsId' => $fedaral_id_get_explode);
		 	$insertFedaral = $this->db->insert('user_federal_courts', $value);
		 	return $insertFedaral;
		 }

		 function InssertFedaralDetails($user_id, $fedaral_id_get_explode, $status){
		 	$value = array('UserId' => $user_id, 'FederalCourtsId' => $fedaral_id_get_explode);
		 	$insertFedaral = $this->db->insert('user_federal_courts', $value);
		 	
		 	return $insertFedaral;
		 }

		 function GetAllCityFromMaster() {
			$this->db->select('*');
			$this->db->from('city');
			$query = $this->db->get();
			return $query->result_array();
		 }

		 function GetAllStatesFromMaster() {
		 	$this->db->select('*');
		 	$this->db->from('state_courts');
		 	$query = $this->db->get();
		 	return $query->result_array();
		 }

		 function insertPractiseArea($value) {
		 	
		 	for($i=0; $i<count($value); $i++) {
		 		$insertintoMasterTablePractisearea = mysql_query("INSERT INTO `practice_area` (PracticeAreaName) VALUES ('$value[$i]')");
		 	} 
		 }

		 function insertSpecificAreasLaws($lawsvalue) {

		 	for($j=0; $j<count($lawsvalue); $j++) {
		 		$insertLaws = mysql_query("INSERT INTO `specific_areas_of_law` (SpecificAreasofLaw) VALUES ('$lawsvalue[$j]')");
		 	}
		 }

		 function insertSpeciicLanguages($SpeakSpecificLanguages) {
		 
		 	for($k=0; $k< count($SpeakSpecificLanguages); $k++) {
		 		$insertSpeciicLanguages = mysql_query("INSERT INTO `specific_languages` (SpecificLanguages) VALUES ('$SpeakSpecificLanguages[$k]')");
		 	}
		 }

		 function insertfedarelCourts($fedarelCourts) {

		 	for($n=0; $n< count($fedarelCourts); $n++) {
		 		$insertFedaralCourts = mysql_query("INSERT INTO `federal_courts` (FederalCourts) VALUES ('$fedarelCourts[$n]')");
		 	}
		 }

		 function insertSubpractisearea($insertSubpractisearea) {

		 	for($l=0; $l<count($insertSubpractisearea); $l++) {
		 		$inserSubpractisearea = mysql_query("INSERT INTO `sub_practice_areas` (PracticeAreaId, SubPracticeAreaName) VALUES ('107', '$insertSubpractisearea[$l]')");
		 	}
		 }


		 function insertCity($city) {

		 	for($i=0; $i<count($city); $i++) {
		 		$insertCity = mysql_query("INSERT INTO `city` (CityName) VALUES ('$city[$i]')");
		 	}
		 }

		 function insertState($states) {

		 	for($k=0; $k<count($states); $k++) {
		 		$insertState = mysql_query("INSERT INTO `state_courts` (StateCourts) VALUES ('$states[$k]')");
		 	}
		 }

		 function getSubpractiseAreaData($practiceAreaId) {
		 	$this->db->select('*');
		 	$this->db->from('sub_practice_areas');
		 	$this->db->where('PracticeAreaId', $practiceAreaId);
		 	$this->db->order_by("FieldValue", "ASC");
		 	$query = $this->db->get();
		 	$result = $query->result_array();
		 	return $result;
		 }

		 function getCity($stateId) {
		 	$this->db->select('*');
		 	$this->db->from('city');
		 	$this->db->where('StateId', $stateId);
		 	$this->db->order_by("FieldValue", "ASC");
		 	$query = $this->db->get();
		 	$result = $query->result_array();
		 	return $result;
		 }

		 function getSubPracticeValues($practicearea) {
		 	$this->db->select('*');
		 	$this->db->from('practice_area');
		 	$this->db->where('FieldValue', $practicearea);
		 	$query = $this->db->get();
		 	$result_PA = $query->result_array();
		 	
	 		$this->db->select('*');
		 	$this->db->from('sub_practice_areas');
		 	$this->db->where('PracticeAreaId', $result_PA[0]['Id']);
		 	$querySP = $this->db->get();
		 	$result  = $querySP->result_array();
		 			 	
		 	return $result;
		 }

	} 
?>