<div class="Tabs clearfix">
  <ul class="clearfix">                                                       
      <li><a <?php if($cat_id == "") echo 'class="active"';?> href="../deals/san-pham-<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>"><span>Tất cả</span></a></li>
 <?php 	
  $select_type_tab = new db_query("SELECT cat_id,cat_type,cat_name
                              FROM categories_multi
                              WHERE cat_type='product' AND cat_parent_id = 0 AND cat_active=1
						      ORDER BY cat_order ASC");					
  while($rows_type_tab = mysql_fetch_assoc($select_type_tab->result)){
?>      
      <li><a <?php if($cat_id == $rows_type_tab["cat_id"]) echo 'class="active"';?> href="../deals/<?=$rows_type_tab["cat_id"]?>-<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>.html"><span><?=$rows_type_tab["cat_name"]?></span></a></li>     
 <?php  }	
	unset($select_type_tab);
	//echo $i;
?>      
  </ul>              
</div>