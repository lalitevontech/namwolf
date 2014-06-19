
<script type="text/javascript">
$(document).ready(function(){

});

function formSubmit() {
    //$('#submitsearch').trigger("reset");
    //$("#SpracticeareaBlockMain").find('.formRow').not(':eq(0)').remove();

    var form_data = $("#submitsearch").serialize();
    $.ajax({
      url: "search/add",
      type: 'POST',
      data: form_data,
      success: function (data) {
        
          $("#resultgrid").html(data);
        
      }
    });
    return false;
  }

function resetSubmit(){
      $('#submitsearch').trigger("reset");
      $("#SpracticeareaBlockMain").find('.formRow').not(':eq(0)').remove();
      return false;
}  
 


  function validateFieldsMulti(MasterTableName, forignkey, FieldName, id) {
    var fieldid = $("#"+FieldName).val();
   
      var fieldvalue = $("#fieldvaluemulti").val();
      var count = fieldid.length;
      $.ajax({
          type: "POST",
          url: "<?php base_url(); ?>search/searchByField",
          data: 'id='+fieldid+'&mastertable='+MasterTableName+'&foreignkey='+forignkey+'&fieldval='+fieldvalue+'&count='+count,
          datatype: "html",
          success: function(result){
             if(fieldid.length == 1) {
              $('#field_'+id).html(result);
              
              $('#SubPRCTA_'+fieldid).multiselect();
            } else {
               $('#field_'+id).html(result);
              
              $('#SubPRCTA_'+fieldvalue).multiselect();
            }
          }
      })
    }

  function RemoveMorePracticeArea(practiceAreaCount) {
    document.getElementById("removebasedonidpa_"+practiceAreaCount).remove();
  }
  function validateFields(val, MasterTableName, forignkey, FieldName, id, count1) {
    
    var fieldvalue = $("#practice_area_count").val();
   
    $('#SubPRCTA_'+fieldvalue).multiselect();
    var fieldid = $("#fieldid").val();
    var count = 1;

    $.ajax({
        type: "POST",
        url: "<?php base_url(); ?>search/searchByField",
        data: 'id='+val+'&mastertable='+MasterTableName+'&foreignkey='+forignkey+'&fieldval='+fieldvalue+'&count='+count,
        datatype: "html",
        success: function(result){
          $('#field_'+count1).html(result);
          
          $('#SubPRCTA_'+val).multiselect();
          $("#practice_area_count").val(val);
        }
    })
  } 
</script>

