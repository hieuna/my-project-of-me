<? require_once("../classes/database.php");?>
<? require_once("../functions/functions.php");?>
<?
//get config from database
$db_con = new db_query("SELECT * from configuration WHERE con_lang_id=" . $lang_id);
if ($row=mysql_fetch_array($db_con->result)){
	while (list($data_field, $data_value) = each($row)) {
		if (!is_int($data_field)){
			//tao ra cac bien config
			$$data_field = $data_value;
			//echo $data_field . "= $data_value <br>";
		}
	}
}
$db_con->close();
unset($db_con);
$con_site_title				=	str_replace("\n","",htmlspecialchars($con_site_title));
$con_meta_keywords			=	str_replace("\n","",htmlspecialchars($con_meta_keywords));
$con_meta_description		=	str_replace("\n","",htmlspecialchars($con_meta_description));

if(getValue("finalstyle","int","SESSION",0)!=1){
	$db_counter	= new db_execute("UPDATE visited SET vi_count = vi_count + 1");
	unset($db_counter);
	$_SESSION["finalstyle"]=1;
}

?>