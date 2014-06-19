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
            <?php echo "Field customization ";  
                //echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo "Fields";//echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product updated with success.';
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

      echo form_open('admin/products/update/'.$this->uri->segment(4).'', $attributes);

      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label" >Field Name</label>
            <div class="controls">
              <input type="text" id="" name="fieldname" value="<?php echo $product[0]['FieldName']; ?>"readonly >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Field Id</label>
            <div class="controls">
              <input type="text" id="" name="fieldid" value="<?php echo $product[0]['FieldId']; ?>"readonly>
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Field Label</label>
            <div class="controls">
              <input type="text" id="" name="fieldlabel" value="<?php echo $product[0]['FieldLabel'];?>"readonly>
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Field Type</label>
            <div class="controls">
               <!-- <select name="fieldtype" readonly>
                <option <?php if($product[0]['FieldType'] == "Text") { ?> selected <?php }?> value="Text" disable = true>Text</option>
                <option <?php if($product[0]['FieldType'] == "Dropdown") { ?> selected <?php }?> value="Dropdown" disable = true>Dropdown</option>
                <option <?php if($product[0]['FieldType'] == "Multi-Dropdown") { ?> selected <?php }?> value="Multi-Dropdown"disable = true>Multi-Dropdown</option>
              </select> -->
              <input type="text" name="fieldtype" value="<?php echo $product[0]['FieldType']; ?>" readonly >
               <!-- <input type="text" name="sell_price" value="<?php //echo $product[0]['FieldType']; ?>"> -->
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <?php
          echo '<div class="control-group">';
            echo '<label for="manufacture_id" class="control-label">Field Status</label>';
            echo '<div class="controls">';
              //echo form_dropdown('manufacture_id', $options_manufacture, '', 'class="span2"');
              
              echo form_dropdown('FieldStatus', $options_manufacture, $product[0]['Status'], 'class="span2"');

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
     