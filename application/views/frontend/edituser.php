<?php error_reporting(0); ?>

<script type="text/javascript">

  

    /*Form Validation */
      function validateForm() {
        var firm_name = $("#firm_name").val();
        var state = $("#state_1").val();
        var practicearea = $("#practice_area_1").val();
        var mbe_wbe = $("#mbe_wbe").val();
        var firmsizevalue = $("#firmsizevalue").val();
        var attorneys = $("#attorneys").val();

        if(firm_name == "") {
          alert("Please enter firm name!");
          $("#firm_name").focus();
          return false;
        } else if(state == "") {
          alert("Please select atleast one state");
          $("#state_1").focus();
          return false;
        } else if(practicearea == " ") {
          alert("Please select atleast one Practice Area");
          $("#practice_area_1").focus();
          return false;
        } else if(mbe_wbe == ""){
          alert("Please select atleast one MBE & WBE");
          $("#mbe_wbe").focus();
          return false;
        } else if(firmsizevalue == "") {
          alert("Please select atleast one Firm Size");
          $("#firmsizevalue").focus();
          return false;
        } else if(attorneys == "") {
          alert("Please select atleast one Average Attorneys Experience");
          $("#attorneys").focus();
          return false;
        }
        else {
          return true;
        }
        
      }



    /*End Of form validation*/

