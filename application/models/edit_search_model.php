<?php
	class edit_search_model extends CI_Model {

		function __construct() {
		 	parent:: __construct();
		 	$this->load->database();
		}

		function getSearchByFields() {
			$Status = "A";
			$this->db->select('*');
			$this->db->from('search');
			$this->db->where('Status', $Status);
			$query = $this->db->get();
			return $query->result_array();
		}

		function getSearchByFieldsByID($id, $masterTableName, $foriegnkey) {
			$this->db->select('*');
			$this->db->from($masterTableName);
			$this->db->where($foriegnkey, $id);
			$this->db->order_by("FieldValue", "ASC"); 
			$query = $this->db->get();
			return $query->result_array();
		}

		function getState() {
			$this->db->select('*');
			$this->db->from('state');
			$this->db->order_by("FieldValue", "ASC"); 
			$query = $this->db->get();
			return $query->result_array();
		}

		function getStatecourtallvalues() {
			$this->db->select('*');
			$this->db->from('state_courts');
			$this->db->order_by("FieldValue", "ASC"); 
			$query = $this->db->get();
			return $query->result_array();
		}

		function getFirmSize() {
			$this->db->select('*');
			$this->db->from('firm_size');
			$query = $this->db->get();
			return $query->result_array();
		}

		function getAttorneys() {
			$this->db->select('*');
			$this->db->from('attorneys');
			$query = $this->db->get();
			return $query->result_array();
		}

		function getSub_practice_areas() {
			$this->db->select('*');
			$this->db->from('sub_practice_areas');
			$this->db->order_by("FieldValue", "ASC"); 
			$query = $this->db->get();
			return $query->result_array();
		}

		function getCity() {
			$this->db->select('*');
			$this->db->from('city');
			$this->db->order_by("FieldValue", "ASC"); 
			$query = $this->db->get();
			return $query->result_array();
		}

		function getPracticearea() {
			$this->db->select('*');
			$this->db->from('practice_area');
			$this->db->order_by("FieldValue", "ASC");
			$query = $this->db->get();
			return $query->result_array();
		}

		function getMbeWbe() {
			$this->db->select('*');
			$this->db->from('mbe_wbe');
			$this->db->order_by("FieldValue", "ASC");
			$query = $this->db->get();
			return $query->result_array();
		}

		function getspecificareasoflaw() {
			$this->db->select('*');
			$this->db->from('specific_areas_of_law');
			$this->db->order_by("FieldValue", "ASC");
			$query = $this->db->get();
			return $query->result_array();
		}

		function getSpecificlanguages() {
			$this->db->select('*');
			$this->db->from('specific_languages');
			$this->db->order_by("FieldValue", "ASC");
			$query = $this->db->get();
			return $query->result_array();
		}

		function getMasterDetails($masterTable) {

			if($masterTable != ""){
                if($masterTable=='state'){
	                $queryStr="SELECT state.* FROM user_state JOIN state ON user_state.StateId=state.Id JOIN user ON user_state.UserId=user.Id  WHERE user.Flag='A' GROUP BY state.Id ORDER BY state.FieldValue ASC";
	            }
	            else if($masterTable == "practice_area") {
	            	$queryStr="SELECT practice_area.* FROM user_practice_area JOIN practice_area ON user_practice_area.PracticeAreaId=practice_area.Id JOIN user ON user_practice_area.UserId=user.Id  WHERE user.Flag='A' GROUP BY practice_area.Id ORDER BY practice_area.FieldValue ASC";
	            }
	            else if($masterTable=='specific_areas_of_law'){
	            	$queryStr="SELECT specific_areas_of_law.* FROM user_specific_areas_of_law JOIN specific_areas_of_law ON user_specific_areas_of_law.SpecificAreasofLawId=specific_areas_of_law.Id JOIN user ON user_specific_areas_of_law.UserId=user.Id  WHERE user.Flag='A' GROUP BY specific_areas_of_law.Id ORDER BY specific_areas_of_law.FieldValue ASC";
	            }

	            else if($masterTable=='specific_languages'){
	            	$queryStr="SELECT specific_languages.* FROM user_specific_languages JOIN specific_languages ON user_specific_languages.SpecificLanguagesId=specific_languages.Id JOIN user ON user_specific_languages.UserId=user.Id  WHERE user.Flag='A' GROUP BY specific_languages.Id ORDER BY specific_languages.FieldValue ASC";
	            }
	            else if($masterTable=='state_courts'){
	            	$queryStr="SELECT state_courts.* FROM user_state_courts JOIN state_courts ON user_state_courts.StateCourtsId=state_courts.Id JOIN user ON user_state_courts.UserId=user.Id  WHERE user.Flag='A' GROUP BY state_courts.Id ORDER BY state_courts.FieldValue ASC";
	            }

	            else if($masterTable=='federal_courts'){
	            	$queryStr="SELECT federal_courts.* FROM user_federal_courts JOIN federal_courts ON user_federal_courts.FederalCourtsId=federal_courts.Id JOIN user ON user_federal_courts.UserId=user.Id  WHERE user.Flag='A' GROUP BY federal_courts.Id ORDER BY federal_courts.FieldValue ASC";
	            }
	            else{
	            	$queryStr="SELECT * from ".$masterTable." ORDER BY FieldValue ASC";	
	            }
	            
				$query=$this->db->query($queryStr);
				$result = $query->result_array();
				return $result;
			}	
		}

		function getfedaralCourts() {
			$this->db->select('*');
			$this->db->from('federal_courts');
			$this->db->order_by("FieldValue", "ASC"); 
			$query = $this->db->get();
			$result=$query->result_array();
			return $result;
		}

		function getUserDetails($userid) {

			$query = $this->db->query("SELECT * FROM `user_federal_courts` WHERE UserId='". $userid ."'");
			$returnArray = array();

			foreach($query->result_array() AS $key=>$value) {
				$FederalCourtsId = $value['FederalCourtsId'];
				$fedaralcourtName = $this->getFedaralCourtValues($FederalCourtsId);

				$federalValue[$key] = $fedaralcourtName[0]['FieldValue'];
				
			}
			$query_parc = $this->db->query("SELECT * FROM `user_practice_area` WHERE UserId = '". $userid ."'");

			
			$prac_id = $pracValue['PracticeAreaId'];
			$subPracticeID = $pracValue['SubPracticeAreaId'];

			$getPracDetails = $this->getPracDetails($userid);

			foreach($getPracDetails AS $keyPraSpa=>$valuePraSpa) {
				$practiceAreaValue[$keyPraSpa] .= $valuePraSpa['practicearea'];
				$subpracticearevalue[$keyPraSpa] .= $valuePraSpa['subpracticearea'];
			}
			$query_user_specific_areas_of_law = $this->db->query("SELECT * FROM `user_specific_areas_of_law` WHERE UserId = '". $userid ."'");

			foreach ($query_user_specific_areas_of_law->result_array() as $key_specific_law => $value_specific_law) {
				$SpecificAreasofLawId = $value_specific_law['SpecificAreasofLawId'];

				$getSpecificAreasofLaw = $this->getSpecificAreasofLawValues($SpecificAreasofLawId);
				$specificlaws[$key_specific_law] = $getSpecificAreasofLaw[0]['FieldValue'];
			}

			$query_specific_languages = $this->db->query("SELECT * FROM `user_specific_languages` WHERE UserId = '". $userid ."'");

			foreach($query_specific_languages->result_array() AS $keysl=>$valuesl) {
				$specificlangId =  $valuesl['SpecificLanguagesId'];

				$getSL = $this->getSpecificLanguage($specificlangId);
				$specificLanguage[$keysl] = $getSL[0]['FieldValue'];
			}
			$queryStateCity = $this->db->query("SELECT * FROM `user_state` WHERE UserId = '". $userid ."'");

		
			$getStateDetails = $this->getStateDetails($userid);

			foreach($getStateDetails AS $keyStCty=>$valueStCty) {
				$state[$keyStCty] .= $valueStCty['state'];
				$city[$keyStCty]  .= $valueStCty['city']; 
			}
			$cityValues[$keyStateCity] = $getCityDetails[0]['FieldValue']; 
			$stateValues[$keyStateCity] = $getStateDetails[0]['FieldValue'];

			$queryStateCourts = $this->db->query("SELECT * FROM `user_state_courts` WHERE UserId='". $userid ."'");

			foreach($queryStateCourts->result_array() AS $keysc=>$valuesc) {
				$statecourtId = $valuesc['StateCourtsId'];

				$getStateCourtValues = $this->getStateCourtValues($statecourtId);
				$stateCourtVal[$keysc] = $getStateCourtValues[0]['FieldValue'];
			}

			$queryfromuser = $this->db->query("SELECT * FROM `user` WHERE Id='". $userid ."'");

			foreach($queryfromuser->result_array() AS $keyUser=>$valueUser) {
				
				$FirmName[$keyUser] = $valueUser['FirmName'];
				$FirmSizevalue[$keyUser] = $valueUser['FirmSize'];
				$RepresentativeTransactions[$keyUser] = $valueUser['RepresentativeTransactions'];
				$RepresentativeCases[$keyUser] = $valueUser['RepresentativeCases'];
				$Attorneys[$keyUser] = $valueUser['Attorneys'];
				$MbeWbeName[$keyUser] = $valueUser['MbeWbeName'];
				$contact[$keyUser] = $valueUser['Address'];
				$mobile[$keyUser] =  $valueUser['PhoneNo'];
				$email[$keyUser] = $valueUser['EmailId'];
				$websiteId[$keyUser] = $valueUser['WebsiteId'];
				$websiteURL[$keyUser] = $valueUser['WebsiteUrl'];
 			}

			$returnArray=array("user_id" => $userid, "fedaralcourt" => $federalValue, 'practicearea' => $practiceAreaValue, 'subpracticearea' => $subpracticearevalue, 'specificAreasofLaws' => $specificlaws, 'specificlanguages' => $specificLanguage, 'city' => $city, 'state' => $state, 'statecourt' => $stateCourtVal, 'FirmName' => $FirmName, 'firmsize' => $FirmSizevalue, 'RepresentativeTransactions' => $RepresentativeTransactions, 'RepresentativeCases' => $RepresentativeCases, 'Attorneys' => $Attorneys, 'MbeWbeName' => $MbeWbeName, 'mobile' => $mobile, 'contact' => $contact, 'email' => $email, 'websiteID' => $websiteId, 'WebsiteUrl' => $websiteURL);
			

			return $returnArray;
		}

		function getStateCourtValues($statecourtId) {
			$query = $this->db->query("SELECT * FROM `state_courts` WHERE Id='". $statecourtId ."'");

			return $query->result_array();
		}

		function getStateDetails($userId) {
			$query = $this->db->query("SELECT state.FieldValue AS state,GROUP_CONCAT(city.FieldValue) AS city FROM`user_state` JOIN `state` ON user_state.StateId=state.Id JOIN `city` ON city.Id=user_state.CityId WHERE user_state.UserId='".$userId."' GROUP BY state.Id");

			return $query->result_array();
		}

		function getCityDetails($citytId) {
			$query = $this->db->query("SELECT * FROM `city` WHERE Id='". $citytId ."'");

			return $query->result_array();
		}

		function getSpecificLanguage($specificlangId) {
			$query = $this->db->query("SELECT * FROM `specific_languages` WHERE Id='". $specificlangId ."'");

			return $query->result_array();
		}

		function getSpecificAreasofLawValues($SpecificAreasofLawId) {
			$query = $this->db->query("SELECT * FROM `specific_areas_of_law` WHERE Id='". $SpecificAreasofLawId ."'");

			return $query->result_array();
		}

		function getPracDetails($userid) {

			$query = $this->db->query("SELECT practice_area.FieldValue AS practicearea,GROUP_CONCAT(sub_practice_areas.FieldValue) AS subpracticearea FROM`user_practice_area` JOIN `practice_area` ON user_practice_area.PracticeAreaId=practice_area.Id JOIN
`sub_practice_areas` ON sub_practice_areas.Id=user_practice_area.SubPracticeAreaId WHERE user_practice_area.UserId='". $userid ."' GROUP BY practice_area.Id");

			return $query->result_array();
		}

		function getSubPractDetails($subPracticeID) {

			$query = $this->db->query("SELECT * FROM `sub_practice_areas` WHERE Id='". $subPracticeID ."'");

			return $query->result_array();
		}

		function getFedaralCourtValues($FederalCourtsId) {
			$query = $this->db->query("SELECT * FROM `federal_courts` WHERE Id='". $FederalCourtsId ."'");

			return $query->result_array();
		}


		function getSearchValues($search_value_array, $sortingtype, $countperpage, $pageno,$sortby) {
			  
		   //echo "<pre>"; print_r($search_value_array);die;

			$where = "";
			$and = "AND"; 
			
			if($search_value_array['firm_name'] != '') {
				$firmname = $search_value_array['firm_name'];
				$where .= "user.FirmName LIKE '%" . $firmname ."%' ";
			}

			if($search_value_array['State'] != '') {
				$State = $search_value_array['State'];
				if($where==""){
                	$where .= " state.StateId IN (".$State .")";
				}else{
					$where .= $and ." "."state.StateId IN (".$State .")";
				}
			}

			if($search_value_array['city'] != '') {
				if(strpos($search_value_array['State'],',')== false){
					$city = $search_value_array['city'];
					if($where==""){
                     $where .= " state.CityId IN (".$city.") ";
					}else{
                     $where .= $and ." "."state.CityId IN (".$city.") ";
					}
			    }
			}

			//echo $where; die;
		
			if(isset($search_value_array['sub_practice_area_value']) && (count($search_value_array['sub_practice_area_value']['PA'])>0)){
				if($where==""){
                	$where=$where." (";
				}else{
                	$where=$where." ".$and ." (";
				}
	            
	            $practiceAreaStr="";
	            $countPracticeArea=count($search_value_array['sub_practice_area_value']['PA']); 
	            $i=0;

				foreach ($search_value_array['sub_practice_area_value']['PA'] as $key => $SubPracticeAreaArray) {
					# code...
					$subPracticeAreaStr="";
					$subPracticeAreaStr .=" "."(pr.PracticeAreaId = ".$key. " ";
					$subStr=implode(",",$SubPracticeAreaArray);
					if($subStr!=""){
	                   $subPracticeAreaStr .=$and ." "."pr.SubPracticeAreaId IN (".$subStr.") ";
					}
					$i++;
					if($countPracticeArea==$i){
	                	$subPracticeAreaStr .=")";
					}else{
						$subPracticeAreaStr .=") OR ";
	                }
	                $practiceAreaStr=$practiceAreaStr.$subPracticeAreaStr;   
				}
				$where=$where.$practiceAreaStr.")";
			}

			//echo $where; die;
			
			if($search_value_array['Mbe_Wbe'] != '') {
				$Mbe_Wbe = $search_value_array['Mbe_Wbe'];
				if($where==""){
					$where .=" "."user.MbeWbeName = ".$Mbe_Wbe. " ";
				} else {
					$where .=$and ." "."user.MbeWbeName = ".$Mbe_Wbe. " ";
				}
				
			}

			if($search_value_array['Firm_Size'] != '') {
				$Firm_Size = $search_value_array['Firm_Size'];
				if($where==""){ 
					$where .=" "."user.FirmSize = ".$Firm_Size. " ";
				} else {
					$where .=$and ." "."user.FirmSize = ".$Firm_Size. " ";
				}
				
			}

			if($search_value_array['Attorneys'] != '') {
				$Attorneys = $search_value_array['Attorneys'];
				if($where==""){ 
					$where .=" "."user.Attorneys = ".$Attorneys. " ";
				} else {
					$where .=$and ." "."user.Attorneys = ".$Attorneys. " ";
				}
			}

			if($search_value_array['Representative_Transactions'] != '') {
				$Representative_Transactions = $search_value_array['Representative_Transactions'];
				if($where==""){ 
					$where .=" "."user.RepresentativeTransactions LIKE '%" . $Representative_Transactions ."%' ";
				} else {
					$where .=$and ." "."user.RepresentativeTransactions LIKE '%" . $Representative_Transactions ."%' ";	 
				}
				
			}

			if($search_value_array['Representative_Cases'] != '') {
				$Representative_Cases = $search_value_array['Representative_Cases'];
				if($where==""){
					$where .=" "."user.RepresentativeCases LIKE '%" . $Representative_Cases ."%' ";
				} else{ 
					$where .=$and ." "."user.RepresentativeCases LIKE '%" . $Representative_Cases ."%' ";
				}
				
			}

			if($search_value_array['specificareas_of_law'] != '') {
				$specificareas_of_law = $search_value_array['specificareas_of_law'];
				$removecommafrom_specificareasoflaw = substr_replace($specificareas_of_law ,"",-1);
				if($where==""){
					$where .=" "."sal.SpecificAreasofLawId IN (".$removecommafrom_specificareasoflaw.") ";
				} else {
					$where .=$and ." "."sal.SpecificAreasofLawId IN (".$removecommafrom_specificareasoflaw.") ";
				}
				
			}

			if($search_value_array['specificlanguages'] != '') {
				$specificlanguages = $search_value_array['specificlanguages'];
				$removecommafrom_specificlanguages = substr_replace($specificlanguages ,"",-1);
				if($where==""){
					$where .=" "."sl.SpecificLanguagesId IN (".$removecommafrom_specificlanguages.") ";
				} else {
					$where .=$and ." "."sl.SpecificLanguagesId IN (".$removecommafrom_specificlanguages.") ";
				}
				
			}

			if($search_value_array['statecourts'] != '') {
				$statecourts = $search_value_array['statecourts'];
				$removecommafrom_statecourt = substr_replace($statecourts ,"",-1);
				if($where==""){ 
					$where .=" "."stcrt.StateCourtsId IN (".$removecommafrom_statecourt.") ";
				} else {
					$where .=$and ." "."stcrt.StateCourtsId IN (".$removecommafrom_statecourt.") ";
				}
			}

			if($search_value_array['fedaralcourts'] != '') {
				$fedaralcourts = $search_value_array['fedaralcourts'];
				$removecommafrom_fedaralcourts = substr_replace($fedaralcourts ,"",-1);
				if($where==""){ 
					$where .=" "."fedaral.FederalCourtsId IN (".$removecommafrom_fedaralcourts.") ";
				} else {
					$where .=$and ." "."fedaral.FederalCourtsId IN (".$removecommafrom_fedaralcourts.") ";
				}
			}
			

			$sortByStr="";
			if($sortby=="FIRMNAME"){
				$sortByStr="ORDER BY user.FirmName ".$sortingtype."";
			}
			if($where != '') {
				$where = "WHERE ".$where;
			}
			 
			 // echo "SELECT user.Id FROM `user` 
    //   			LEFT JOIN `user_federal_courts` AS fedaral ON (user.Id=fedaral.UserId)
	   //          LEFT JOIN `user_practice_area` AS pr ON (user.Id=pr.UserId)
	   //          LEFT JOIN `user_specific_areas_of_law` AS sal ON (user.Id=sal.UserId)     
	   //          LEFT JOIN `user_specific_languages` AS sl ON (user.Id=sl.UserId)
	   //          LEFT JOIN `user_state` AS state ON (user.Id=state.UserId)
	   //          LEFT JOIN `user_state_courts` AS stcrt ON (user.Id=stcrt.UserId)
	   //          ".$where."  GROUP BY user.Id ".$sortByStr." LIMIT ".$pageno.", ".$countperpage."";
			
			$query = $this->db->query("SELECT user.Id FROM `user` 
      			LEFT JOIN `user_federal_courts` AS fedaral ON (user.Id=fedaral.UserId)
	            LEFT JOIN `user_practice_area` AS pr ON (user.Id=pr.UserId)
	            LEFT JOIN `user_specific_areas_of_law` AS sal ON (user.Id=sal.UserId)     
	            LEFT JOIN `user_specific_languages` AS sl ON (user.Id=sl.UserId)
	            LEFT JOIN `user_state` AS state ON (user.Id=state.UserId)
	            LEFT JOIN `user_state_courts` AS stcrt ON (user.Id=stcrt.UserId)
	            ".$where."  GROUP BY user.Id ".$sortByStr." LIMIT ".$pageno.", ".$countperpage."");
			$RowCount = $query->num_rows();
			
			$result = ""; 
			foreach ($query->result_array() as $row) {
    			$result .= $row['Id'] .",";
			}
			
			return $result;
		}

		function getCountSearchRow($search_value_array, $sortingtype, $countperpage, $pageno) {
			$where = "";
			$and = "AND"; 
			
			if($search_value_array['firm_name'] != '') {
				$firmname = $search_value_array['firm_name'];
				$where .= "user.FirmName LIKE '%" . $firmname ."%' ";
			}

			if($search_value_array['State'] != '') {
				$State = $search_value_array['State'];
				if($where==""){
                $where .= " state.StateId IN (".$State .")";
				}else{
				$where .= $and ." "."state.StateId IN (".$State .")";
				}
			}

			if($search_value_array['city'] != '') {
				if(strpos($search_value_array['State'],',')== false){
					$city = $search_value_array['city'];
					if($where==""){
                     $where .= " state.CityId IN (".$city.") ";
					}else{
                     $where .= $and ." "."state.CityId IN (".$city.") ";
					}
			    }
			}

			//echo $where; die;
			
			if(isset($search_value_array['sub_practice_area_value']) && (count($search_value_array['sub_practice_area_value']['PA'])>0)){
				if($where==""){
                	$where=$where." (";
				}else{
                	$where=$where." ".$and ." (";
				}
	            
	            $practiceAreaStr="";
	            $countPracticeArea=count($search_value_array['sub_practice_area_value']['PA']); 
	            $i=0;

				foreach ($search_value_array['sub_practice_area_value']['PA'] as $key => $SubPracticeAreaArray) {
					# code...
					$subPracticeAreaStr="";
					$subPracticeAreaStr .=" "."(pr.PracticeAreaId = ".$key. " ";
					$subStr=implode(",",$SubPracticeAreaArray);
					if($subStr!=""){
	                   $subPracticeAreaStr .=$and ." "."pr.SubPracticeAreaId IN (".$subStr.") ";
					}
					$i++;
					if($countPracticeArea==$i){
	                	$subPracticeAreaStr .=")";
					}else{
						$subPracticeAreaStr .=") OR ";
	                }
	                $practiceAreaStr=$practiceAreaStr.$subPracticeAreaStr;   
				}
				$where=$where.$practiceAreaStr.")";
			}

			//echo $where; die;
			
			if($search_value_array['Mbe_Wbe'] != '') {
				$Mbe_Wbe = $search_value_array['Mbe_Wbe'];
				if($where==""){
					$where .=" "."user.MbeWbeName = ".$Mbe_Wbe. " ";
				} else {
					$where .=$and ." "."user.MbeWbeName = ".$Mbe_Wbe. " ";
				}
				
			}

			if($search_value_array['Firm_Size'] != '') {
				$Firm_Size = $search_value_array['Firm_Size'];
				if($where==""){ 
					$where .=" "."user.FirmSize = ".$Firm_Size. " ";
				} else {
					$where .=$and ." "."user.FirmSize = ".$Firm_Size. " ";
				}
				
			}

			if($search_value_array['Attorneys'] != '') {
				$Attorneys = $search_value_array['Attorneys'];
				if($where==""){ 
					$where .=" "."user.Attorneys = ".$Attorneys. " ";
				} else {
					$where .=$and ." "."user.Attorneys = ".$Attorneys. " ";
				}
			}

			if($search_value_array['Representative_Transactions'] != '') {
				$Representative_Transactions = $search_value_array['Representative_Transactions'];
				if($where==""){ 
					$where .=" "."user.RepresentativeTransactions LIKE '%" . $Representative_Transactions ."%' ";
				} else {
					$where .=$and ." "."user.RepresentativeTransactions LIKE '%" . $Representative_Transactions ."%' ";	 
				}
				
			}

			if($search_value_array['Representative_Cases'] != '') {
				$Representative_Cases = $search_value_array['Representative_Cases'];
				if($where==""){
					$where .=" "."user.RepresentativeCases LIKE '%" . $Representative_Cases ."%' ";
				} else{ 
					$where .=$and ." "."user.RepresentativeCases LIKE '%" . $Representative_Cases ."%' ";
				}
				
			}

			if($search_value_array['specificareas_of_law'] != '') {
				$specificareas_of_law = $search_value_array['specificareas_of_law'];
				$removecommafrom_specificareasoflaw = substr_replace($specificareas_of_law ,"",-1);
				if($where==""){
					$where .=" "."sal.SpecificAreasofLawId IN (".$removecommafrom_specificareasoflaw.") ";
				} else {
					$where .=$and ." "."sal.SpecificAreasofLawId IN (".$removecommafrom_specificareasoflaw.") ";
				}
				
			}

			if($search_value_array['specificlanguages'] != '') {
				$specificlanguages = $search_value_array['specificlanguages'];
				$removecommafrom_specificlanguages = substr_replace($specificlanguages ,"",-1);
				if($where==""){
					$where .=" "."sl.SpecificLanguagesId IN (".$removecommafrom_specificlanguages.") ";
				} else {
					$where .=$and ." "."sl.SpecificLanguagesId IN (".$removecommafrom_specificlanguages.") ";
				}
				
			}

			if($search_value_array['statecourts'] != '') {
				$statecourts = $search_value_array['statecourts'];
				$removecommafrom_statecourt = substr_replace($statecourts ,"",-1);
				if($where==""){ 
					$where .=" "."stcrt.StateCourtsId IN (".$removecommafrom_statecourt.") ";
				} else {
					$where .=$and ." "."stcrt.StateCourtsId IN (".$removecommafrom_statecourt.") ";
				}
			}

			if($search_value_array['fedaralcourts'] != '') {
				$fedaralcourts = $search_value_array['fedaralcourts'];
				$removecommafrom_fedaralcourts = substr_replace($fedaralcourts ,"",-1);
				if($where==""){ 
					$where .=" "."fedaral.FederalCourtsId IN (".$removecommafrom_fedaralcourts.") ";
				} else {
					$where .=$and ." "."fedaral.FederalCourtsId IN (".$removecommafrom_fedaralcourts.") ";
				}
			}
			//$startArticle = ($pageno - 1) * $countperpage;
			if($where != '') {
				$where = "WHERE ".$where;
			}

			$query = $this->db->query("SELECT user.Id FROM `user` 
      			LEFT JOIN `user_federal_courts` AS fedaral ON (user.Id=fedaral.UserId)
	            LEFT JOIN `user_practice_area` AS pr ON (user.Id=pr.UserId)
	            LEFT JOIN `user_specific_areas_of_law` AS sal ON (user.Id=sal.UserId)     
	            LEFT JOIN `user_specific_languages` AS sl ON (user.Id=sl.UserId)
	            LEFT JOIN `user_state` AS state ON (user.Id=state.UserId)
	            LEFT JOIN `user_state_courts` AS stcrt ON (user.Id=stcrt.UserId)
	            ".$where." GROUP BY user.Id ORDER BY user.Id ".$sortingtype."");
			$RowCount = $query->num_rows();
			
			return $RowCount;
		}
	} 
?>