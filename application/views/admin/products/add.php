<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
  function validateDropdown(val) {
     $.ajax({
        type: "POST",
        url: "<?php base_url(); ?>AddField",
        data: 'id='+val,
        datatype: "html",
        success: function(result){
          $('#field').html(result);
        }
    })
  }
</script>

    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php
              echo "Field Customization"; 
            //echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo "New Fields";//echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> You have sucessfully added new fields.';
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
      foreach ($manufactures as $row)
      {
        $options_manufacture[$row['id']] = $row['name'];
      }

      //form validation
      echo validation_errors();
      
      echo form_open('admin/products/add', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Field Name</label>
            <div class="controls">
              <input type="text" id="" name="FieldName" value="<?php echo set_value('Field Name'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Field Id</label>
            <div class="controls">
              <input type="text" id="" name="fieldid" value="<?php echo set_value('fielid'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Field Label</label>
            <div class="controls">
              <input type="text" id="" name="fieldlabel" value="<?php echo set_value('fieldlabel'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Field Type</label>
              <div class="controls">
              <select name="fieldtype">
                <option id="textfield">Text</option>
                <option onclick="return validateDropdown(1);">Dropdown</option>
                <option onclick="return validateDropdown(2);">Multi-Dropdown</option>
              </select>
              <!-- <input type="text" name="sell_price" value="<?php //echo set_value('sell_price'); ?>"> -->
              <!--<span class="help-inline">OOps</span>-->
            </div>
            <div id="field" style="margin:8px 0 0 170px;"></div>
          </div>

          



          <?php
          echo '<div class="control-group">';
            echo '<label for="manufacture_id" class="control-label">Field Status</label>';
            echo '<div class="controls">';
              //echo form_dropdown('manufacture_id', $options_manufacture, '', 'class="span2"');
              
              echo form_dropdown('status', $options_manufacture, set_value('manufacture_id'), 'class="span2"');

            echo '</div>';
          echo '</div">';
          ?>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     