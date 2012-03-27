<!--CHỌN VÙNG-->

    <div id="overlay-popup" style="background-color: rgb(0, 0, 0); opacity: 0.7;filter:Alpha(opacity=50); position: absolute; top: 0px; left: 0px; z-index: 332; width: 100%; height: 3000px;"> </div>
     <!--END CHỌN VÙNG-->
      <!--CHỌN TP-->
	  
		<div align="center" id="popcityemail" class="show-hide" style="background-color: transparent; position: absolute; padding: 0px; opacity: 1; z-index: 333; width: 500px; top: 92px; left: 350px;">
		<div style="background-color: transparent">
        <div id="popup-container" style="padding: 0px; color: black; font-size: 14px; width:650px; height:400px; display: block; background:url(../images/loca_img.jpg) center no-repeat" align="center"; >
        <div style="padding:15px;">       
        <div align="center">
						
                        <form name="selectTPhcm" id="selectTPhcm" method="post">                       
                        
                        <input  type="submit" name="hanoi"  value=""  style="background:url(../images/hanoi.png) no-repeat center; width:173px; height:41px; border:0; margin:178px 97px 0 0"/>
                        <input  type="submit" name="hochiminh"  value=""  style="background:url(../images/hcm.png) no-repeat center;width:173px; height:41px; border:0; margin:163px -25px 0 58px"/>
                      </form>
                    
                 <?php 
				  if(isset($_POST['hanoi']))
				  { 		  
					$_SESSION["city"] = 1; 
					//die($_SESSION["city"]);
					$city = $_SESSION["city"];					
					  chuyen_trang("../deals/ha-noi");
				  }
				  if(isset($_POST['hochiminh']))
				  { 		  
					$_SESSION["city"] = 2; 
					//die($_SESSION["city"]);
					$city = $_SESSION["city"];					
					  chuyen_trang("../deals/ho-chi-minh");
				  }
				 ?> 
                 </div>
        </div>
            </div>       
        </div>
	</div>
     <!--END CHỌN TP-->