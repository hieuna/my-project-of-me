<div class="box">
<?php 
 		$static_id = getValue("id","int","GET",0);
        $select_static = new db_query(" SELECT *
									 FROM statics_multi									 
									 WHERE  sta_id = " . $static_id);
        $rows = mysql_fetch_assoc($select_static->result);
?>
<div class="title-style2"><strong><?=$rows["sta_title"]?></strong></div>
    <div class="detail-table1 clearfix">
    		<?=$rows["sta_description"]?>
    </div>
</div>                    
                        