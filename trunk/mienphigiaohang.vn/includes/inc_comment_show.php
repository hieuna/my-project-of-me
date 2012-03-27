<div class="box-comment clearfix" id="comment_show">
				
				<div class="comment clearfix">
				<div class="title-comment">
					<strong class="clorange">Bình luận</strong>
					</div>
                   <? include("inc_submit_post_comment.php");?> 
                    <form name="post_comment" method="post">
					<div class="txt-comment">
						<textarea name="box_comment_txt"  onblur="if(this.value=='') this.value='Viết bình luận cho sản phẩm này'" onfocus="if(this.value=='Viết bình luận cho sản phẩm này') this.value=''">Viết bình luận cho sản phẩm này</textarea>
					</div>
					<div class="btn-comments">
                    	<input type="hidden" name="commit_coment" value="commit_coment"	 />	
                        <?php if(isset($_SESSION['loged'])){ ?>			
                        <input type="submit" class="btn-comment" value="" style="border:0">
                        <?php } else {?>
                         <input type="button"  class="btn-comment" value="" style="border:0" onclick="alert('Bạn phải đăng nhập để sử dụng tính năng này.');"  />
										<?php }?>
					</div>
					</form>
				</div>
				<ul class="list-sent">						
                        <?php 
						
						$i =0;						
						$select_listcomment = new db_query("SELECT * FROM comment_nulti 
													WHERE  com_active = 1 AND pro_id = '$pro_id' 
													AND com_parent_id = 0
													ORDER BY comment_id DESC ");					
						while($rows_listcomment = mysql_fetch_assoc($select_listcomment->result)){
							$i++;
							$comment_id = $rows_listcomment["comment_id"];
							$user_id_co = $rows_listcomment["user_id"];
							//get user name
							$select_user_id_co = new db_query("SELECT * FROM users 
													WHERE  id = ".$user_id_co."");
							$rows_user_id_co = mysql_fetch_assoc($select_user_id_co->result);
							//count comment
							$db_count_cm 		= new db_query ("SELECT Count(*) AS count
								FROM comment_nulti
								WHERE com_active = 1 AND com_parent_id = '$comment_id'");
								
							
							$row_count 		= mysql_fetch_array($db_count_cm->result);
							$total_record 	= $row_count['count'];
							$db_count_cm->close();
							unset($db_count_cm);
							
						?>
						<li class="clearfix" id="comm_<?=$comment_id?>">
                        	<span class="img1">
                            <?php if($user_id_co == 456){?>
                            	<img src="../images/avar1.png" alt="pic" />                        		
                                <?php } else{?>
                                <img src="../images/avar.png" alt="pic" />
                                <?php }?>
                            </span>
							<div class="r-sent"><div class="icon-sent"></div>
								<div class="cont-comment"><p><?=$rows_listcomment["com_text"]?></p></div>
								<div class="tool-comment clearfix">
									<div class="fl"><a href="#"><strong class="clorange"><?=$rows_user_id_co["username"]?></strong></a>   -   <?=date("d/m/Y - h:m:s A",$rows_listcomment["com_date"])?></div>
									<div class="fr" ><a id="show_subcom_<?=$i?>" style="cursor:pointer">Có <?=$total_record?> lời bình</a></div>
								</div>
							</div>
						</li>
                        <!--sub comment-->
							<ul class="list-sent" id="sub_comment_content_<?=$i?>" style="display:none">
								<li class="clearfix">
                                    <?php
									//comment - sub
									//sleep(3);
									$select_listcomment_sub = new db_query("SELECT * FROM comment_nulti 
													WHERE  com_active = 1 AND pro_id = '$pro_id' 
													AND com_parent_id = '$comment_id'
													ORDER BY comment_id ASC ");					
									while($rows_listcomment_sub = mysql_fetch_assoc($select_listcomment_sub->result)){										
										$comment_id_sub = $rows_listcomment_sub["comment_id"];
										$user_id_co_sub = $rows_listcomment_sub["user_id"];
										//get user name
										$select_user_id_co_sub = new db_query("SELECT * FROM users 
																WHERE  id = ".$user_id_co_sub."");
										$rows_user_id_co_sub = mysql_fetch_assoc($select_user_id_co_sub->result);
										
									?>
                                	<span class="img1">
                                   <?php if($user_id_co_sub == 456){?>
                                        <img src="../images/avar1.png" alt="pic" />                        		
                                        <?php } else{?>
                                        <img src="../images/avar.png" alt="pic" />
                                <?php }?>
                                    </span>
									<div class="r-sent"><div class="icon-sent"></div>
										<div class="cont-comment"><p><?=$rows_listcomment_sub["com_text"]?></p></div>
										<div class="tool-comment clearfix">
											<div class="fl"><a href="#"><strong class="clorange"><?=$rows_user_id_co_sub["username"]?> </strong></a>   -   <?=date("d/m/Y - h:m:s A",$rows_listcomment_sub["com_date"])?></div>
										</div>
									</div>
                                    <?php }?>
                                    
									<div class="comment clearfix">
                                    <form name="post_comment_<?=$comment_id?>" method="post">
									<div class="txt-comment1">
										<textarea name="box_comment_txt_<?=$comment_id?>"  onblur="if(this.value=='') this.value='Viết bình luận cho sản phẩm này'" onfocus="if(this.value=='Viết bình luận cho sản phẩm này') this.value=''">Viết bình luận cho sản phẩm này</textarea>
									</div>
									<div class="btn-comments">
                                    <input type="hidden" name="commit_coment_<?=$comment_id?>" value="commit_coment_<?=$comment_id?>"	 />				
                        			<?php if(isset($_SESSION['loged'])){ ?>
									
									<input type="submit"  class="btn-comment1" value="" style="border:0"  />
									<?php } else {?>
                                    <input type="button"  class="btn-comment1" value="" style="border:0" onclick="alert('Bạn phải đăng nhập để sử dụng tính năng này.');"  />
										<?php }?>
									</div>
									</form>
                                    <?php									
									if(isset($_POST['commit_coment_'.$comment_id.'']))
										{ 
										if(isset($_SESSION['loged'])){ 
											$text_comment =	$_POST["box_comment_txt_".$comment_id.""];
											  if($text_comment == " " || $text_comment =="Viết bình luận cho sản phẩm này")
											  {
												  echo "<script type='text/javascript'>alert('Hãy nhập nội dung comment.');</script>";												 
								if($city == 1){
									chuyen_trang("../deals/ha-noi-binh-luan-san-pham-".$pro_id.".html#comm_".$comment_id."");
									} 
								else if($city == 2){
									chuyen_trang("../deals/ho-chi-minh-binh-luan-san-pham-".$pro_id.".html#comm_".$comment_id."");
									}
				
												  }
											  else{
											$datepsub = time();
											$user_id_sub = $_SESSION['ses_userid'];
											
											$db_insert_sub	       = new db_execute_return();
											$last_id_sub		   = $db_insert_sub->db_execute("
																						INSERT INTO `comment_nulti` 
																						(
																							`pro_id` ,
																							`user_id` ,
																							`com_text` ,
																							`com_date` ,
																							`com_parent_id` ,																																				
																							`com_active`
																						)
																						VALUES
																						(
																							'$pro_id' , 
																							'$user_id_sub', 
																							'$text_comment',														
																							'$datepsub', 														 																							'$comment_id',
																							'1'
																						);
																					  "); 
											unset($db_insert_sub);
																	
																		if($city == 1){
									chuyen_trang("../deals/ha-noi-binh-luan-san-pham-".$pro_id.".html");
									} 
								else if($city == 2){
									chuyen_trang("../deals/ho-chi-minh-binh-luan-san-pham-".$pro_id.".html");
									}

										} 
										
										}
										else{
										chuyen_trang("../deals/dang-nhap");
										}
									}
									?>
								</div>
								</li>
							</ul>
                            <!--end sub-->
                            <script>
                            $(document).ready(function() {
								   $('#show_subcom_<?=$i?>').click(function(){
									 $('#sub_comment_content_<?=$i?>').show();
								   });								   
						   		});
                            </script>
                        <?php }?>
					</ul>
				
				</div>
        		</div>
                