<?php error_reporting(0); ?>
 <section class="wrapper">
    <div class="formContainer">
        <h1>NAMWOLF Member Firm Search</h1>
      
      
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> You have sucessfully added user form';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      $options_manufacture = array('' => "Select", "A" => "Active", "D" => "Deactive");
      
      //form validation
      echo validation_errors();
      
      // echo form_open('search/add', $attributes);
      $webid = $this->uri->segment(2);
      ?>
      <form id="submitsearch">  
       <input type="hidden" name="sortby" id="sortby" value="">
        <input type="hidden" name="sortingStatus" id="sortingStatus" value="ASC">
       <input type="hidden" name="pagenumber" id="pagenumber" value="1">
        <input type="hidden" name="startfrom" id="startfrom" value="0">
      <dl>
           
            <?php
                $i = 1;
                // echo "<pre>"; print_r($mastertabledata);exit;
                foreach($mastertabledata AS $keyval=>$value) {
                  $practice_area_count =$keyval + 1;
                  $FieldCount = $value['Id'];

                  if($value['FieldType'] == "Text") {
              ?>
             
                    <div class="formRow">
                      <dt>Search By <?php echo $value['FieldLabel']; ?></dt>
                      <dd><input type="text" name="<?php echo $value['FieldName']; ?>" id="<?php echo $value['FieldId']; ?>"></dd>
                    </div>
            <?php 
                  }
              ?>
              <!-- <div id="SpracticeareaBlockMain"> -->
                    <?php if($value['FieldType'] == "Dropdown") {
                        
                          ?>
                          <div id="SpracticeareaBlockMain">
                            <div class="formRow">
                                <div id="removebasedonidpa_<?php echo $practice_area_count; ?>">
                              <dt>Search By <?php echo $value['FieldLabel']; ?></dt>
                                <dd name="<?php echo $value['FieldName']; ?>" class="<?php echo $value['FieldId']; ?>">
                                  <select name="<?php echo $value['FieldName']; ?>[]" id="<?php echo $value['FieldId']."_".$practice_area_count; ?>">
                                  <?php if($value['FieldLabel'] == "MBE WBE") { ?>
                                   <option value="">MBE/WBE</option>
                                  <?php } else { ?>
                                      <option value=""><?php echo $value['FieldLabel']; ?></option>
                                      <?php } ?>
                                      <?php foreach($value['master_data'] AS $key=>$mastervalue) { ?>

                                      <option value="<?php if($value['FieldId'] == "Mbe_Wbe" || $value['FieldId'] == "Attorneys") { echo $mastervalue['FieldValue']; } else { echo $mastervalue['Id']; } ?>" <?php if($value['FieldEvent'] == "Active") { ?> onclick="return validateFields('<?php echo $mastervalue['Id']; ?>', '<?php echo $value['ConnectingMasterTable']; ?>', '<?php echo $value['ConnectingTableForeignkeyName']; ?>', '<?php echo $value['FieldLabel']; ?>', '<?php echo $value['Id']; ?>', '<?php echo $practice_area_count; ?>');" <?php } ?>><?php echo $mastervalue['FieldValue']; ?></option>
                                     <?php } ?>
                                  </select>
                              </dd>
                               <dt><?php echo ucfirst(str_replace("_", " ", $value['ConnectingMasterTable'])); ?></dt>
                            <?php if($value['FieldEvent'] == "Active") { ?>
                            <dd id="field_<?php echo $practice_area_count; ?>" class="SPA">
                                 <select multiple="multiple" class="multiple" name="subpracticearea[]" id="SubPRCTA_<?php echo $value['Id']; ?>">
                                    <option value="City"></option>
                                </select>
                            </dd>
                              <script type="text/javascript">
                                  $('#SubPRCTA_<?php echo $value['Id']; ?>').multiselect();
                              </script>
                            <?php } ?>
                            <?php if($value['FieldName'] == "Practice_Area") { ?>
                               <script type="text/javascript">
                                 function AddMorePracticeArea(){
                                    var practiceAreaCountval=$("#practice_area_count").val();
                                    var firstpracvalue = $("#Practice_Area_3").val();

                                    if(firstpracvalue == "") {
                                      alert("Please select atleast one Practicearea");
                                      return false;
                                    }
                                    
                                    practiceAreaCount=parseInt(practiceAreaCountval) + 1;
                                    var results = [];
                                    $("select[name='Practice_Area[]']").each(function(){
                                      var val = $(this).find('option:selected').text();
                                      if(val !== '') { 
                                         results.push(val);  
                                      }
                                    });

                                    var practiceareavalue = $("#Practice_Area_"+practiceAreaCountval+"").val();

                                    if(practiceareavalue == '') {
                                      alert("Please select atleast one Practicearea");
                                      return false;
                                    }

                                    $("#practice_area_count").val(practiceAreaCount);

                                    var newNode = document.createElement('div');  
                                    newNode.setAttribute('class','formRow'); 
                                    var practiceAreaStr = "<div id=\"removebasedonidpa_"+practiceAreaCount+"\"><a href=\"javascript:void(0);\" onclick=\"RemoveMorePracticeArea("+practiceAreaCount+");\" class=\"remove\">Remove</a>";
                                       practiceAreaStr +=  "<dt>Search By <?php echo $value['FieldLabel']; ?></dt>";
                                       practiceAreaStr +=  "<dd name=\"<?php echo $value['FieldName']; ?>\" class=\"<?php echo $value['FieldId']; ?>\" style=\"margin-left: 3px;\">";
                                       practiceAreaStr +=  "<select name=\"<?php echo $value['FieldName']; ?>[]\" id=\"Practice_Area_"+practiceAreaCount+"\">";
                                       practiceAreaStr += "<option value=\"\"> <?php echo $value['FieldLabel']; ?></option>";
                                       practiceAreaStr += "<?php foreach($value['master_data'] AS $key=>$mastervalue) { ?>";
                                       practiceAreaStr += "<option onclick=\"return validateFields('<?php echo $mastervalue['Id']; ?>', '<?php echo $value['ConnectingMasterTable']; ?>', '<?php echo $value['ConnectingTableForeignkeyName']; ?>', '<?php echo $value['FieldLabel']; ?>', '<?php echo $value['Id']; ?>', practiceAreaCount);\" value=\"<?php echo $mastervalue['Id']; ?>\"";

                                       for(var i=0;i<results.length;i++){
                                         if("<?php echo $mastervalue['FieldValue']; ?>"==results[i])
                                         practiceAreaStr += " disabled='disabled' ";
                                       }

                                       practiceAreaStr += "value=\"<?php echo $mastervalue['FieldValue']; ?>\">";
                                       practiceAreaStr += "<?php echo $mastervalue['FieldValue']; ?>";
                                       practiceAreaStr += "</option>";
                                       practiceAreaStr += "<?php } ?>";
                                       practiceAreaStr += "</select></dd>";
                                       practiceAreaStr += "<dt class=\"minPadding\"><?php echo ucfirst(str_replace("_", " ", $value['ConnectingMasterTable'])); ?></dt>";
                                       practiceAreaStr += "<dd id=\"field_"+practiceAreaCount+"\" class=\"SPA\" style=\"float: right;margin: 0 67px 0 0;\">";
                                       practiceAreaStr += "<select multiple=\"multiple\" class=\"multiple\" id=\"SubPRCTA_"+practiceAreaCount+"\" name=\"subpracticearea[]\">";
                                       practiceAreaStr += "<option value=\"City\"></option>";
                                       practiceAreaStr += "</select></dd></div>";
                                      
                                    var iDiv = document.getElementById('SpracticeareaBlockMain');
                                    newNode.innerHTML = practiceAreaStr;
                                    iDiv.appendChild(newNode);
                                    
                                    $('#SubPRCTA_'+practiceAreaCount).multiselect();
                                }
                              </script>
                              </div> 
                              </div>
                              </div>
                              <a href="javascript:void(0);" onclick="return AddMorePracticeArea();" class="anchorcolor add">Add Additional Practice Area</a>
                             <?php } ?>

                              <!-- <div ></div> -->
                             
                            
                          <?php 
                        }

                      ?>
                       
                           
                        <!-- </div> -->
                        <?php 
                        if($value['FieldType'] == "Multi-Dropdown") {
                          //echo "<pre>"; print_r($value);
                          ?>
                          <div class="formRow">
                             <dt>Search By <?php echo $value['FieldLabel']; ?></dt>
                              <dd class="<?php echo $value['FieldId']; ?>">
                                <select multiple <?php if($value['FieldEvent'] == "Active") { ?> onchange="return validateFieldsMulti('<?php echo $value['ConnectingMasterTable']; ?>', '<?php echo $value['ConnectingTableForeignkeyName']; ?>', '<?php echo $value['FieldLabel']; ?>', '<?php echo $value['Id']; ?>');" <?php } ?> name="<?php echo $value['FieldName']; ?>[]" id="<?php echo $value['FieldId']; ?>" >
                                   <?php foreach($value['master_data'] AS $mastervalue) { ?>

                                    <option value="<?php echo $mastervalue['Id']; ?>"><?php echo $mastervalue['FieldValue']; ?></option>
                                  <?php } ?>
                                </select>
                            </dd>
                             <dt><?php echo ucfirst(str_replace("_", " ", $value['ConnectingMasterTable'])); ?></dt>
                            <?php if($value['FieldEvent'] == "Active") { ?>
                            <dd id="field_<?php echo $FieldCount; ?>" class="SPA">
                                 <select multiple="multiple" class="multiple" id="SubPRCTA_<?php echo $value['Id']; ?>">
                                    <option value=" "></option>
                                </select>
                            </dd>
                              <script type="text/javascript">
                                  $('#SubPRCTA_<?php echo $value['Id']; ?>').multiselect();
                              </script>
                            <?php } ?>

                          
                          </div>  
                            <script type="text/javascript">$('#<?php echo $value['FieldId']; ?>').multiselect();</script>
                    <?php 
                        }
                        $i++;
                        
                       
                    }

                  ?>    
                  <input type="hidden" name="fieldvalue" id="fieldvalue" value="<?php echo $FieldCount; ?>">
                  <input type="hidden" id="practice_area_count" value="<?php echo $practice_area_count; ?>">
                  <input type="hidden" name="fieldvaluemulti" id="fieldvaluemulti" value="<?php echo $FieldCount; ?>">
                  <div class="buttonBlock">
                    <button class="submitBTN" type="submit" onclick="return formSubmit();">Search</button>
                    <button class="submitBTN" type="submit" onclick="return resetSubmit();">Reset</button>
                  </div>
                  </form>
            <?php //echo form_close(); ?>  
            </div>           
                </section>   
      <div class="searchTableData" id="resultgrid"></div>
      <div id="searchnoresult"></div>         
               

    
     