$(document).ready(function(){
  // jQuery.noConflict();
  $('#subpractisearea_1').multiselect();
  $('#city_state_1').multiselect();
  $('#specific_areas_of_law').multiselect();
  $('#specific_languages').multiselect();
  $('#state_courts').multiselect();
  $('#federal_courts').multiselect();
  $('#mbe_wbe').multiselect();
});
  
  function AddCityValue(val, count) {
    var StateCount=$("#state_count").val();
    var stateid = $('#statevalueid_'+StateCount).val();
    var programs = $("#newItem_"+count).val();

    if(programs == "") {
      alert("Please enter city name");
      return false;
    }
    
    $.ajax({
        type: "POST",
        url: "<?php base_url(); ?>updatedCity",
        data: 'stateid='+val+'&count='+StateCount+'&cityname='+programs,
        datatype: "html",
        success: function(result){

          if(result == "true") {
              var el = $("select#city_state_"+count).multiselect();
              var v = programs, opt = $('<option />', {
                  value: v,
                  text: v
              });
              opt.attr('selected','selected');
              
              opt.appendTo( el );
              
              el.multiselect('refresh');
              $("#newItem_"+StateCount).val('');
              alert("You have sucessfully added new city!");
          } else {
            alert("The city name which you entered is already existed. Please try again.");  
            return false;
          }
        }
      })
  }
  
  function AddCity() {
   
    var StateCount=$("#state_count").val();
    var stateid = $('#statevalueid_'+StateCount).val();
    var programs = $("#newItem_"+StateCount).val(); //get value of selected option
    
    if(programs == "") {
      alert("Please enter city name");
      return false;
    }
    
    $.ajax({
        type: "POST",
        url: "<?php base_url(); ?>updatedCity",
        data: 'stateid='+stateid+'&count='+StateCount+'&cityname='+programs,
        datatype: "html",
        success: function(result){

          if(result == "true") {
              var el = $("select#city_state_"+StateCount).multiselect();
              var v = programs, opt = $('<option />', {
                  value: v,
                  text: v
              });
              opt.attr('selected','selected');
              
              opt.appendTo( el );
              
              el.multiselect('refresh');
              $("#newItem_"+StateCount).val('');
              alert("You have sucessfully added new city!");
          } else {
            alert("The city name which you entered is already existed. Please try again.");  
            return false;
          }
        }
      })
 }


  function getPracticeAreaValue(val,elemId){

      $.ajax({
        type: "POST",
        url: "<?php base_url(); ?>getSubPracticeArea",
        data: 'id='+val+'&count='+elemId,
        datatype: "html",
        success: function(result){
          $('#sub_practice_area_block_'+elemId).html(result);
          $('#subpractisearea_'+elemId).multiselect();
        }
      })
    }

    function getState(val,elemId) {
      
      $('#statevalueid_'+elemId).val(val);
      $.ajax({
        type: "POST",
        url: "<?php base_url(); ?>getCity",
        data: 'id='+val+'&count='+elemId,
        datatype: "html",
        success: function(result){
          $('#city_'+elemId).html(result);
          $('#city_state_'+elemId).multiselect();
        }
      })

    }

    function RemoveMorePracticeArea(practiceAreaCount) {
      document.getElementById("removebasedonidpa_"+practiceAreaCount).remove();
    }

    function RemoveMoreCity(StateCount) {
      document.getElementById("removebasedonid_"+StateCount).remove();
    }

    function countSubpracticearea() {
        var multipleValues = $("#multiplevalue").val() || "";
        var result = "";

        if (multipleValues != "") {
            var aVal = multipleValues.toString().split(",");
            var count = $("#multiplevalue :selected").length;
            $("#countSubpracticearea").val("Number of Subpractice area=" + count);
        }
    }

   
   function AddMoreCity() {
     var StateCount=$("#state_count").val();

     
      var results = [];
      $("select[name='state[]']").each(function(){
        var val = $(this).find('option:selected').text();

        if(val !== '') { 
          results.push(val);  
        }
      });
      var statevalue = $("#state_"+StateCount+"").val();

      if(statevalue == '') {
        alert("Please select atleast one state");
        return false;
      }
     
      StateCount=parseInt(StateCount) + 1;
     
      $("#state_count").val(StateCount);
      var newNode = document.createElement('div');  
      newNode.setAttribute('class','formRow1');    

      var StateStr = "<div class=\"formRow\" id=\"addCityblock\"><div id=\"city1_"+StateCount+"\"><div id=\"removebasedonid_"+StateCount+"\"><a href=\"javascript:void(0);\" onclick=\"RemoveMoreCity("+StateCount+");\" class=\"remove\">Remove</a><dt><label for=\"inputError\" class=\"control-label\">Office Locations</label></dt><dd><select name=\"state[]\" id=\"state_"+StateCount+"\"><?php foreach($state AS $state_value) { ?><option onclick=\"return getState(<?php echo $state_value['Id']; ?>,"+StateCount+")\"";

      for(var i=0;i<results.length;i++){
         if("<?php echo $state_value['FieldValue'] ?>"==results[i])
         StateStr += " disabled='disabled' ";
      }
      StateStr +=" value=\"<?php echo $state_value['Id'].':'.$state_value['FieldValue']; ?>\"><?php echo $state_value['FieldValue']; ?></option><?php  } ?></select></dd><?php foreach($state AS $state_value) { ?><?php } ?><input type=\"hidden\" name=\"statevalueid\" id=\"statevalueid_"+StateCount+"\" value=\"blank\"><dt class=\"minPadding\">City</dt><dd class=\"formBlock\" id=\"city_"+StateCount+"\" style=\"float: right;margin: 0 45px 0 0;\"><select  name=\"city_"+StateCount+"[]\" multiple=\"\" id=\"city_state_"+StateCount+"\"><option></option></select><div class=\"newCity\"><input type=\"text\" placeholder=\"Add a new city\" id=\"newItem_"+StateCount+"\" /><a href=\"javascript:void(0);\" id=\"add\">Add</a></div></dd><div class=\"clr\"></div></div></div>";

      var iDiv = document.getElementById('StateBlockMain');
      newNode.innerHTML = StateStr;
      iDiv.appendChild(newNode);
      $('#city_state_'+StateCount).multiselect();
      // $('.formRow .remove').show();
   }

   function AddMorePracticeArea(){
      var practiceAreaCount=$("#practice_area_count").val();
      var results = [];
      $("select[name='practice_area[]']").each(function(){
        var val = $(this).find('option:selected').text();
        if(val !== '') { 
           results.push(val);  
        }
      });
      var practiceareavalue = $("#practice_area_"+practiceAreaCount+"").val();

      if(practiceareavalue == '') {
        alert("Please select atleast one Practicearea");
        return false;
      }

      practiceAreaCount=parseInt(practiceAreaCount) + 1;
      $("#practice_area_count").val(practiceAreaCount);
      var newNode = document.createElement('div');  
      newNode.setAttribute('class','formRow');    

      var practiceAreaStr = " <div id=\"practiceArea_"+practiceAreaCount+"\"><div id=\"removebasedonidpa_"+practiceAreaCount+"\"><a href=\"javascript:void(0);\" onclick=\"RemoveMorePracticeArea("+practiceAreaCount+");\" class=\"remove\">Remove</a><dt>Practice Areas</dt> <dd><select name=\"practice_area[]\" id=\"practice_area_"+practiceAreaCount+"\"><option value=\"\">Select Practice Area</option> <?php foreach($practice_area AS $practice_area_value) { ?><option onclick=\"return getPracticeAreaValue(<?php echo $practice_area_value['Id']; ?>,"+practiceAreaCount+");\"";

      for(var i=0;i<results.length;i++){
         if("<?php echo $practice_area_value['FieldValue'] ?>"==results[i])
         practiceAreaStr += " disabled='disabled' ";
      }
      practiceAreaStr +=" value=\"<?php echo $practice_area_value['Id'].':'.$practice_area_value['FieldValue']; ?>\"><?php echo $practice_area_value['FieldValue']; ?></option><?php  } ?></select></dd><?php foreach($practice_area AS $practice_area_value) { ?><?php } ?><dt class=\"fulMinPadding\">Sub Practice Areas</dt><dd class=\"formBlock\" id=\"sub_practice_area_block_"+practiceAreaCount+"\" style=\"float: right;margin: 0 67px 0 0;\"><select name=\"sub_practice_area_"+practiceAreaCount+"[]\" multiple=\"\" id=\"subpractisearea_"+practiceAreaCount+"\"><option></option></select></dd><div class=\"clr\"></div></div>";

      var iDiv = document.getElementById('SpracticeareaBlockMain');
      newNode.innerHTML = practiceAreaStr;
      iDiv.appendChild(newNode);
      $('#subpractisearea_'+practiceAreaCount).multiselect();
    }

