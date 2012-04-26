<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");

$redirect_succ	= "listing.php";

$Action = getValue("Action","str","POST","");
if ($Action == "insert")
{
	$myform = new generate_form();
	$myform->addTable($fs_table);
	$myform->add("pol_name","pol_name",0,0,"",0,"",0,"");
	$myform->add("admin_id","admin_id",1,1,0,0,"",0,"");
	
	$db_ex = new db_execute_return();
	$last_id = $db_ex->db_execute($myform->generate_insert_SQL());
	$list_answers = getValue("aws_name","arr","POST","");
	
	if($last_id != 0){
		for ($i=0;$i<count($list_answers);$i++){
			//$table="polls";
			$aws_order = $i;
			$aws_name = $list_answers[$i];
			if ($aws_name != ""){
				$myform = new generate_form();
				$myform->addTable($fs_table);
				$myform->add("pol_name","aws_name",0,1,"",0,"",0,"");
				$myform->add("admin_id","admin_id",1,1,0,0,"",0,"");
				$myform->add("pol_parent_id","last_id",1,1,1,0,"",0,"");
				$db_ex = new db_execute($myform->generate_insert_SQL());
				unset($myform);
			}
		}
	}
	redirect($redirect_succ);
	exit();
}
?>
<script language="javascript">
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } 
  var blank=1;
  for (i=0;i<10;i++){
  	if (eval("document.all.aws_name" + i + ".value") !=""){
		blank=0;
	}
  }
  if (blank==1){
	errors+='- please insert at lease one answers\n';
  }
  
  if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
</script>
<html>
<head>
<title>Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("them_moi_tham_do"))?>
		<? /*---------Body------------*/ ?>
		<table border="0" cellpadding="3" cellspacing="2" width="100%">
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'];?>" METHOD="POST" name="add_pol_product" enctype="multipart/form-data">
			<tr>
				<td align="right" nowrap="nowrap" class="textBold">Câu hỏi :</td>
				<td><input type="text" name="pol_name" size="80" class="form">
				</td>
			</tr>	
			<? for ($i=0;$i<10;$i++){ ?>
			<tr>
				<td align="right">Trả lời 
			   <?=$i;?> :</td>
				<td><input type="text" id="aws_name<?=$i;?>" name="aws_name[]" size="50" class="form"></td>
			</tr>
			<? } ?>									
			<tr> 
				<td align="right" nowrap class="textBold">&nbsp;</td>
				<td><input type="submit" class="form" onClick="MM_validateForm('pol_name','','R');return document.MM_returnValue" value="Thêm mới"></td>
			</tr>
			<input type="hidden" name="Action" value="insert">
		</form>
		</table>	
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>