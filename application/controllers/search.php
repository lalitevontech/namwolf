<?php 
	error_reporting(0);

	class search extends CI_Controller {

		function __construct() {
			parent:: __construct();
			$this->load->library('session');
			$this->load->helper('url');
			$this->load->library('pagination');
			$this->load->model('edit_search_model');
		}

		function index() {
			$searchby['field'] = $this->edit_search_model->getSearchByFields();
			
			foreach ($searchby['field'] AS $key=>$value) {
				$masterTable = $value['MasterTableName'];
				$searchby['field'][$key]['master_data']=$this->edit_search_model->getMasterDetails($masterTable);
				 
			}		
			$searchby['mastertabledata'] = $searchby['field'];
			$searchby['state'] = $this->edit_search_model->getState();
			$searchby['firmsize'] = $this->edit_search_model->getFirmSize();
			$searchby['attorneys'] = $this->edit_search_model->getAttorneys();

			$searchby['sub_practice_areas'] = $this->edit_search_model->getSub_practice_areas(); 
			$searchby['city'] = $this->edit_search_model->getCity();
			$searchby['practice_area'] = $this->edit_search_model->getPracticearea();
			$searchby['mbe_wbe'] = $this->edit_search_model->getMbeWbe();
			$searchby['specific_areas_of_law'] = $this->edit_search_model->getspecificareasoflaw();
			$searchby['specificlanguages'] = $this->edit_search_model->getSpecificlanguages();

			$this->load->view('frontend/header');
			$this->load->view('frontend/search_form', $searchby);
			$this->load->view('frontend/footer');
		}

		function searchByField() {
			
			$id = $this->input->post('id');
			$masterTableName = $this->input->post('mastertable');

			$count = $this->input->post('count');

			$foriegnkey = $this->input->post('foreignkey');
			$fieldvalue = $this->input->post('fieldval');

			if($count == 1) {
				$searchby = $this->edit_search_model->getSearchByFieldsByID($id,$masterTableName,$foriegnkey);
				echo "<select id='SubPRCTA_".$id."' multiple='' name=".$masterTableName.":".$id."[]>";
				
				foreach($searchby AS $value) {
					echo "<option value='".$value['Id']."'>".$value['FieldValue']."</option>";
				}
				echo "</select>";
			} else {
				echo "<select id='SubPRCTA_".$fieldvalue."' multiple='' name=".$masterTableName."[]>";
					echo "<option value=''></option>";
				echo "</select>";
			}
		}

		function add() {
				
			if($this->input->server('REQUEST_METHOD') == 'POST') {

				
				$Firm_Name = $this->input->post('Firm_Name');    /*FIRM NAME*/

				$State = $this->input->post('State');

				foreach ($State as $keystateid => $valuestate) {
					$stateID .= $valuestate .",";
				}

				$stateId = substr_replace($stateID ,"",-1);      /*State ID*/
				

				$city = $this->input->post('city:'.$stateId.'');   

				foreach ($city as $key_city => $value_city) {
					$CityId .= $value_city .",";
				}

				$CityID = substr_replace($CityId ,"",-1);      /*City ID*/

				$Practice_Area = $this->input->post('Practice_Area');
				
				
				foreach($Practice_Area AS $keyPracId=>$valuePracId) {
					$pracId = $Practice_Area[$keyPracId];
					if($pracId != '') {
						$sub_practice_areas['PA'][$pracId] = $this->input->post('sub_practice_areas:'.$pracId.'');  /*PA & SPA*/
					}
				}
				
				$Mbe_Wbe = $this->input->post('Mbe_Wbe');

				foreach($Mbe_Wbe AS $valueKey) {
					$mbeWbeId .= $valueKey .",";
				}

				$mbeWbeID =  substr_replace($mbeWbeId ,"",-1);     /*mbe-wbe ID*/

				$Firm_Size = $this->input->post('Firm_Size');
				$firm_size = $Firm_Size[0];  /*Firm Size*/

				$Attorneys = $this->input->post('Attorneys');
				$Attorneysname = $Attorneys[0]; /*Attrony*/

				$Representative_Transactions = $this->input->post('Representative_Transactions');

				$Representative_Cases = $this->input->post('Representative_Cases');

				$Specific_Areas_of_Law = $this->input->post('Specific_Areas_of_Law');

				foreach ($Specific_Areas_of_Law as $key_saol => $value_saol) {
					$specificareas_of_law .= $value_saol .",";
				}
				$Specific_Languages = $this->input->post('Specific_Languages');

				foreach ($Specific_Languages as $key_sl => $value_sl) {
					$specificlanguages .= $value_sl .",";
				}
				$State_Courts = $this->input->post('State_Courts');

				foreach ($State_Courts as $key_sc => $value_sc) {
					$statecourts .= $value_sc .",";
				}
				$Federal_Courts = $this->input->post('Federal_Courts');

				foreach ($Federal_Courts as $key_fc => $value_fc) {
					$fedaralcourts .= $value_fc .",";
				}

				$search_value_array = array('firm_name' => $Firm_Name,
					                        'State' => $stateId,
					                        'city' => $CityID,
					                        'sub_practice_area_value' => $sub_practice_areas,
					                        'Mbe_Wbe' => $mbeWbeID,
					                        'Firm_Size' => $firm_size,
					                        'Attorneys' => $Attorneysname,
					                        'Representative_Transactions' => $Representative_Transactions,
					                        'Representative_Cases' => $Representative_Cases,
					                        'specificareas_of_law' => $specificareas_of_law,
					                        'specificlanguages' => $specificlanguages,
					                        'statecourts' => $statecourts,
					                        'fedaralcourts' => $fedaralcourts
					                       );
				$sortingtype = $this->input->post('sortingStatus');
				
				$countperpage = 2;
				
				$presentpage=$this->input->post('pagenumber');
			    $startfrom = ($presentpage * $countperpage) - $countperpage ;

			    $countSearchRow = $this->edit_search_model->getCountSearchRow($search_value_array,$sortingtype,$countperpage, $startfrom);

				$search_field = $this->edit_search_model->getSearchValues($search_value_array, $sortingtype, $countperpage, $startfrom,$sortby="FIRMNAME");
				
				if($search_field == '') {
					echo "<div style='margin: 0 0 0 519px;' class=\"anchorcolor\"><font color='#1C94C4'>There is no search result found. Please try again!</font></div>"; 
				}
				 
			    $user_id = substr_replace($search_field ,"",-1);

			    $pages_count  = ceil($countSearchRow / $countperpage);
			   
			    
			    if($user_id != '') {
			    	$userIdExplode = explode(",", $user_id);

			    	foreach ($userIdExplode as $key_user_id => $value_user_id) {
			    		$Search_Details[] = $this->edit_search_model->getUserDetails($value_user_id);
			    	}
			    	//echo "<pre>"; print_r($Search_Details);
			    	?>
			    	<script type="text/javascript">
			    		function init(sortingtype,pagenumber,sortby) {
			    			
			    			$("#startfrom").val(startfrom);
			    			$("#sortingStatus").val(sortingtype);
			    			$("#pagenumber").val(pagenumber);
			    			$("#sortby").val(sortby);
			    			var form_data = $("#submitsearch").serialize();
			    			$.ajax({
						        type: "POST",
						        url: "<?php base_url(); ?>search/add",
						        data: form_data,
						        datatype: "html",
						        success: function(result){
						         $("#sortingId").html(result);
						        
						        }
						    })
			    		}
			    	</script>
			    	
			   <div id="sortingId" class="searchTableData"> 
			      <div>
                    	<?php if($countSearchRow > $countperpage) { ?>
						<?php if($presentpage>1) {?>
						<span class="prev" onclick="init('ASC','<?php echo ($presentpage - 1) ?>','FIRMNAME')"><</span>
						<?php }else{ ?>
						<span class="prev"><</span>
						<?php } ?>

						<?php if($presentpage<$pages_count) {?>
						<span class="next" onclick="init('ASC','<?php echo ($presentpage + 1) ?>','FIRMNAME')">></span>
						<?php }else{ ?>
						<span class="next" onclick="">></span>
						<?php } }?>
                    </div>

			    	<table border="1" width="100%" bordercolor="#cccccc" id="result1"  class="sortable" rules="none">
			    	 <thead>
                      <tr>
                        <th width="9%">
                        	Firm Name
                        	<span class="sortingArrow" onclick="return init('DESC',1,'FIRMNAME');"></span>
                        	<span class="sortingArrow sortingArrowUp" onclick="return init('ASC',1,'FIRMNAME');"></span>
                        </th>
                        <th width="3%"><span>State</span></th>
                        <th width="5%"><span>City</span><!-- <span class="sortingArrow"></span> --></th>
                      	<th width="10%"><span>Practice Area</span><!-- <span class="sortingArrow"></span> --></th>
                      	<th width="13%"><span>Sub Practice Area</span><!-- <span class="sortingArrow"></span> --></th>
                      	<th width="10%"><span>Contact</span></th>
                      	<th width="10%"><span>Phone</span></th>
                      	<th width="5%"><span>Email</span></th>
                      	<th width="5%"><span>Firm Website</span></th>

                      </tr>
                      </thead>
                       <tbody>
                      <?php foreach($Search_Details AS $key_search=>$value_search) {
                      	
                      	$valuefedaralvalue = "";
                        foreach($value_search['fedaralcourt'] AS $valuefed) {
                            $valuefedaralvalue .= $valuefed .","; 
                            
                        } 
                        $valuefedaralvalue1 = substr_replace($valuefedaralvalue ,"",-1);
						$lengthfd = 10;
						$valuefedaralvalue = $this->countString($valuefedaralvalue1, $lengthfd);

                        $practiceareavalue="";
                        foreach($value_search['practicearea'] AS $valuepractice) {
                        	$practiceareavalue .= $valuepractice .",";                         
                        }
                        $practiceareavalue1 = substr_replace($practiceareavalue ,"",-1);
              
                        $length = 30;
                       	$practiceareavalue = $this->countString($practiceareavalue1, $length);
                       
         
                       	$subpracticeareavalue = "";
                        foreach($value_search['subpracticearea'] AS $valuesubpracticearea) {
                          $subpracticeareavalue .= $valuesubpracticearea .",";
                          
                        }
                        $subpracticeareavalue1 = substr_replace($subpracticeareavalue ,"",-1);
                        $lengthspa = 30;
                       	$subpracticeareavalue = $this->countString($subpracticeareavalue1, $lengthspa);

                       	$specificAreasofLawsvalue = "";
                        foreach($value_search['specificAreasofLaws'] AS $valuespecificAreasofLaws) {
                          $specificAreasofLawsvalue .= $valuespecificAreasofLaws . ",";
                          
                        }
                        $specificAreasofLawsvalue1 = substr_replace($specificAreasofLawsvalue ,"",-1);
                        $lengthsal = 10;
                       	$specificAreasofLawsvalue = $this->countString($specificAreasofLawsvalue1, $lengthsal);

                       	$specificlanguagesvalue =""; 
                        foreach($value_search['specificlanguages'] AS $valuespecificlanguages) {
                          $specificlanguagesvalue .= $valuespecificlanguages . ",";
                          
                        }
                        $specificlanguagesvalue1 = substr_replace($specificlanguagesvalue ,"",-1);
                        $lengthsl = 10;
                       	$specificlanguagesvalue = $this->countString($specificlanguagesvalue1, $lengthsl);

                       	$cityvalue = ""; 
                        foreach($value_search['city'] AS $valuecity) {
                          $cityvalue .= $valuecity . ",";
                          
                        }
                        $cityvalue1 = substr_replace($cityvalue ,"",-1);
                        $lengthcty = 20;
                       	$cityvalue = $this->countString($cityvalue1, $lengthcty);
                       	
                       	$statevalue = "";
                        foreach($value_search['state'] AS $valuestate) {
                          $statevalue .= $valuestate . ",";
                          
                        }

                        $statevalue1 = substr_replace($statevalue ,"",-1);
                        
                        $lengthste = 20;
                       	$statevalue = $this->countString($statevalue1, $lengthste);
                       	
                        foreach($value_search['statecourt'] AS $valuestatecourt) {
                          $statecourtvalue .= $valuestatecourt . ",";
                          
                        }
                        $statecourtvalue1 = substr_replace($statecourtvalue ,"",-1);
                        $lengthstecrt = 20;
                       	$statecourtvalue = $this->countString($statecourtvalue1, $lengthstecrt);
                       		
                       	$firm_name = $value_search['FirmName'][0];
                       	$lengthstefirmname = 40;
                       	$firmname = $this->countString($firm_name, $lengthstefirmname);

                       	$contact = $value_search['contact'][0];
                       	$lengthstecontact = 25;
                       	$contact = $this->countString($contact, $lengthstecontact);

                       	$mobile = $value_search['mobile'][0];
                       	$lengthstemobile = 12;
                       	$mobile = $this->countString($mobile, $lengthstemobile);

                       	$email = $value_search['email'][0];
                       	$lengthsteemail = 5;
                       	$email = $this->countString($email, $lengthsteemail);
                       	
                      ?>
                   
                      <tr>
                        <td><span><a target="_blank" href="http://www.namwolf.org/members/?id=<?php echo $value_search['websiteID'][0]; ?>"><abbr title="<?php echo $value_search['FirmName'][0]; ?>">
                        <?php echo $firmname; ?>
                        </abbr></a></span>
                        </td>
                        
                        <td>
                        	<span>
                        		<abbr title="<?php echo $statevalue1; ?>">
                        			<?php echo $statevalue; ?>
                        		</abbr>
                        	</span>
                        </td>

                        <td>
                        	<span>
                        		<abbr title="<?php echo $cityvalue1; ?>">
                        			<?php echo $cityvalue; ?>
                        		</abbr>
                        	</span>
                        </td>
                        <td>
                        	<span>
                        		<abbr title="<?php echo $practiceareavalue1; ?>">
                        			<?php echo $practiceareavalue; ?>
                        		</abbr>
                        	</span>
                        </td>
                        <td>
                        	<span>
                        		<abbr title="<?php echo $subpracticeareavalue1; ?>">
                        			<?php echo $subpracticeareavalue; ?>
                        		</abbr>
                        	</span>
                        </td>
                        <td>
                        	<span>
                        		<abbr title="<?php echo $value_search['contact'][0]; ?>">
                        			<?php echo $contact; ?>
                        		</abbr>
                        	</span>
                        </td>
                        <td>
                        	<span>
                        		<abbr title="<?php echo $value_search['mobile'][0]; ?>">
                        			<?php echo $mobile; ?>
                        		</abbr>
                        	</span>
                        </td>
                        <td>
                        	<span>
                        		<abbr title="<?php echo $value_search['email'][0]; ?>">
                        			<a href="mailto:<?php echo $value_search['email'][0]; ?>">
                        				<?php echo "Email"; ?>
                        			</a>
                        		</abbr>
                        	</span>
                        </td>
                        <td>
                       		<span>
                       			<!-- <abbr title="<?php echo $subpracticeareavalue1; ?>"> -->
                       				<a target="_blank" href="<?php if($value_search['WebsiteUrl'][0] != "") { echo $value_search['WebsiteUrl'][0]; } else { echo "#"; } ?>">
                       					<?php echo "Visit Site"; ?>
                       				</a>
                       			<!-- </abbr> -->
                       		</span>
                       	</td>
                     
                      </tr>
                      <?php } ?>
                       </tbody>
                    </table>
                 </div>
                    <!-- </form> -->
				<?php 
			   
			  
			    }			
			}
		}


		function countString($practiceareavalue, $length) {
			$strlen = strlen($practiceareavalue);
			$len = $length;
			$lngth = ($strlen - $length);
			$val = substr($practiceareavalue, 0, "-".$lngth);

			if($strlen > $len) {
				$value = $val ."......";
			} else {
				$value = $practiceareavalue;
			}
			return $value;
		}
	
} 

?>