</script>

<section class="wrapper">
    <div class="formContainer">
        <h1>Edit NAMWOLF Member Firm Search Profile</h1>
     <?php
        $flash_message = $this->uri->segment(3);
        if(isset($flash_message)){
          
          if($flash_message == "sucess") {
            echo '<div class="alert alert-success">';
            // echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<font color="#1C94C4"><strong>Well done!</strong> You have sucessfully added user form</font>';
            echo '</div>';       
          }
        }
        $attributes = array('class' => 'form-horizontal', 'id' => '');
        $options_manufacture = array('' => "Select", "A" => "Active", "D" => "Deactive");
        
        //form validation
        
        echo validation_errors();
        
        $webid = $_GET['webid'];
        echo form_open('edit_user_form/add', $attributes);
       
    ?>     
       
          <dl>
            <div class="formRow">
                <dt>
                  <label for="inputError" class="control-label">Firm Name</label>
                </dt>

                <dd class="width49">
                  <div class="controls">
                    <input type="text" name="firm_name" id="firm_name" value="<?php echo $FirmName; ?>">
                  </div>
                </dd>
            </div>
            <input type="hidden" name="contact" value="<?php echo $contact; ?>">
            <input type="hidden" name="mobile" value="<?php echo $mobile; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="webid" id="webid" value="<?php echo $webid; ?>">
            <input type="hidden" name="website" id="website" value="<?php echo $Website;?>">

            <div id="StateBlockMain">
            <?php if($stateCityValue[0]['STATE'] != '')  { ?> 
            <?php     
                    $alreadySelectedEstate=array();
                    foreach($stateCityValue AS $key_state_city=>$StateCity_Value) {
                      $alreadySelectedEstate[$key_state_city]=$StateCity_Value['STATE'];
                    }
                    foreach($stateCityValue AS $key_state_city=>$StateCity_Value) { 
                      $state_count=$key_state_city + 1; 
                      $stateId=0; 
                      $tempStateArray=$alreadySelectedEstate; 
                      unset($tempStateArray[$key_state_city]);
             ?>
          <div id="StateBlock">
            <div class="formRow1">
              <div class="formRow" id="addCityblock">
                 
                    <div id="city1_<?php echo $state_count; ?>">
                     <div id="removebasedonid_<?php echo $state_count; ?>">
                      <?php if($state_count > 1){ ?>
                      <a href="javascript:void(0);" onclick="RemoveMoreCity(<?php echo $state_count; ?>)" class="remove">Remove</a>
                      <?php } ?>
                        <dt>
                            <label for="inputError" class="control-label">Office Locations</label>
                        </dt>
                        <dd>
                          <select name="state[]" id="state_1">
                            <option value=" ">Select State</option>
                            <?php foreach($state AS $state_value) { ?>
                            <option value="<?php echo $state_value['Id'].":".$state_value['FieldValue']; ?>" <?php if(in_array($state_value['FieldValue'],$tempStateArray)) {echo "disabled='disabled'";} ?> <?php if($state_value['FieldValue'] == $StateCity_Value['STATE']) { echo 'selected="selected"'; $stateId=$state_value['Id']; }?>onclick="return getState(<?php echo $state_value['Id']; ?>,1);"><?php echo $state_value['FieldValue']; ?></option>
                            <?php } ?>

                          </select>
                        </dd>
                        <?php //echo "<pre>"; print_r($StateCity_Value);exit;?>
                        
                        <!-- <div class="formBlock" id="city_<?php //echo $state_count; ?>"> -->
                        <input type="hidden" id="statevalueid_<?php echo $state_count; ?>" value="<?php echo $state_count; ?>">
                          <dt>City</dt>
                          <dd class="formBlock" id="city_<?php echo $state_count; ?>">
                            <select multiple="" name="city_<?php echo $stateId; ?>[]" id="city_state_<?php echo $state_count; ?>">
                              <?php foreach($StateCity_Value['CITYMASTER'] AS $subCityValue) { ?>
                              <option value="<?php echo $subCityValue['FieldValue']; ?>" <?php foreach($StateCity_Value['CITY'] AS $valCityState) { if($subCityValue['FieldValue'] == $valCityState) { echo 'selected="selected"'; } }?>><?php echo $subCityValue['FieldValue']; ?></option>
                              <?php } ?>
                            </select>
                        
                            <div class="newCity">
                                <input type="text" placeholder="Add a new city" id="newItem_<?php echo $state_count; ?>" />
                                <a href="javascript:void(0);" id="add" onclick="return AddCityValue('<?php echo $stateId; ?>', '<?php echo $state_count; ?>'); ">Add</a>
                            </div>
                          </dd>
                        </div>
                    </div>
                    <!-- <a href="javascript:void(0);" onclick="AddMoreCity();" class="add addCity">Add Additional State</a> -->
                </div>
              </div>
            </div>
            <script type="text/javascript">
              $('#city_state_<?php echo $state_count; ?>').multiselect();
            </script>
          <?php
           } } else { 
          ?>
          <div id="StateBlock">
            <div class="formRow1">
              <div class="formRow" id="addCityblock">
                    <div id="city1_<?php echo $state_count; ?>">
                      
                        <dt>
                            <label for="inputError" class="control-label">Office Locations State</label>
                        </dt>
                        <dd>
                          <select name="state[]" id="state_1">
                            <option value="">Select State</option>
                            <?php foreach($state AS $state_value) { ?>
                            <option value="<?php echo $state_value['Id'].":".$state_value['FieldValue']; ?>" onclick="return getState(<?php echo $state_value['Id']; ?>,1);"><?php echo $state_value['FieldValue']; ?></option>
                            <?php } ?>
                          </select>
                        </dd>
                        
                        <input type="hidden" name="statevalueid" id="statevalueid_<?php echo $state_count; ?>" value="">
                          <dt>City</dt>
                          <dd class="formBlock" id="city_<?php echo $state_count; ?>">
                            <select multiple="" name="city_1[]" id="city_state_<?php echo $state_count; ?>">
                              <option></option>
                            </select>
                        
                            <div class="newCity">
                                <input type="text" placeholder="Add a new city" id="newItem_<?php echo $state_count; ?>" />
                                <a href="javascript:void(0);" id="add" onclick="return AddCity(); ">Add</a>
                            </div>
                          </dd>
                       
                    </div>
                    
                </div>
              </div>
            </div>
          <?php } ?>
          </div>
          <a href="javascript:void(0);" onclick="AddMoreCity();" class="anchorcolor add">Add Additional State</a>
          <input type="hidden" id="state_count" value="<?php echo $state_count; ?>">
          
           <div id="SpracticeareaBlockMain">
          <?php 
            
            if($practiceareaArray[0]['PA'] != '') { 

                    $alreadySelectedPA=array();
                    foreach($practiceareaArray AS $key=>$PracTiceValue) { 
                      $alreadySelectedPA[]=$PracTiceValue['PA'];
                    }
                foreach($practiceareaArray AS $key=>$PracTiceValue) { 
                  $practice_area_count=$key + 1; $practiceareaId=0; 
                  $temptracticeAreaArray=$alreadySelectedPA; 
                      unset($temptracticeAreaArray[$key]); 
          ?>
          <div id="PracticeAreaBlock">
            <div class="formRow" id="areaBlock">
              <div id="practiceArea_<?php echo $practice_area_count; ?>">
                <div id="removebasedonidpa_<?php echo $practice_area_count; ?>">
                   <?php if($practice_area_count > 1){ ?>
                  <a href="javascript:void(0);" onclick="RemoveMorePracticeArea(<?php echo $practice_area_count; ?>);" class="remove">Remove</a>
                  <?php } ?>
                  <dt>
                      Practice Areas
                  </dt>
                  <dd>
                      <select name="practice_area[]" id="practice_area_1">
                       <option value="">Select Practice Area</option> 
                        <?php foreach($practice_area AS $practice_area_value) { ?>
                                  <option value="<?php echo $practice_area_value['Id'].":".$practice_area_value['FieldValue']; ?>" <?php if(in_array($practice_area_value['FieldValue'], $temptracticeAreaArray)) {echo "disabled='disabled'";} ?> <?php  if($PracTiceValue['PA'] == $practice_area_value['FieldValue']) { echo 'selected="selected"'; $practiceareaId=$practice_area_value['Id']; }?>onclick="return getPracticeAreaValue(<?php echo $practice_area_value['Id']; ?>,1);"><?php echo $practice_area_value['FieldValue']; ?></option>
                        <?php  } ?>
                      </select>
                  </dd>
                  <dt>
                      Sub Practice Areas
                  </dt>
                  <dd class="formBlock" id="sub_practice_area_block_<?php echo $practice_area_count; ?>">
                      <select multiple="" name="subpractisearea_<?php echo $practiceareaId; ?>[]" id="subpractisearea_<?php echo $practice_area_count; ?>">
                        
                         <?php foreach($PracTiceValue['SPAMASTER'] AS $subValue) { ?>
                           <option value="<?php echo $subValue['FieldValue']; ?>" <?php foreach($PracTiceValue['SPA'] AS $val) { if($subValue['FieldValue'] == $val) { echo 'selected="selected"'; } }?>><?php echo $subValue['FieldValue']; ?></option>
                           <?php } ?>
                      </select> 
                  </dd>
              </div>
              </div>
              
          </div>
          </div>
          <script type="text/javascript">
            $('#subpractisearea_<?php echo $practice_area_count; ?>').multiselect();
          </script>

           <?php } } else { ?>
            <div id="PracticeAreaBlock">
            <div class="formRow" id="areaBlock">
              <div id="practiceArea">
                  
                  <dt>
                      Practice Areas
                  </dt>
                  <dd>
                      <select name="practice_area[]" id="practice_area_1">
                        <option value="">Select Practice Area</option> 
                        <?php foreach($practice_area AS $practice_area_value) { ?>
                                  <option value="<?php echo $practice_area_value['Id'].":".$practice_area_value['FieldValue']; ?>" <?php  if($PracTiceValue['PA'] == $practice_area_value['FieldValue']) { echo 'selected="selected"'; $practiceareaId=$practice_area_value['Id']; }?>onclick="return getPracticeAreaValue(<?php echo $practice_area_value['Id']; ?>,1);"><?php echo $practice_area_value['FieldValue']; ?></option>
                        <?php  } ?>
                      </select>
                  </dd>
                  <dt>
                      Sub Practice Areas
                  </dt>
                  <dd class="formBlock" id="sub_practice_area_block_<?php echo $practice_area_count; ?>">
                    <select multiple="" name="subpractisearea_1[]" id="subpractisearea_1">
                      <option value=" "></option>
                    </select>
                  </dd>
              </div>
             
          </div>
          </div>
          <script type="text/javascript">
            $('#subpractisearea_<?php echo $practice_area_count; ?>').multiselect();
          </script>

           <?php } ?>
           </div>
            <a href="javascript:void(0);" onclick="AddMorePracticeArea();" class="anchorcolor add">Add Additional Practice Area</a>
            <input type="hidden" id="practice_area_count" value="<?php echo $practice_area_count; ?>">
          

            <div class="formRow">
              <dt>
                  MBE & WBE
              </dt>
              <dd class="width49">
              <?php $mbearray = array("MBE" => '1', "WBE" => '2'); ?>
                <select multiple="" name="mbe_wbe[]" id="mbe_wbe">
                    
                   <?php foreach($mbearray AS $keyMbeWbe => $mbe_wbe_value) { ?>
                    <option value="<?php echo $mbe_wbe_value.":".$keyMbeWbe; ?>" <?php foreach($MBE_WBE AS $valmbe) { if($keyMbeWbe == $valmbe) { echo 'selected="selected"'; } } ?>><?php echo $keyMbeWbe; ?></option>
                    <?php } ?>
              </select>
              </dd>
            </div>

            <div class="formRow">
              <dt>
                  Firm Size
              </dt>
              <dd class="width47">
                <select name="firm_size" id="firmsizevalue">
                 
                  <?php foreach($firmsize AS $firmsize_value) { ?>
                  <option value="<?php echo $firmsize_value['FieldValue']; ?>" <?php if($firmsize_value['FieldValue'] == $FirmSize) { echo 'selected = "select"';}?>><?php echo $firmsize_value['FieldValue']; ?></option>
                  <?php } ?>
                </select>
              </dd>
            </div>

            <div class="formRow">
              <dt>
                 Average Attorney Experience
              </dt>
              <dd class="width47">
                <select name="attorneys" id="attorneys">
                  
                  <?php foreach($attorneys AS $attorneys_value) { ?>
                  <option value="<?php echo $attorneys_value['FieldValue']; ?>" <?php if($attorneys_value['FieldValue'] == $Attorneys) { echo 'selected="select"'; }?> ><?php echo $attorneys_value['FieldValue']; ?></option>
                  <?php } ?>
                </select>
              </dd>
          </div>

          <div class="formRow">
            <dt>Representative Transactions</dt>
            <dd class="width45">
              <textarea name="representation_transaction" id="representation_transaction"><?php echo $RepresentativeTransactions; ?></textarea>
            </dd>
          </div>

          <div class="formRow">
            <dt>Representative Cases</dt>
            <dd class="width45">
              <textarea name="representation_cases" id="representation_cases" ><?php echo $RepresentativeCases; ?></textarea>
            </dd>
          </div>

          <div class="formRow">
              <dt>
                  Specific Areas of Law
              </dt>
              <dd class="width49">
                <select multiple="" name="specific_areas_of_law[]" id="specific_areas_of_law">
                 
                  <?php foreach($specific_areas_of_law AS $specific_areas_of_law_value) { ?>
                  <option value="<?php echo $specific_areas_of_law_value['Id'].":".$specific_areas_of_law_value['FieldValue']; ?>" <?php foreach($SpecificAreasofLaw AS $valSARL) { if($specific_areas_of_law_value['FieldValue'] == $valSARL) {echo 'selected="select"'; } } ?>><?php echo $specific_areas_of_law_value['FieldValue']; ?></option>
                  <?php } ?>
                </select>
              </dd>
          </div>

          <div class="formRow">
              <dt>
                  Specific Languages
              </dt>
              <dd class="width49">
                <select multiple="" name="specific_languages[]" id="specific_languages">
                   
                    <?php foreach($specificlanguages AS $specificlanguages_value) { ?>
                    <option value="<?php echo $specificlanguages_value['Id'].":".$specificlanguages_value['FieldValue']; ?>" <?php foreach($SpecificLanguages AS $valueSPLANG) { if($specificlanguages_value['FieldValue'] == $valueSPLANG) {echo 'selected="select"';}}?>><?php echo $specificlanguages_value['FieldValue']; ?></option>
                    <?php } ?>
                </select>
              </dd>
          </div>

          <div class="formRow">
              <dt>
                  State Courts
              </dt>
              <dd class="width49">
                <select multiple="" name="state_courts[]" id="state_courts">
                   
                    <?php foreach($statecourtvalue AS $state_value) { ?>
                    <option value="<?php echo $state_value['Id'].":".$state_value['FieldValue']; ?>" <?php foreach($StateCourts AS $valueSTCRT) { if($state_value['FieldValue'] == $valueSTCRT) {echo 'selected="select"';} }?> ><?php echo $state_value['FieldValue']; ?></option>
                    <?php } ?>
                </select>
              </dd>
          </div>

          <div class="formRow">
              <dt>
                  Federal Courts
              </dt>
              <dd class="width49">
                <select multiple="" name="federal_courts[]" id="federal_courts">
                   
                    <?php foreach($fedaral_courts AS $fedaral_courts_value) { ?>
                    <option value="<?php echo $fedaral_courts_value['Id'].":".$fedaral_courts_value['FieldValue']; ?>" <?php foreach($FederalCourts AS $vaueFDRCRT) { if($fedaral_courts_value['FieldValue'] == $vaueFDRCRT) {echo 'selected="select"';} } ?>><?php echo $fedaral_courts_value['FieldValue']; ?></option>
                    <?php } ?>
                </select>
              </dd>
          </div>
        </dl>
        <div class="buttonBlock">
            <button class="submitBTN" type="submit" onclick="return validateForm();">Update Member Profile Changes</button>
        </div>
        
      <?php echo form_close(); ?>

    </div>
  </section>
     