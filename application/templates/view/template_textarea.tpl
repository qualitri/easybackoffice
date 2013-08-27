<div class='control-group'>
	<label class='control-label'>{#field_name#}</label>
	<div class='controls'> 
		<textarea placeholder='Insert Data' class='input-xlarge' name='{#field_name#}' id="{#field_id#}">                        
		<?php echo $entity->get{#field_name#}() ?>
		</textarea> 
	</div> 
</div> 