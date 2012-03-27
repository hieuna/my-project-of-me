<?
//get config from database
$query_ = 'SELECT * from configuration WHERE con_lang_id= ' . $lang_id;
$db_con = new db_query($query_);
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
?>