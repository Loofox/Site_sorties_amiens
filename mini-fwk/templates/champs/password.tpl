<div class='form-group {$f_error}'>
	<label class='col-sm-2 control-label {$f_error} {$f_required}' for='{$f_id}'>{$f_label}</label>
	<div class='col-sm-6'>
		{if $f_error}
		<div class='input-group'>
		{/if}
			<input type='password' name='{$f_name}' id='{$f_id}' class='form-control' value='{$f_value}'>
		{if $f_error}
			<span class='input-group-addon'><span class='glyphicon glyphicon-exclamation-sign'></span></span>		
		</div>
		{/if}		
	</div>
	{if $f_msg}<span class="help-block">{$f_msg}</span>{/if}
</div>