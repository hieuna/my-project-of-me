<?
require_once("../classes/generate_form.php");

	$faq_name		= getValue("faq_name", "str", "POST", "");
	$faq_question	= getValue("faq_question", "str", "POST", "");
	$faq_email		= getValue("faq_email", "str", "POST", "");
	$phone			= getValue("phone", "str", "POST", "");
	$fax				= getValue("fax", "str", "POST", "");
	$faq_question	= getValue("faq_question", "str", "POST", "");
	$scode			= getValue("scode", "str", "POST", "");
	$cscode			= getValue("cscode","str","POST","");
	$action 			= getValue("action", "str", "POST", "");
	$ErrorCode		= "";
	$errorMsg		=	'';
	$faq_date		= time();
	$myform = new generate_form();
	$myform->add("faq_name","faq_name",0,0," ",1,translate_display_text("Please_insert_your_name"),0,"");
	$myform->add("faq_email","faq_email",2,0," ",1,translate_display_text("Please_insert_your_email"),0,"");
	$myform->add("faq_question","faq_question",0,0," ",1,translate_display_text("Please_insert_your_email"),0,"");
	//$myform->add("faq_date","faq_date",1,2,0,0,"",0,"");
	$_SESSION["lang_id"]=$lang_id;
	$myform->addTable("faqs");
	if($action == "contact"){
		if(!isset($_SESSION["session_security_code"])) redirectHTML("index.php");
		if($scode == $_SESSION["session_security_code"]){
			$errorMsg = $myform->checkdata();
			if($errorMsg == ""){
				$db_ex = new db_execute($myform->generate_insert_SQL());
				echo "<script language='javascript'>alert('" . translate_display_text("sent_question_successful") . "')</script>";
				redirectHTML("faq.php");
			}
		}else{
			$ErrorCode	= translate_display_text("Ma_an_toan_khong_chinh_xac");
		}
	}
	$myform->addFormname("contact");
	$myform->checkjavascript();
?>
<div class="t_top"><div><?=translate_display_text("gui_cau_hoi")?></div></div>
<div class="t_center" style="padding:7px;">
<div class="textBold"><?=$errorMsg?></div>
<table align="center" cellpadding="4" cellspacing="2" border="0">
<form action="<?=$_SERVER['REQUEST_URI']?>" method="post" name="contact">
    <tr>
        <td colspan="2" class="textBold"><font color='#FF0000'>*</font>&nbsp;<?=translate_display_text("Fields_marked_with_asterisk_star_are_required")?></td>
    </tr>
    <tr>
        <td class="textBold" align="right" height="24" nowrap>
            <font color='#FF0000'>*</font>&nbsp;<?=translate_display_text("full_name")?>:&nbsp;
        </td>
        <td  align="left"><input type="text" name="faq_name" id="faq_name" size="35" class="form" value="<?=$faq_name?>"></td>
    </tr>
    <tr>
        <td class="textBold" align="right" height="24" nowrap>
            <font color='#FF0000'>*</font>&nbsp;<?=translate_display_text("Email")?>:&nbsp;
        </td>
        <td  align="left"><input type="text" name="faq_email" id="faq_email" size="40" class="form" value="<?=$faq_email?>"></td>
    </tr>
    <tr>
        <td class="textBold" align="right" height="24" nowrap><?=translate_display_text("question")?>:&nbsp;</td>
        <td  align="left"><textarea name="faq_question" id="faq_question" class="form" cols="60" rows="12"><?=$faq_question?></textarea></td>
    </tr>
    <tr>
        <td class="textBold" align="right" height="24" nowrap><?=translate_display_text("code")?>:&nbsp;</td>
        <td  align="left"><? $_SESSION["session_security_code"] = rand(1000,9999);?><div style="float:left"><input type="text" name="scode" id="scode" size="5" maxlength="5" value="" class="form" />&nbsp;&nbsp;</div><div style="float:left"><img src="<?=$lang_path?>security_code.php"  class="form"/></div><?=$ErrorCode;?></i></font></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="button" class="button" value="&nbsp;&nbsp;<?=translate_display_text("sent")?>&nbsp;&nbsp;"  onclick="validateForm();" />
            &nbsp;
            <input class="button" type="reset" value="&nbsp;&nbsp;<?=translate_display_text("reset")?>&nbsp;&nbsp;" />
            <input type="hidden" name="action" id="action" value="contact" /><input type="hidden" name="cscode" id="cscode" value="<?=$newcode;?>" />
        </td>
    </tr>
</form>
</table>
 </div>
<div class="t_bottom"><div>&nbsp;</div></div>
