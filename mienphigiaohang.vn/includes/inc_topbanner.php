<div class="slide-top">
      <div id="banner-slider" class="asset-cont">
            <div id="slidetop"> 
       			<div class="wrap-slidetop">
                    <div id="slide-holder">
                        <div id="slide-runner"> 
                               <?php 
							   $i=0;
							$select_slidetop = new db_query("SELECT * FROM banners_multi 
													WHERE ban_location = 1 AND ban_active = 1 
													ORDER BY ban_id DESC
													LIMIT 3");					
							while($rows_slidetop = mysql_fetch_assoc($select_slidetop->result)){
								$i++;	?>                
                            
                            <a href="<?=$rows_slidetop["ban_link"]?>" target="_blank"><img id="slide-img-<?=$i?>" src="../pictures/banners/<?=$rows_slidetop["ban_picture"]?>" class="slide" alt="" /></a>                           
                             <?php  }	
								unset($select_slidetop);
								//echo $i;
							?>
                            <div class="number-style" id="number-style">                         
                                <p id="slide-nav"></p>
                            </div>
                        </div>
                        
                        <!--content featured gallery here -->
                     </div>
						   <script type="text/javascript">
                            if(!window.slider)														 
                            var slider={};
                            slider.data=[{"id":"slide-img-1","client":"","desc":""},{"id":"slide-img-2","client":"","desc":""},{"id":"slide-img-3","client":"","desc":""}];
                           </script>
                 </div>
			</div> 
                               
      </div>
</div>