<? include ("config_security.php"); ?>
<? require_once("../../classes/database.php"); ?>
<? require_once("../../functions/functions.php");?>
<?
$keyword=getValue("keyword","str","GET","",1);
$db_room=new db_query("SELECT * FROM categories_multi
								WHERE cat_name LIKE '%" . $keyword . "%'
								ORDER BY cat_order ASC,cat_id ASC,cat_name ASC");
?>
<select id="list_relate" name="list_relate[]" class="form" multiple="multiple" size="20">
   <?
   $cha_id = 0;
   while($row = mysql_fetch_array($db_room->result)){
   ?>
      <option title="<?=$row["cat_name"]?>" value="<?=$row["cat_id"]?>" >&nbsp; + <?=$row["cat_name"]?></option>
   <?
   }
   ?>
  </select>
<?
$db_room->close();
unset($db_room);
?>  
