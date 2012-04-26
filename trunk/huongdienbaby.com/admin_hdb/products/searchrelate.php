<? include ("config_security.php"); ?>
<? require_once("../../classes/database.php"); ?>
<? require_once("../../functions/functions.php");?>
<?
$keyword=getValue("keyword","str","GET","",1);
$db_room=new db_query("SELECT * FROM news,categories_multi
								WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . " AND cat_id=new_category AND new_title LIKE '%" . $keyword . "%'
								ORDER BY cat_order ASC,cat_id ASC,new_date DESC");
?>
<select id="list_relate" name="list_relate[]" class="form" multiple="multiple" size="10">
   <?
   $cha_id = 0;
   while($row = mysql_fetch_array($db_room->result)){
   ?>
      <?
      if($cha_id != $row["cat_id"]){
         $cha_id	= $row["cat_id"];
      ?>
      <optgroup label="<?=$row["cat_name"]?>"></optgroup>
      <?
      }
      ?>
      <option title="<?=$row["new_title"]?>" value="<?=$row["new_id"]?>" >&nbsp; |-- <?=$row["new_title"]?></option>
   <?
   }
   ?>
  </select>
<?
$db_room->close();
unset($db_room);
?>  
