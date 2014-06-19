<?php
    error_reporting(0);
    
    class edit_user_form extends CI_Controller {
        
        function __construct() {
            parent:: __construct();
            $this->load->library('session');
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->load->model('edit_user_model');
            $this->load->model('edit_search_model');
        }

        function index() {

            $website_id = $_GET['webid'];
            $membershipID = $this->membershipID($website_id);

            $MemberProfileData['city'] = $this->edit_user_model->GetAllCityFromMaster();
            $MemberProfileData['state'] = $this->edit_user_model->GetAllStatesFromMaster();
            $MemberProfileData['ym_api_profile_data'] = $this->MemberProfileData($membershipID);

            $FirmName = $MemberProfileData['ym_api_profile_data']['DFN'];
            $MBE_WBE =  $MemberProfileData['ym_api_profile_data']['DMW'];
            $FirmSize  = $MemberProfileData['ym_api_profile_data']['DFS'];
            $Attorneys = $MemberProfileData['ym_api_profile_data']['DATRNY'];
            $RepresentativeTransactions = $MemberProfileData['ym_api_profile_data']['DRT'];
            $RepresentativeCases = $MemberProfileData['ym_api_profile_data']['DRC'];
            $SpecificAreasofLaw = $MemberProfileData['ym_api_profile_data']['DSAOL'];
            $SpecificLanguages = $MemberProfileData['ym_api_profile_data']['DSL'];
            $StateCourts = $MemberProfileData['ym_api_profile_data']['DSCRT'];
            $FederalCourts = $MemberProfileData['ym_api_profile_data']['DFCRTS'];
            $PracticeArea = $MemberProfileData['ym_api_profile_data']['PracticeAreas2'];
            $State = $MemberProfileData['ym_api_profile_data']['Locations'];



            /*Customization of state and city */

                $state_explode = explode("\n", $State);
                $stateArray = array();
                $stateCount = -1;

                foreach ($state_explode as $key_state => $value_state) {
                    $mainState = strpos($value_state, ":");

                    if($mainState) {
                        $stateCount++;
                        $stateValues = str_replace(":", "", $value_state);
                        $stateArray[$stateCount]['STATE'] = $stateValues;
                        $stateArray[$stateCount]['CITYMASTER'] = $this->edit_user_model->getCityValues($stateValues);
                    } else {
                        $stateArray[$stateCount]['CITY'][] = $value_state;
                    }
                }

            /*end of state and city */
            
            /* Customization of practice area and sub-practice area */

            $PracticeArea_expplode = explode("\n", $PracticeArea);
            $practiceareaArray=array();
            $practiceareacounter=-1;

            foreach($PracticeArea_expplode as $key=>$data) {
                $mainpracticearea = strpos($data, ":");

                if($mainpracticearea){
                    $practiceareacounter++;
                    $pracValues = str_replace(":","", $data);
                    $practiceareaArray[$practiceareacounter]['PA']=$pracValues;
                    $practiceareaArray[$practiceareacounter]['SPAMASTER'] = $this->edit_user_model->getSubPracticeValues($pracValues);

                }else{
                    $practiceareaArray[$practiceareacounter]['SPA'][]=$data;
                }
            } 

            /*end of practice and subpractice area */
            $MemberProfileData['contact'] = $MemberProfileData['ym_api_profile_data']['contact'];
            $MemberProfileData['email'] = $MemberProfileData['ym_api_profile_data']['email'];
            $MemberProfileData['mobile'] = $MemberProfileData['ym_api_profile_data']['mobile'];
            $MemberProfileData['Website'] = $MemberProfileData['ym_api_profile_data']['Website'];

            $MemberProfileData['stateCityValue'] = $stateArray;
            $MemberProfileData['FirmName'] = $FirmName;
            $MemberProfileData['MBE_WBE'] = explode("\n", $MBE_WBE);
            $MemberProfileData['FirmSize'] = $FirmSize;
            $MemberProfileData['Attorneys'] = $Attorneys;
            $MemberProfileData['RepresentativeTransactions'] = $RepresentativeTransactions;
            $MemberProfileData['RepresentativeCases'] = $RepresentativeCases;
            $MemberProfileData['SpecificAreasofLaw'] = explode("\n", $SpecificAreasofLaw);
            $MemberProfileData['SpecificLanguages'] = explode("\n", $SpecificLanguages);
            $MemberProfileData['StateCourts'] = explode("\n", $StateCourts);
            $MemberProfileData['FederalCourts'] = explode("\n", $FederalCourts);

            $MemberProfileData['practiceareaArray'] = $practiceareaArray;
            $MemberProfileData['sub_practice_areas'] = $this->edit_search_model->getSub_practice_areas(); 
            $MemberProfileData['city'] = $this->edit_search_model->getCity();
            $MemberProfileData['state'] = $this->edit_search_model->getState();
            $MemberProfileData['statecourtvalue'] = $this->edit_search_model->getStatecourtallvalues();
            $MemberProfileData['practice_area'] = $this->edit_search_model->getPracticearea();
            $MemberProfileData['mbe_wbe'] = $this->edit_search_model->getMbeWbe();
            $MemberProfileData['firmsize'] = $this->edit_search_model->getFirmSize();
            $MemberProfileData['attorneys'] = $this->edit_search_model->getAttorneys();
            $MemberProfileData['specific_areas_of_law'] = $this->edit_search_model->getspecificareasoflaw();
            $MemberProfileData['specificlanguages'] = $this->edit_search_model->getSpecificlanguages();
            $MemberProfileData['fedaral_courts'] = $this->edit_search_model->getfedaralCourts();
            $MemberProfileData['practice_area_count'] =count($practiceareaArray);
            $MemberProfileData['state_count'] =1;

            $this->load->view('frontend/header');
            $this->load->view('frontend/edituser', $MemberProfileData);
            $this->load->view('frontend/footer');
        }

        function add() {
            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                $webid = $this->input->post('webid');
                $practice_area = $this->input->post('practice_area');
                
                $subpracticeareanameBasedOnPracticearea="";
                for($i=0; $i<count($practice_area); $i++) {
                    $tempStr="";
                    $practiceAreaExplode = explode(":", $practice_area[$i]);
                    $practiseareaId = $practiceAreaExplode[0];
                    $practiceAreaName = $practiceAreaExplode[1];

                    $subpractisearea = $this->input->post('subpractisearea_'.$practiseareaId.'');
                    $tempStr .= $practiceAreaName.":"."&#10;";
                    for($j=0; $j<count($subpractisearea); $j++) {
                        $tempStr .= $subpractisearea[$j] ."&#10;";
                        $subpracticeareanameBasedOnPracticeareaID .= $practiseareaId . "|" . $subpractisearea[$j] .",";
                    }
                    $subpracticeareanameBasedOnPracticearea=$subpracticeareanameBasedOnPracticearea.$tempStr;
                   
                }
               

                $state = $this->input->post('state');
                $cityNameBasedOnState ="";

                for($m=0; $m<count($state); $m++) {
                    $tempStrState="";
                    $stateexplode = explode(":", $state[$m]);
                    $stateId = $stateexplode[0];
                    $stateName = $stateexplode[1];

                    $city = $this->input->post('city_'.$stateId.'');
                    $tempStrState .= $stateName . ":"."&#10;";

                    for($n=0; $n<count($city); $n++) {
                        $tempStrState .= $city[$n] ."&#10;";
                        $cityNameBasedOnStateID .= $stateId . "|" . $city[$n] .",";
                    }
                    $cityNameBasedOnState=$cityNameBasedOnState.$tempStrState;
                }


                
                $firm_name = $this->input->post('firm_name');
                $mbe_wbe = $this->input->post('mbe_wbe');

                for($h=0; $h<count($mbe_wbe); $h++) {
                    $mbe_explode = explode(":", $mbe_wbe[$h]);
                    $mbe_id = $mbe_explode[0];
                    $mbe_name = $mbe_explode[1];

                    $mbeforYm .= $mbe_name ."&#10;";

                    $mbeforlocal .= $mbe_name . ",";
                }

               // echo "<pre>"; print_r($mbe_wbe);exit; 
                $firm_size = $this->input->post('firm_size');
                $attorneys = $this->input->post('attorneys');
                $representation_transaction = $this->input->post('representation_transaction');
                $representation_cases = $this->input->post('representation_cases');

                $specific_areas_of_law_post = $this->input->post('specific_areas_of_law');

                for($l=0; $l<count($specific_areas_of_law_post); $l++) {
                    $specific_areas_of_law_explode = explode(":", $specific_areas_of_law_post[$l]);
                    $specific_areas_of_law_id = $specific_areas_of_law_explode[0];
                    $specific_areas_of_law_name = $specific_areas_of_law_explode[1];

                    $specific_areas_of_law .=  $specific_areas_of_law_name ."&#10;";    /* specific_areas_of_law_name is for YM*/

                    $specific_areas_of_lawId .= $specific_areas_of_law_id .",";    /*$specific_areas_of_law_id is for local data base */
                }


                $specific_languages_post = $this->input->post('specific_languages');

                for($r=0; $r<count($specific_languages_post); $r++) {
                    $specificlanguages_explode = explode(":", $specific_languages_post[$r]);
                    $specificlanguages_id = $specificlanguages_explode[0];
                    $specificlanguages_name = $specificlanguages_explode[1];

                    $specific_languages .=  $specificlanguages_name ."&#10;";   /*specificlanguages name for YM*/

                    $specificlanguagesid .= $specificlanguages_id . ",";
                }

                $state_courts_post = $this->input->post('state_courts');

                for($t=0; $t<count($state_courts_post); $t++) {
                    $state_courts_post_explode = explode(":", $state_courts_post[$t]);
                    $state_courts_post_id = $state_courts_post_explode[0];
                    $state_courts_post_name = $state_courts_post_explode[1];

                    $state_courts .= $state_courts_post_name . "&#10;";   /*State court for YM*/

                    $statecourtId .=  $state_courts_post_id .",";    /*State court Id for local Db*/
                }

                $federal_courts_post = $this->input->post('federal_courts');

                for($w=0; $w<count($federal_courts_post); $w++) {
                    $fedaral_explode = explode(":", $federal_courts_post[$w]);
                    $fedaral_id = $fedaral_explode[0];
                    $fedaral_name = $fedaral_explode[1];
                    
                    $federal_courts .= $fedaral_name . "&#10;";   /*Fedaral courts name for YM*/
                    
                    $fedaralid .= $fedaral_id.",";         /*Fedaral courtid for local db*/
                }
               
                $mbeforlocal_explode = substr_replace($mbeforlocal ,"",-1);

                $website_id = $this->input->post('webid');
                $membershipID = $this->membershipID($website_id);

                $requiredUpdatedValueToYM = array('PracticeArea' => $subpracticeareanameBasedOnPracticearea, 'State' => $cityNameBasedOnState, 'FirmName' => $firm_name, 'MBE/WBE' => $mbeforYm, 'FirmSize' => $firm_size, 'Attorneys' => $attorneys, 'RepresentativeTransactions' => $representation_transaction, 'RepresentativeCases' => $representation_cases, 'SpecificAreasofLaw' => $specific_areas_of_law, 'SpecificLanguages' => $specific_languages, 'StateCourts' => $state_courts, 'FederalCourts' => $federal_courts, 'memberId' => $membershipID);
               

                $updateUserProfile = $this->UpdateProfile($requiredUpdatedValueToYM);

                $contact = $this->input->post('contact');
                $mobile = $this->input->post('mobile');
                $email = $this->input->post('email');
                $website = $this->input->post('website');

                $postvalue = array('WebsiteId' => $this->input->post('webid'), 'FirmName' => $firm_name, 'MbeWbeName' => $mbeforlocal_explode, 'FirmSize' => $firm_size, 'Attorneys' => $attorneys, 'RepresentativeTransactions' => $representation_transaction, 'RepresentativeCases' => $representation_cases, 'Address' => $contact, 'PhoneNo' => $mobile, 'EmailId' => $email, 'WebsiteUrl' => $website);
                    
                $addUserForm = $this->edit_user_model->AddUserForm($postvalue);

                $deleteUserMasterTables = $this->edit_user_model->DeleteUserMasterTables($addUserForm['user_id']);
                                
                $explodepracticearea = explode(",", $subpracticeareanameBasedOnPracticeareaID);

                for($k=0; $k<count($explodepracticearea)-1; $k++) {
                        $practice_Area = $explodepracticearea[$k];
                        $practice_Area_explode = explode("|", $practice_Area);
                        $prac_Id = $practice_Area_explode[0];
                        $sub_prac_name = $practice_Area_explode[1];
                        $insertPracticeArea = $this->edit_user_model->InsertPracticeArea($addUserForm['user_id'], $prac_Id, $sub_prac_name, $addUserForm['status']);
                }
                $cityNameBasedOn_state = explode(",", $cityNameBasedOnStateID);
                
                for($m=0; $m<count($cityNameBasedOn_state)-1; $m++) {
                        $user_id = $addUserForm;
                        $city_Name = $cityNameBasedOn_state[$m]; 
                        $city_Name_explode = explode("|", $city_Name);
                        $state_id_get = $city_Name_explode[0];
                        $city_name_get = $city_Name_explode[1];

                        $addUserPracticeArea = $this->edit_user_model->InsertUserState($addUserForm['user_id'], $state_id_get, $city_name_get, $addUserForm['status']);
                        
                }
                $specific_areas_of_lawId_exploade = explode(",", $specific_areas_of_lawId);

                
                for($h=0; $h<count($specific_areas_of_lawId_exploade)-1; $h++) {
                    $user_id = $addUserForm;
                    $specificareasoflaw_ID = $specific_areas_of_lawId_exploade[$h];

                    $addUserPracticeArea = $this->edit_user_model->InsertUserSPAOL($addUserForm['user_id'], $specificareasoflaw_ID, $addUserForm['status']);
                   
                }
                $specificlanguagesid_explode = explode(",", $specificlanguagesid);

                for($n=0; $n<count($specificlanguagesid_explode)-1; $n++) {
                         $user_id = $addUserForm;
                         $specificlanguagesid_explode_ID = $specificlanguagesid_explode[$n];

                         $addUserSpecificlanguage = $this->edit_user_model->InsertUserSpecificlanguage($addUserForm['user_id'], $specificlanguagesid_explode_ID, $addUserForm['status']);
                         
                }
                $statecourtId_explode = explode(",", $statecourtId);

                for($j=0; $j<count($statecourtId_explode)-1; $j++){
                    $user_id = $addUserForm;
                    $statecourtId_explode_id = $statecourtId_explode[$j];

                    $addUserstateCourtDetails = $this->edit_user_model->InsertUserStateCourtsDetails($addUserForm['user_id'], $statecourtId_explode_id,  $addUserForm['status']);
                    
                }
                $fedaralid_expplode = explode(",", $fedaralid);

                for($n=0; $n<count($fedaralid_expplode)-1; $n++) {
                     $user_id = $addUserForm;
                     $fedaral_id_get_explode = $fedaralid_expplode[$n];

                     $addFedaralCourtDetailsInsert = $this->edit_user_model->InssertFedaralDetails($addUserForm['user_id'], $fedaral_id_get_explode, $addUserForm['status']);
                }
                

                if($addUserForm == 1) {
                    $data['flash_message'] = FALSE; 
                } else {
                    $data['flash_message'] = TRUE; 
                }
            
                redirect('/edit_user_form?webid='.$website_id);
                // $data['main_content'] = 'frontend/edituser/add';

                // $this->load->view('frontend/header');
                // $this->load->view('frontend/edituser/12312', $data);
                // $this->load->view('frontend/footer');
                
            }
             
        }

        function getSubPracticeArea() {
           $practiceAreaId = $this->input->post('id');
           $count = $this->input->post('count');
           $fetchSubPracticeAreaData = $this->edit_user_model->getSubpractiseAreaData($practiceAreaId);
           echo "<select multiple='multiple' name='subpractisearea_".$practiceAreaId."[]' id='subpractisearea_".$count."'>";

           foreach($fetchSubPracticeAreaData AS $sub_practice_areas_value) { 
                echo "<option onclick=\"return countSubpracticearea();\">";
                echo $sub_practice_areas_value['FieldValue']; 
                echo "</option>";
            }
            echo "</select>";
            
        }


        function getCity() {

           $stateId = $this->input->post('id');
           $count = $this->input->post('count');
           $fetchCity = $this->edit_user_model->getCity($stateId);
           echo "<select multiple='' name='city_".$stateId."[]' id='city_state_".$count."'>";

           foreach($fetchCity AS $fetchCity_value) { 
                echo "<option value='".$fetchCity_value['FieldValue']."'>";
                echo $fetchCity_value['FieldValue']; 
                echo "</option>";
            }
            echo "</select>";
            echo "<div class=\"newCity\"><input id=\"newItem_".$count."\" type=\"text\" placeholder=\"Add a new city\"><a id=\"add\" href=\"javascript:void(0);\" onclick=\"return AddCity(); \">Add</a></div>";
           // echo "<input type=\"button\" value=\"Remove\" onclick=\"RemoveMoreCity()\">";
        }

        function updatedCity() {
            $stateId = $this->input->post('stateid');
            $count = $this->input->post('count');
            $cityname = $this->input->post('cityname');
            $checkCityExistance = $this->edit_user_model->checkCityExistance($cityname, $stateId);

            if($checkCityExistance == "notexisted") {
                $addNewCityMasterTable = $this->edit_user_model->addNewCityMasterTable($cityname, $stateId);
               echo "true";

            } else {
                echo "false";
            }
        }

        function checkSession() {
            session_start();
            $session = "";
            $_SESSION['session'] = $session;

            if($_SESSION['session'] == '') {
                $this->checkPing();
            } else {
                $this->getPing();
            } 
        }

        function checkPing() {
            /* This function is used for getting session id using YM API */
            $randno  = mt_rand(5, 15);
            $session = "";
            $xml_data = '<?xml version="1.0" encoding="utf-8" ?>'.
                        '<YourMembership>'.
                        '<Version>2.00</Version>'.
                        '<ApiKey>FA82D01D-B8AD-4528-8CE4-751EAAB82583</ApiKey>'.
                        '<CallID>001</CallID>'.
                        '<Call Method="Session.Create"></Call>'.
                        '</YourMembership>';
            
            $URL = "https://api.yourmembership.com/";
            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            preg_match_all("!<SessionID>(.*?)</SessionID>!", $output, $matches);
            $session_id = $matches[1][0];
            $_SESSION['session'] = $session_id;
            $this->getPing(); 
        }

        function getPing() {
                /* This function is used for get pinged or not using YM API */
            $randno  = mt_rand(1, 24);
            $xml_data = '<?xml version="1.0" encoding="utf-8" ?>'.
                        '<YourMembership>'.
                        '<Version>2.00</Version>'.
                        '<ApiKey>FA82D01D-B8AD-4528-8CE4-751EAAB82583</ApiKey>'.
                        '<CallID>002</CallID>'.
                        '<SessionID>'. $_SESSION['session'] .'</SessionID>'.
                        '<Call Method="Session.Ping"></Call>'.
                        '</YourMembership>';
            $URL = "https://api.yourmembership.com/";
            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
        }

        function membershipID($website_id) {
                /*This function is used for fetching MEMBER ID USING YM API */
            $xml_data = '<?xml version="1.0" encoding="utf-8" ?>'.
                        '<YourMembership>'.
                        '<Version>2.00</Version>'.
                        '<ApiKey>'.$this->config->item('apikey').'</ApiKey>'.
                        '<CallID>003</CallID>'.
                        '<SaPasscode>zky5Sl5TfoQ7</SaPasscode>'.
                        '<Call Method="Sa.People.Profile.FindID">'.
                        '<WebsiteID>'. $website_id .'</WebsiteID>'.
                        '</Call>'.
                        '</YourMembership>';
            
            $URL = "https://api.yourmembership.com/";
            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $xml = new SimpleXMLElement($output); 
            $memberID = $xml->{'Sa.People.Profile.FindID'}->ID;
            return $memberID;
           // $this->MemberProfileData($memberID);
        } 

        function MemberProfileData($memberID) {
            /* This function is used for fetching profile data using YM API */
            // echo api_key();exit;

            $xml_data = '<?xml version="1.0" encoding="utf-8" ?>'.
                        '<YourMembership>'.
                        '<Version>2.00</Version>'.
                        '<ApiKey>'.$this->config->item('apikey').'</ApiKey>'.
                        '<CallID>004</CallID>'.
                        '<SaPasscode>zky5Sl5TfoQ7</SaPasscode>'.
                        '<Call Method="Sa.People.Profile.Get">'.
                        '<ID>'. $memberID .'</ID>'.
                        '</Call>'.
                        '</YourMembership>';
            $URL = "https://api.yourmembership.com/";
            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $xml = new SimpleXMLElement($output);
             // echo "<pre>"; print_r($xml);
            $xmlPreVal = $xml->{'Sa.People.Profile.Get'};
            $xmlprofile= $xmlPreVal->CustomFieldResponses->CustomFieldResponse;
            $xmlprofileEamil = $xmlPreVal->EmailAddr;
            //$xmlprofileContact = $xmlPreVal->EmpAddrLines . ",". $xmlPreVal->EmpCity ."," .$xmlPreVal->EmpLocation.",".$xmlPreVal->EmpPostalCode .",". $xmlPreVal->EmpCountry;
            $xmlprofileWebsite = $xmlPreVal->Website;
            $xmlprofileContact = $xmlPreVal->NamePrefix . "." . $xmlPreVal->FirstName . " " . $xmlPreVal->MiddleName . " " . $xmlPreVal->LastName;
            $xmlprofileMobile = "+". $xmlPreVal->EmpPhAreaCode . "-". $xmlPreVal->EmpPhone;
            $ymKeyArray=['PracticeAreas2','Locations','DFN','DMW','DFS','DATRNY','DRT','DRC','DSAOL','DSL','DSCRT','DFCRTS'];
            // echo "<pre>"; print_r($xml);

            foreach($xmlprofile as $value){
                $filedCode=(string)$value->attributes()->FieldCode;
                
                if(in_array($filedCode, $ymKeyArray)) {
                    $xmlprofiledata[$filedCode] = $value->Values->Value;
                }
               
            }   
            $xmlprofiledata['contact'] = $xmlprofileContact;
            $xmlprofiledata['email'] = $xmlprofileEamil;
            $xmlprofiledata['mobile'] = $xmlprofileMobile;
            $xmlprofiledata['Website'] = $xmlprofileWebsite;
    
            return $xmlprofiledata;          
        }

        function UpdateProfile($xmlprofiledata) {
           
            $xml_data = '<?xml version="1.0" encoding="utf-8" ?>'.
                            '<YourMembership>'.
                            '<Version>2.00</Version>'.
                            '<ApiKey>'.$this->config->item('apikey').'</ApiKey>'.
                            '<CallID>005</CallID>'.
                            '<SaPasscode>zky5Sl5TfoQ7</SaPasscode>'.
                            '<Call Method="Sa.People.Profile.Update">'.
                            '<ID>'.$xmlprofiledata['memberId'].'</ID>'.
                            '<CustomFieldResponses>'.
                            '<CustomFieldResponse FieldCode="PracticeAreas2">'.
                            '<Values>'.$xmlprofiledata['PracticeArea'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="Locations">'.
                            '<Values>'.$xmlprofiledata['State'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DFN">'.
                            '<Values>'.$xmlprofiledata['FirmName'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DMW">'.
                            '<Values>'.$xmlprofiledata['MBE/WBE'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DFS">'.
                            '<Values>'.$xmlprofiledata['FirmSize'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DATRNY">'.
                            '<Values>'.$xmlprofiledata['Attorneys'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DRT">'.
                            '<Values>'.$xmlprofiledata['RepresentativeTransactions'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DRC">'.
                            '<Values>'.$xmlprofiledata['RepresentativeCases'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DSAOL">'.
                            '<Values>'.$xmlprofiledata['SpecificAreasofLaw'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DSL">'.
                            '<Values>'.$xmlprofiledata['SpecificLanguages'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DSCRT">'.
                            '<Values>'.$xmlprofiledata['StateCourts'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '<CustomFieldResponse FieldCode="DFCRTS">'.
                            '<Values>'.$xmlprofiledata['FederalCourts'].'</Values>'.
                            '</CustomFieldResponse>'.
                            '</CustomFieldResponses>'.
                            '</Call>'.
                            '</YourMembership>';

            $URL = "https://api.yourmembership.com/";
            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
        }

        function insertMasterTable() {
            $value = array('Administrative','Admiralty', 'Adoption', 'Advertising', 'Agency', 'Alcohol', 
'Alternative dispute resolution', 'Animal', 'Antitrust', 'Appellate practice', 'Art', 'Aviation', 'Banking', 'Bankruptcy', 'Bioethics', 'Bird', 'Business', 'Business Organizations', 'City, County & Local Government', 'Civil Trial', 'ClassAction Litigation', 'Communications', 'Computer', 'Conflict of Law', 'Constitutional', 'Construction', 'Consumer', 'Contract', 'Copyright',  'Corporate', 'Criminal', 'Cryptography', 'Cultural Property', 'Custom', 'Cyber', 'Defamation', 'Derivatives and Futures', 'Drug Control', 'Education', 'Elder', 'Employee Benefits(ERISA)', 'Employment', 'Energy', 'Entertainment', 'Environmental', 'Equipment Finance', 'Evidence', 'Family', 'FDA', 'Financial Services Regulation', 'Firearm', 'Food', 'Franchise', 'Gaming', 'Health', 'Health and Safety', 'Healthcare', 'Immigration', 'Insurance', 'Intellectual Property', 'International', 'International Trade and Finance', 'Internet', 'Labor', 'Land use & Zoning', 'Litigation', 'Martial', 'Media', 'Mergers & Acquisitions', 'Military', 'Mining', 'Juvenile', 'Music', 'Mutual Funds', 'Nationality', 'Native American', 'Obscenity', 'Oil & Gas', 'Parliamentary', 'Patent', 'Poverty', 'Privacy',
'Private Equity', 'Private Funds', 'Procedural', 'Product Liability Litigation', 'Property', 'Public Health', 'Railroad', 'Real Estate', 'Securities', 'Social Security Disability', 'Space', 'Sports', 'State and Federal Government', 'Statutory', 'Tax', 'Technology', 'Timber', 'Tort', 'Trademark', 'Transportation', 'Trusts & Estates', 'Utilities Regulation', 'Venture Capital', 'Water', 'Worker’s Compensation');
            $this->edit_user_model->insertPractiseArea($value);
            

        }

        function SpecificAreasLaws() {
            $lawsvalue = array('Admiralty & Maritime Law', 'Adoption Law', 'Antitrust & Trade Regulation Law', 
'Appellate Practice', 'Aviation Law', 'Business Litigation', 'City, County & Local Government Law', 'Civil Trial', 'Construction Law', 'Criminal Appellate', 'Criminal Trial', 'Education Law', 'Elder Law', 'Health Law', 'Immigration & Nationality', 'Intellectual Property Law', 'International Law', 'Labor & Employment Law', 'Marital & Family Law', 'Real Estate', 'State and Federal Government and Administrative', 'Practice', 'Tax Law', 'Wills, Trusts & Estates', 'Workers Compensation');
            $this->edit_user_model->insertSpecificAreasLaws($lawsvalue);
        }

        function SpeakSpecificLanguages() {
            $SpeakSpecificLanguages = array('Albanian', 'American Sign', 'Language', 'Arabic', 'Armenian', 'Bosnian', 'Bulgarian', 'Chinese', 'Croatian', 'Czech', 'Danish', 'Dutch', 'English', 'Farsi', 'Finnish', 'French', 'German', 'Greek', 'Gujarati', 'Haitian Creole', 'Hebrew', 'Hindi', 'Hungarian', 'Indonesian', 'Italian', 'Japanese', 'Korean', 'Lithuanian', 'Norwegian', 'Other', 'Polish', 'Portuguese', 'Quechua', 'Romanian', 'Russian', 'Serbian', 'Slovak', 'Spanish', 'Swedish', 'Swiss German', 'Taiwanese', 'Tamil', 'Turkish', 'Ukrainian', 'Urdu', 'Vietnamese');
            $this->edit_user_model->insertSpeciicLanguages($SpeakSpecificLanguages);
        }

        function FedaralCourtesMaster() {
            $fedarelCourts = array('Alabama Middle District Bankruptcy Court', 'Alabama Northern District Bankruptcy Court', 'Alabama Southern District Bankruptcy Court', 'Alaska Bankruptcy Court', 'Arizona Bankruptcy Court', 'Arkansas Eastern District Bankruptcy Court', 'Arkansas Western District Bankruptcy Court', 
                'California Central District Bankruptcy Court', 
                'California Eastern District Bankruptcy Court',
                'California Northern District Bankruptcy Court',
                'California Southern District Bankruptcy Court',
                'Colorado Bankruptcy Court',
                'Connecticut Bankruptcy Court',
                'Delaware Bankruptcy Court',
                'District of Columbia Bankruptcy Court',
                'Georgia Middle District Bankruptcy Court',
                'Georgia Northern District Bankruptcy Court', 'Georgia Southern District Bankruptcy Court',
                'Hawaii Bankruptcy Court',
                'Idaho Bankruptcy Court',
                'Illinois Central District Bankruptcy Court',
                'Illinois Northern District Bankruptcy Court',
                'Illinois Southern District Bankruptcy Court',
                'Indiana Northern District Bankruptcy Court',
                'Indiana Southern District Bankruptcy Court',
                'Iowa Northern District Bankruptcy Court',
                'Iowa Southern District Bankruptcy Court',
                'Kansas Bankruptcy Court',
                'Kentucky Eastern District Bankruptcy Court',
                'Kentucky Western District Bankruptcy Court',
                'Louisiana Eastern District Bankruptcy Court',
                'Louisiana Middle District Bankruptcy Court',
                'Louisiana Western District Bankruptcy Court',
                'Maine Bankruptcy Court',
                'Maryland Bankruptcy Court',
                'Massachusetts Bankruptcy Court',
                'Michigan Eastern District Bankruptcy Court',
                'Michigan Western District Bankruptcy Court',
                'Minnesota Bankruptcy Court',
                'Mississippi Northern District Bankruptcy Court',
                'Mississippi Southern District Bankruptcy Court',
                'Montana Bankruptcy Court',
                'Nebraska Bankruptcy Court',
                'New Hampshire Bankruptcy Court',
                'New Jersey Bankruptcy Court',
                'New Mexico Bankruptcy Court',
                'New York Eastern District Bankruptcy Court',
                'New York Northern District Bankruptcy Court',
                'New York Southern District Bankruptcy Court',
                'New York Western District Bankruptcy Court',
                'Nevada Bankruptcy Court',
                'North Carolina Eastern District Bankruptcy Court',
                'North Carolina Middle District Bankruptcy Court',
                'North Carolina Western District Bankruptcy Court',
                'North Dakota Bankruptcy Court',
                'Ohio Northern District Bankruptcy Court',
                'Ohio Southern District Bankruptcy Court',
                'Oklahoma Eastern District Bankruptcy Court',
                'Oklahoma Northern District Bankruptcy Court',
                'Oklahoma Western District Bankruptcy Court',
                'Oregon Bankruptcy Court',
                'Pennsylvania Eastern District Bankruptcy Court', 
                'Pennsylvania Middle District Bankruptcy Court',
                'Pennsylvania Western District Bankruptcy Court',
                'Puerto Rico Bankruptcy Court',
                'Rhode Island Bankruptcy Court',
                'South Carolina Bankruptcy Court',
                'South Dakota Bankruptcy Court',
                'Tennessee Eastern District Bankruptcy Court',
                'Tennessee Middle District Bankruptcy Court',
                'Tennessee Western District Bankruptcy Court',
                'Texas Eastern District Bankruptcy Court',
                'Texas Northern District Bankruptcy Court',
                'Texas Southern District Bankruptcy Court',
                'Texas Western District Bankruptcy Court',
                'Utah Bankruptcy Court',
                'Vermont Bankruptcy Court',
                'Virginia Eastern District Bankruptcy Court',
                'Virginia Western District Bankruptcy Court',
                'Washington Eastern District Bankruptcy Court',
                'Washington Western District Bankruptcy Court',
                'West Virginia Northern District Court',
                'West Virginia Southern District Court',
                'Wisconsin Eastern District Bankruptcy Court',
                'Wisconsin Western District Bankruptcy Court',
                'Wyoming Bankruptcy Court',
                'U.S. Court of Appeals for the First Circuit',
                'U.S. Court of Appeals for the Second Circuit',
                'U.S. Court of Appeals for the Third Circuit',
                'U.S. Court of Appeals for the Fourth Circuit',
                'U.S. Court of Appeals for the Fifth Circuit',
                'U.S. Court of Appeals for the Sixth Circuit',
                'U.S. Court of Appeals for the Seventh Circuit',
                'U.S. Court of Appeals for the Eighth Circuit',
                'U.S. Court of Appeals for the Ninth Circuit',
                'U.S. Court of Appeals for the Tenth Circuit',
                'U.S. Court of Appeals for the Eleventh Circuit',
                'U.S. Court of Appeals for the District of Columbia',
                'U.S. Court of Appeals for the Federal Circuit',
                'U.S. District Court, Middle District of Florida',
                'U.S. District Court, Northern District of Florida',
                'U.S. District Court, Southern District of Florida',
                'U.S. District Court, District of Alaska',
                'U.S. District Court, District of Arizona',
                'U.S. District Court, District of Colorado',
                'U.S. District Court, District of Columbia',
                'U.S. District Court, District of Connecticut',
                'U.S. District Court, District of Delaware',
                'U.S. District Court, District of Guam',
                'U.S. District Court, District of Hawaii',
                'U.S. District Court, District of Idaho',
                'U.S. District Court, District of Kansas',
                'U.S. District Court, District of Maine',
                'U.S. District Court, District of Maryland',
                'U.S. District Court, District of Massachusetts',
                'U.S. District Court, District of Minnesota',
                'U.S. District Court, District of Montana',
                'U.S. District Court, District of Nebraska',
                'U.S. District Court, District of Nevada',
                'U.S. District Court, District of New Hampshire',
                'U.S. District Court, District of New Jersey',
                'U.S. District Court, District of New Mexico',
                'U.S. District Court, District of North Dakota',
                'U.S. District Court, District of the Northern Mariana Islands',
                'U.S. District Court, District of Oregon',
                'U.S. District Court, District of Puerto Rico',
                'U.S. District Court, District of Rhode Island',
                'U.S. District Court, District of South Carolina',
                'U.S. District Court, District of South Dakota',
                'U.S. District Court, District of Utah',
                'U.S. District Court, District of Vermont',
                'U.S. District Court, District of the Virgin Islands',
                'U.S. District Court, District of Wyoming',
                'U.S. District Court, Middle District of Alabama',
                'U.S. District Court, Northern District of Alabama',
                'U.S. District Court, Southern District of Alabama',
                'U.S. District Court, Eastern District of Arkansas',
                'U.S. District Court, Western District of Arkansas',
                'U.S. District Court, Central District of California',
                'U.S. District Court, Eastern District of California',
                'U.S. District Court, Northern District of California',
                'U.S. District Court, Southern District of California',
                'U.S. District Court, Middle District of Georgia',
                'U.S. District Court, Northern District of Georgia',
                'U.S. District Court, Southern District of Georgia',
                'U.S. District Court, Central District of Illinois',
                'U.S. District Court, Northern District of Illinois',
                'U.S. District Court, Southern District of Illinois',
                'U.S. District Court, Northern District of Indiana',
                'U.S. District Court, Southern District of Indiana',
                'U.S. District Court, Northern District of Iowa',
                'U.S. District Court, Southern District of Iowa',
                'U.S. District Court, Eastern District of Kentucky',
                'U.S. District Court, Western District of Kentucky',
                'U.S. District Court, Eastern District of Louisiana',
                'U.S. District Court, Middle District of Louisiana',
                'U.S. District Court, Western District of Louisiana',
                'U.S. District Court, Eastern District of Michigan',
                'U.S. District Court, Western District of Michigan',
                'U.S. District Court, Eastern District of Missouri',
                'U.S. District Court, Western District of Missouri',
                'U.S. District Court, Northern District of Mississippi',
                'U.S. District Court, Southern District of Mississippi',
                'U.S. District Court, Eastern District of NewYork',
                'U.S. District Court, Northern District of NewYork',
                'U.S. District Court, Southern District of NewYork',
                'U.S. District Court, Western District of NewYork',
                'U.S. District Court, Eastern District of North Carolina',
                'U.S. District Court, Middle District of North Carolina',
                'U.S. District Court, Western District of North Carolina',
                'U.S. District Court, Northern District of Ohio',
                'U.S. District Court, Southern District of Ohio',
                'U.S. District Court, Eastern District of Oklahoma',
                'U.S. District Court, Northern District of Oklahoma',
                'U.S. District Court, Western District of Oklahoma',
                'U.S. District Court, Eastern District of Pennsylvania',
                'U.S. District Court, Middle District of Pennsylvania',
                'U.S. District Court, Western District of Pennsylvania',
                'U.S. District Court, Eastern District of Tennessee',
                'U.S. District Court, Middle District of Tennessee',
                'U.S. District Court, Western District of Tennessee',
                'U.S. District Court, Eastern District of Texas',
                'U.S. District Court, Northern District of Texas',
                'U.S. District Court, Southern District of Texas',
                'U.S. District Court, Western District of Texas',
                'U.S. District Court, Eastern District of Virginia',
                'U.S. District Court, Western District of Virginia',
                'U.S. District Court, Eastern District of Washington',
                'U.S. District Court, Western District of Washington',
                'U.S. District Court, Northern District of West Virginia',
                'U.S. District Court, Southern District of West Virginia',
                'U.S. District Court, Eastern District of Wisconsin',
                'U.S. District Court, Western District of Wisconsin',
                'U.S. Supreme Court',
                'U.S. Tax Court',
                'U.S. Court of Federal Claims',
                'U.S. Court of International Trade',
                'U.S. Court of Appeals for Veteran Claims',
                'U.S. Court of Appeals for the Armed Forces');
            
            $this->edit_user_model->insertfedarelCourts($fedarelCourts);
        }

        function subpractisearea() {

            $insertSubpractisearea  = array('Compliance',
                                            'Regulatory Investigations');
            $this->edit_user_model->insertSubpractisearea($insertSubpractisearea);

        }

        function ImportCity() {
            $city = array('MINNEAPOLIS',
                        'LOS ANGELES',
                        'MILWAUKEE',
                        'CHATHAM',
                        'PHILADELPHIA',
                        'MADISON',
                        'CHARLOTTE',
                        'EL PASO',
                        'SAN FRANCISCO',
                        'DETROIT',
                        'MIAMI',
                        'FALLS CHURCH',
                        'TROY',
                        'ALEXANDRIA',
                        'CORAL GABLES',
                        'SAN ANTONIO',
                        'ATLANTA',
                        'DALLAS',
                        'BUFFALO',
                        'PRINCETON',
                        'WALNUT CREEK',
                        'CHICAGO',
                        'NEWORLEANS',
                        'ANDOVER',
                        'COLUMBIA',
                        'NEWYORK',
                        'AUBURN HILLS',
                        'ROSELAND',
                        'KILDEER',
                        'SAN DIEGO',
                        'KANSAS CITY',
                        'NEWARK',
                        'COLUMBUS',
                        'WASHINGTON',
                        'GLENDALE',
                        'ALBANY',
                        'ORANGE',
                        'SPRING',
                        'ROCKVILLE CENTRE',
                        'CARLSBAD',
                        'CLEVELAND',
                        'IRVINE',
                        'WEEKHAWKEN',
                        'NORTHBROOK',
                        'HASBROUCK HEIGHTS',
                        'MEDIA',
                        'SANTA ANA',
                        'PORTLAND',
                        'SHORT HILLS',
                        'OAK BROOK',
                        'SACRAMENTO',
                        'DENVILLE',
                        'DENVER',
                        'TRENTON',
                        'BOSTON',
                        'HOUSTON',
                        'INDIANAPOLIS',
                        'BOCA RATON',
                        'BERKELEY',
                        'GAINESVILLE',
                        'CENTENNIAL',
                        'ST. LOUIS',
                        'ARLINGTON',
                        'NORTH WALES',
                        'PARSIPPANY',
                        'SAINT PAUL',
                        'EDEN PRAIRIE',
                        'METAIRIE',
                        'WASHINGTON, DC',
                        'SANTA ROSA',
                        'ST. PAUL',
                        'MINNETONKA',
                        'SYOSSET',
                        'NORTH CHICAGO',
                        'OMAHA',
                        'MCALLEN',
                        'FORT LAUDERDALE',
                        'LAKEVILLE',
                        'SIMSBURY',
                        'DURHAM',
                        'NORWALK',
                        'JERSEY CITY',
                        'ST PAUL',
                        'RICHFIELD',
                        'ENCINITAS',
                        'GOLDEN VALLEY',
                        'MCLEAN, VA',
                        'TORRANCE',
                        'BENTONVILLE',
                        'ANTIOCH',
                        'EAST GREENWICH',
                        'MOUNTAIN LAKES',
                        'PHILADEPHIA',
                        'L.A.',
                        'PHILA',
                        'VOORHEES',
                        'NORTHAMPTON',
                        'COLORADO SPRINGS',
                        'DEARBORN');
            $this->edit_user_model->insertCity($city);
        }

        function StatesFromYm() {
           
            $states = array('Alabama',

                            'Alaska',

                            'Arizona',

                            'Arkansas',

                            'California',

                            'Colorado',

                            'Connecticut',

                            'Delaware',

                            'Florida',

                            'Georgia',

                            'Hawaii',

                            'Idaho',

                            'Illinois',

                            'Indiana',

                            'Iowa',

                            'Kansas',

                            'Kentucky',

                            'Louisiana',

                            'Maine',

                            'Maryland',

                            'Massachusetts',

                            'Michigan',

                            'Minnesota',

                            'Mississippi',

                            'Missouri',

                            'Montana',

                            'Nebraska',

                            'Nevada',

                            'NewHampshire',

                            'NewJersey',

                            'NewMexico',

                            'NewYork',

                            'North Carolina',

                            'North Dakota',

                            'Ohio',

                            'Oklahoma',

                            'Oregon',

                            'Pennsylvania',

                            'Rhode Island',

                            'South Carolina',

                            'South Dakota',

                            'Tennessee',

                            'Texas',

                            'Utah',

                            'Vermont',

                            'Virginia',

                            'Washington',

                            'West Virginia',

                            'Wisconsin',

                            'Wyoming');

                $this->edit_user_model->insertState($states);
        }        
    } 
?>