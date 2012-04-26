<?
require_once("../classes/database.php");
require_once("../functions/functions.php");
require_once("../functions/function_mailer.php");
	//Random text
	$newcode_length = "";
	$newcode		= "";
	$codelenght		= 5;
	while($newcode_length < $codelenght) {
		$x=1;
		$y=3;
		$part = rand($x,$y);
		if($part==1){$a=48;$b=57;}  // Numbers
		if($part==2){$a=65;$b=90;}  // UpperCase
		if($part==3){$a=97;$b=122;} // LowerCase
		$code_part=chr(rand($a,$b));
		$newcode_length = $newcode_length + 1;
		$newcode 		= $newcode.$code_part;
	}
	//echo $newcode . "<br>";
	$ErrorCode	= "";
	//Process
	//Get Value
	$name			= getValue("name", "str", "POST", "");
	$address		= getValue("address", "str", "POST", "");
	$email			= getValue("email", "str", "POST", "");
	$phone			= getValue("phone", "str", "POST", "");
	$fax			= getValue("fax", "str", "POST", "");
	$content		= getValue("content", "str", "POST", "");
	$scode			= getValue("scode", "str", "POST", "");
	$cscode			= getValue("cscode","str","POST","");
	$action 		= getValue("action", "str", "POST", "");
	if($action == "contact"){
		if(!isset($_SESSION["session_security_code"])) redirect($lang_path . "index.php",1);
		if($scode == $_SESSION["session_security_code"]){
			$message = "Thong tin lien he tu ban: " . $email . "\n";
			$message.= "<---------------------------->";
			$message.= "Họ và tên :" . $name . "\n";
			$message.= "E-mail: " . $email . "\n";
			$message.= "số điện thoại : " . $phone . "\n";
			$message.= "Nội dung liên hệ : \n" . $content . "";
			
			$to      = $con_admin_email;
			$subject = "hello " . $name . " contact to wwww."  . $_SERVER['SERVER_NAME'];	
			$headers = 'From: admin@' . str_replace("www.","",$_SERVER['SERVER_NAME']);
			mail($to, $subject, $message, $headers);
			$_SESSION["session_security_code"] = rand(1000,9999);
			//return true;
			echo "<script language='javascript'>alert('" . translate_display_text("contact_connection_successful") . "')</script>";
			redirect("index.php");
			exit();
		}
		else{
			$ErrorCode = translate_display_text("Ma_an_toan_khong_chinh_xac");
		}
	}
?>
<?
$db_contact = new db_query("SELECT sta_description, sta_title
						    FROM statics
						    WHERE sta_id = " . $con_static_contact );
$row = mysql_fetch_array($db_contact->result);	
$db_contact->close();
unset($db_contact);
?>
<div class="t_top"><div id="detail"><?=translate_display_text("thong_tin_lien_he")?></div></div>
	<div class="t_center">
		<table cellpadding="5" cellspacing="0" align="center" width="100%">
			<tr>
				<td valign="top">
					<form action="<?=getURLR($con_mod_rewrite)?>" method="post" name="contact"  id="myform" class="formsentmail">
						<div class="textBold" style="margin-top:10px; margin-bottom:10px;"><font color='#FF0000'>*</font>&nbsp;<?=translate_display_text("Fields_marked_with_asterisk_star_are_required")?></div>
						<p>
						<label for="user"><font color='#FF0000'>*</font>&nbsp;<?=translate_display_text("full_name")?>:&nbsp;</label>
						<input type="text" name="name" id="name_contact" size="35" class="form" value="<?=$name?>">
						</p>
						<p>
						<label for="user"><font color='#FF0000'>*</font>&nbsp;<?=translate_display_text("Email")?>:&nbsp;</label>
						<input type="text" name="email" id="email_contact" size="40" class="form" value="<?=$email?>">
						</p>
						<p>
						<label for="user"><font color='#FF0000'>*</font>&nbsp;<?=translate_display_text("phone")?>:&nbsp;</label>
						<input type="text" name="phone" id="phone_contact" size="30" class="form" value="<?=$phone?>">
						</p>
						<p>
						<label for="user"><font color='#FF0000'>*</font>&nbsp;<?=translate_display_text("content")?>:&nbsp;</label>
						<textarea name="content" id="content_contact" class="form" cols="60" rows="12"><?=$content?></textarea>
						</p>
						<p>
						<label for="user"><?=translate_display_text("code")?>:&nbsp;</label>
						<? $_SESSION["session_security_code"] = rand(1000,9999);?><input type="text" name="scode" id="scode" size="5" maxlength="5" value="" class="form" />&nbsp;&nbsp;<img src="<?=$lang_path?>security_code.php" align="absmiddle"  class="form"/><?=$ErrorCode;?></i></font>
						</p>
						<p>
						<label for="user">&nbsp;</label>
									<input type="button" class="buttom" value="&nbsp;&nbsp;<?=translate_display_text("sent")?>&nbsp;&nbsp;" onclick="check_contact()" />
									&nbsp;
									<input class="buttom" type="reset" value="&nbsp;&nbsp;<?=translate_display_text("reset")?>&nbsp;&nbsp;" />
									<input type="hidden" name="action" id="action" value="contact" /><input type="hidden" name="cscode" id="cscode" value="<?=$newcode;?>" />
						 </p>
					</form>
				</td>
				<td valign="top">
					<div class="description">
						<?=$row["sta_description"]?>
					</div>
				</td>
			</tr>
		</table>
 	</div>
<div class="t_bottom"><div>&nbsp;</div></div>
<script language="javascript">
function check_contact(){
	//frm = contact;
	if(document.getElementById("name_contact").value == ""){
		alert("<?=translate_display_text("please_enter_your_full_name")?>");
		document.getElementById("name_contact").focus();
		return;
	}
	if(document.getElementById("phone_contact").value == ""){
		alert("<?=translate_display_text("please_enter_your_phone")?>");
		document.getElementById("phone_contact").focus();
		return;
	}
	if(document.getElementById("email_contact").value == ""){
		alert("<?=translate_display_text("Email_not_exist")?>");
		document.getElementById("email_contact").focus();
		return;
	}
	if(document.getElementById("email_contact").value.length > 0){
		if(!isemail(document.getElementById("email_contact").value)){
			alert("<?=translate_display_text("your_email_not_math")?>");
			document.getElementById("email_contact").focus();
			return;
		}
	}
	if(document.getElementById("content_contact").value == ""){
		alert("Nhập nội dung liên hệ");
		document.getElementById("content_contact").focus();
		return;
	}
	document.contact.submit();
}
function isemail(email) {
	var re = /^(\w|[^_]\.[^_]|[\-])+(([^_])(\@){1}([^_]))(([a-z]|[\d]|[_]|[\-])+|([^_]\.[^_])*)+\.[a-z]{2,3}$/i
	return re.test(email);
}
</script>
