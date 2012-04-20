{literal}
<script type="text/javascript">	
	
function checkSubmit()
{	
	var re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
	var email = $('#tex_email').val();
	
	if($("#tex_password").val()!=$("#tex_password_confirm").val())
	{
		alert("Confirm password incorrect");
		$("#tex_password_confirm").focus();
		return false;
	}
	if( email == "" )
	{
		alert ( "Email can not be null" );
		$('#tex_email').focus();
		return false;
	}
	if ( !email.match(re) )
	{
		alert ("Email invalid");
		$('#tex_email').focus();
		return false;
	} 	
	if( ( $("#year").val()=="" ) || ( $('#month').val()== "" )|| ( $('#date').val() == "" ) )
	{
		alert ( "You must be choose birthday" );
		$('#year').focus();
		return false;
	}
	
	validateBirthday ( $('#month').val(), $('#date').val(), $('#year').val() ) ;	
	return true;
}

function validateBirthday( month, date, year){
	var arrayMatch = new Array();
	arrayMatch[1] = 31;
	arrayMatch[2] = 28;
	arrayMatch[3] = 31;
	arrayMatch[4] = 30;
	arrayMatch[5] = 31;
	arrayMatch[6] = 30;
	arrayMatch[7] = 31;
	arrayMatch[8] = 31;
	arrayMatch[9] = 30;
	arrayMatch[10] = 31;
	arrayMatch[11] = 30;
	arrayMatch[12] = 31;
	if( year % 4 == 0){		
		if(month == 2)
		{
			if( date > 29 ){
				alert("Date is invalid for month " + month);
				return false;
			}
		}else{
			if( date > arrayMatch[month]){
				alert("Date is invalid for month " + month );
				return false;
			}	
		}
	}else{
		if( date > arrayMatch[month]){
			alert("Date is invalid for month " + month);
			return false;
		}
	}
	return true;
	
}
</script>
{/literal}

<div style="height:30px; line-height:30px;">
	<span class="left-corner-bar"></span>
	<span class="center-corner-bar"><label class="colorblue classtab">{#edit_profile#}</label></span>
	<span class="right-corner-bar"></span>
</div>
<div class="clr"></div>

<div class="content-tab" style="border-top:1px solid #CCCCCC;margin-top:1px;">
	<div class="border-content" style="background:#F5F5F5; margin-top:1px; ">
		<!-- Noi dung thiet ke-->	
		<div style="padding:5px 0 10px 0 ; text-align:justify;">		
		
		
			<form action="" method="post" style="margin: 0px; padding: 0px;" onsubmit="return checkSubmit();">
				<table cellpadding="5" cellspacing="2" border="0" style="margin-left:30px;">
					{if $error!=""}
						<tr>
							<td>&nbsp;</td>
							<td  style="color: #FF0000; padding-left: 10px; padding-top: 10px;">{$error}</td>
						</tr>
					{/if}					
					<tr>
						<td><b>{#username#}:</b></td>
						<td><input type="text" style="width: 300px;" readonly="true" name="tex_username" value="{$user.username}"/></td>
					</tr>
					
					<tr>
						<td><b>{#password#} (*):</b></td>
						<td> <input type="password" style="width: 300px;" id="tex_password" name="tex_password" value=""/></td>
					</tr>
					
					<tr>
						<td><b>{#repassword#} (*):</b></td>
						<td><input type="password" style="width: 300px;" id="tex_password_confirm" name="tex_password_confirm" value=""/></td>
					</tr>
					
					<tr>
						<td><b>{#email#}(*):</b></td>
						<td><input type="text" style="width: 300px;" id="tex_email" name="tex_email" value="{$user.email}"/></td>
					</tr>
					
					<tr>
						<td><b>{#gender#}:</b></td>
						<td><select name="gender">
						<option value="1" {$selectedMale}>Male</option>
						<option value="0" {$selectedFemale}>Female</option>
					</select></td>
					</tr>
					
					<tr>
						<td><b>{#date_of_birth#}:</b></td>
						<td>
					<select name="date" id="date">
						<option value="">-- {#date#} --</option>
						{$comboDate}
					</select>
					<select name="month" id="month">
						<option value="">-- {#month#} --</option>
						{$comboMonth}
					</select>
					<select name="year" id="year">
						<option value="">-- {#year#} --</option>
						{$comboYear}
					</select></td>				
					</tr>
					
					<tr>
						<td><b>{#phone#}:</b></td>
						<td><input type="text" name="phone" style="width:300px;" id="phone" value="{$user.phone}" /></td>
					</tr>
					
					<tr>
						<td valign="top"><b>{#address#}:</b></td>
						<td><textarea name="address" rows="5" cols="40" style="overflow:auto;">{$user.address}</textarea></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" class="button" value="{#btn_submit#}" style="float:left; margin-right:5px; border:none;" />
						<input type="reset" class="button" name="bt_reset" value="{#reset#}" style="float:left; border:none;"/></td>
					</tr>
				
				</table>				
				<div class="clearboth"></div>
			</form>
		
	</div>
	<!-- Noi dung thiet ke-->
	</div>
</div>
<div class="clr"></div>	