
<div class="main clearfix">
			<h1 id="logo"><a href="../"> 
			<span></span></a></h1>
			<div class="select-city">            	
				<div class="name-city">Chọn thành phố:</div>
				<ul class="city">
                		<?php 
							 $query_select_city = "SELECT loca_title FROM location_multi WHERE loca_ord = ".$city."";
                             $select_city = new db_query($query_select_city);
							 $rows_city = mysql_fetch_assoc($select_city->result); 
						?>
					<li onmouseover="showcity()" onmouseout="hidecity()"><a href="#"><strong class="s1">[ </strong><strong class="name"> <?=$rows_city["loca_title"]?> </strong><strong class="s2">]</strong></a>
						<ul class="sub" id="city_select" style="display:none">
                        <?php 
					$select_loca = new db_query("SELECT * FROM location_multi");
					//$cou_id = $rows["cou_id"];
					while($rows_loca = mysql_fetch_assoc($select_loca->result)){
						?>
							<li><a href="../deals/<?php if($rows_loca["loca_ord"] == 1){echo 'ha-noi';} else if($rows_loca["loca_ord"] == 2){echo 'ho-chi-minh';}?>"><?=$rows_loca["loca_title"]?></a></li>
						<?php }
						 unset($select_loca);
						// $_SESSION["city"] = $rows_loca["loca_ord"];
						?>
						</ul>
					</li>
					
				</ul>
                <script type="text/javascript">
					function showcity(){
						$("#city_select").show();
					}
					function hidecity(){
						$("#city_select").hide();										
					}					
				</script>				
			</div>
			<div class="search">
           
				<!--<div class="top-search">Nhận thông báo Sản phẩm hấp dẫn mỗi ngày</div>-->
				<div class="bottom-search clearfix">
                <form  method="GET" action="../deals/regis_email.php" target="popupWin" onsubmit="return openWindow('deals/regis_email.php', 'popupWin', 600, 400);" id="ttdangky" name="ttdangky">
					<input type="text" name="email" id="email"   class="txt-search" value="Nhập địa chỉ Email của bạn" onblur="if(this.value=='') this.value='Nhập địa chỉ Email của bạn'" onfocus="if(this.value=='Nhập địa chỉ Email của bạn') this.value=''" />
					<input type="submit" value="" class="btn-search"  onclick="return Kiemtradauvao(); return false;"/>
                </form>
                 <script type="text/javascript">
					function Kiemtradauvao()
						{
								
							if((document.ttdangky.email.value.indexOf('@') < 0 ) || ((document.ttdangky.email.value.charAt(document.ttdangky.email.value.length-4)!=".")&&(document.ttdangky.email.value.charAt(document.ttdangky.email.value.length-3)!=".")))
							{
								alert ("Email bạn nhập không đúng cú pháp. Email phải có cú pháp: xxx@yyy.zzz");
								return false;
							}			
							return true;
						}
						function openWindow(url, wname, width, height) {
							var left   = (screen.width  - width)/2;
							var top    = (screen.height - height)/2;
							
							window.open(url, wname, "height=" + height + ",width=" + width + ", top="+top+", left="+left+",location = no, status = no, resizable = 0, scrollbars=no, toolbar = 0");
							return true;
						}
			</script>
				</div>
			</div>
			<div class="header-r clearfix">
			<a href="#"><img src="../images/top_bannner.png" width="350" height="105" alt="chưa có ảnh" /></a></div>
			<!-- End main-->
			
			<!--Google+-->
			<!--
			<div id="google" style="float:right;">
				<g:plusone size="medium"></g:plusone>
				<script type="text/javascript">
				  (function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
			</div>
			-->

		</div>
		<!-- End main-->
		