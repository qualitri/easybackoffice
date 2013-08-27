<form class="form-horizontal" id="add-fields" method="post" action="<?php echo $base_url ?>form_build/save_fields">
	<div class="control-group">
		<div class="controls">
			<h4>Choose Export Mode</h4>
			<label class="checkbox inline">
	        	<input type="checkbox" value="" name="export[]">To the same project 
	        </label>
	        <label class="checkbox inline">
	        	<input type="checkbox" value="" name="export[]">To a new project
	        </label>
	        <label class="checkbox inline">
	        	<input type="checkbox" value="" name="export[]">Download files
	        </label>
		</div>
	</div>	
	<div class="control-group">		
		<div class="controls">
		    <textarea id="txtarea" class="input-xxlarge" name="field_list" rows="10" ><?php echo $field_list ?></textarea>
		    <input class="btn btn-xs btn-success" type="submit" value="Add Fields" />
		</div>
	</div>	
</form>
