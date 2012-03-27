	<?php 
	$pro_idr = getValue("id","int","GET",0);
	$db_count_totalcm 		= new db_query ("SELECT Count(*) AS count
								FROM comment_nulti
								WHERE com_active = 1 AND pro_id = '$pro_idr'");
								
							
							$row_count_cm 		= mysql_fetch_array($db_count_totalcm->result);
							$total_record_cm 	= $row_count_cm['count'];
							$db_count_totalcm->close();
							unset($db_count_totalcm);
			if($total_record_cm!=0){				
	$select_rightcm = new db_query("SELECT * FROM comment_nulti 
													WHERE  com_active = 1 AND pro_id = '$pro_idr' 
													LIMIT 1");					
						$rows_rightcm = mysql_fetch_assoc($select_rightcm->result);
							$user_id_rcm = $rows_rightcm["user_id"];
							//get user name
							$select_user_id_rcm = new db_query("SELECT * FROM users 
													WHERE  id = ".$user_id_rcm."");
							$rows_user_id_rcm = mysql_fetch_assoc($select_user_id_rcm->result);
							////////
							$select_rightcm->close();
							unset($select_rightcm);
							$select_user_id_rcm->close();
							unset($select_user_id_rcm);
	?>		
            <div class="box2 box-view-comment">
					<div class="title2">
					<h3>Bình luận mới nhất</h3>
					</div>
					<div class="box-cont clearfix">
						<div class="style-col clearfix">
                        		<?php if($user_id_rcm == 456){?>
                            	<img src="../images/avar1.png" width="60" height="60" alt="pic" class="img123" />                        		
                                <?php } else{?>
                                <img src="../images/avar.png" width="60" height="60" alt="pic" class="img123" />
                                <?php }?>
                                
						<h4><a href="#"><strong><?=$rows_user_id_rcm["username"]?></strong></a></h4>
						<p><?php echo cut_string($rows_rightcm["com_text"],100);?></p>
						</div>
						<div class="view-comment">
							<a href="<?php if($city == 1){echo '../deals/ha-noi-binh-luan-san-pham-'.$pro_idr.'.html?#comment_show';}else if($city == 2){echo '../deals/ho-chi-minh-binh-luan-san-pham-'.$pro_idr.'.html?#comment_show';}?>"><b>Xem tất cả <?=$total_record_cm?> bình luận</b></a>
						</div>
					</div>
				</div>
                <?php } else{?>
				 <div class="box2 box-view-comment">
					<div class="title2">
					<h3>Bình luận mới nhất</h3>
					</div>
					<div class="box-cont clearfix">
						<div class="style-col clearfix">
                           	<img src="../images/avar1.png" width="60" height="60" alt="pic" class="img123" />                        	
						<h4><a href="#"><strong>mienphigiaohang.vn</strong></a></h4>
						<p><a href="<?php if($city == 1){echo '../deals/ha-noi-binh-luan-san-pham-'.$pro_idr.'.html?#comment_show';}else if($city == 2){echo '../deals/ho-chi-minh-binh-luan-san-pham-'.$pro_idr.'.html?#comment_show';}?>"><b>Cùng thảo luận về sản phẩm này</b></a></p>
						</div>
						<div class="view-comment">
							<a href="<?php if($city == 1){echo '../deals/ha-noi-binh-luan-san-pham-'.$pro_idr.'.html?#comment_show';}else if($city == 2){echo '../deals/ho-chi-minh-binh-luan-san-pham-'.$pro_idr.'.html?#comment_show';}?>"><b>Xem tất cả 0 bình luận</b></a>
						</div>
					</div>
				</div>
                <?php }?>