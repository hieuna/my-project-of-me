<div style="height:30px; line-height:30px;">
	<span class="left-corner-bar"></span>
	<span class="center-corner-bar"><label class="colorblue classtab">{#LOGIN#}</label></span>
	<span class="right-corner-bar"></span>
</div>
<div class="clr"></div>

<div class="content-tab" style="border-top:1px solid #CCCCCC;margin-top:1px;">
	<div class="border-content" style="background:#F5F5F5; margin-top:1px; ">
		<!-- Noi dung thiet ke-->	
		<div style="padding:5px 0 10px 0 ; text-align:justify;">		
			<form  name="frm_login" action="{$url}" method="post" style="padding:0; margin:0;">
				<table cellpadding="5" cellspacing="2" border="0" style="margin-left:100px;">
					{if $error!=""}
					<tr>
						<td>&nbsp;</td>
						<td  style="color: #FF0000;padding-top: 10px;">{$error}</td>
					</tr>
					{/if}	
					<tr>
						<td><b>{#username#}:</b></td>
						<td><input type="text" name="tex_username" value="" style="width:200px;"/></td>
					</tr>
					
					<tr>
						<td><b>{#password#} (*):</b></td>
						<td><input type="password" name="tex_password" value="" style="width:200px;"/></td>
					</tr>
					
					<tr>
						<td></td>
						<td><input type="submit" class="button" value="{#LOGIN#}" style="border:none;" /></td>
					</tr>
				</table>			
			</form>			
		
		</div>
	<!-- Noi dung thiet ke-->
	</div>
</div>
<div class="clr"></div>	