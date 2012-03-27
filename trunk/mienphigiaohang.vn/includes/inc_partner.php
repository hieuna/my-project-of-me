 <div class="boxbank">
                        <div id="tab-box">
                    <ul>
                        <li class="active"><a href="#">Hỗ trợ thanh toán </a></li>
                        <li class=""><a href="#">Đối tác viễn thông</a></li>
                    </ul>
                </div>
                <div style="display: block;" class="tab-content" id="logo-partner" align="center">
                    <div id="hotrothanhtoan" style="margin:10px;">
			<img src="../images/hotrothanhtoan.png" usemap="#map_thanhtoan" border="0" height="128" width="655">
			<map name="map_thanhtoan" id="map_thanhtoan">
			  <area shape="rect" coords="6,2,57,35" href="http://www.visa.com/globalgateway/gg_selectcountry_ng.jsp">
			  <area shape="rect" coords="65,1,131,34" href="http://www.mastercard.com/index.html">
			  <area shape="rect" coords="140,1,219,37" href="http://www.vietcombank.com.vn/">
			  <area shape="rect" coords="227,1,305,37" href="https://www.techcombank.com.vn/">
			  <area shape="rect" coords="310,0,378,34" href="http://www.eab.com.vn/">
			  <area shape="rect" coords="385,1,486,35" href="http://www.vietinbank.vn/web/home/vn/index.html">
			  <area shape="rect" coords="493,1,560,36" href="http://www.vib.com.vn/default.aspx">
			  <area shape="rect" coords="569,2,663,36" href="http://www.shb.com.vn/">
			  <area shape="rect" coords="204,50,289,80" href="http://www.bidv.com.vn/">
			  <area shape="rect" coords="294,52,401,80" href="http://agribank.com.vn/">
			  <area shape="rect" coords="9,52,59,83" href="http://www.acb.com.vn/">
			  <area shape="rect" coords="64,49,197,79" href="http://www.sacombank.com.vn/vn/Pages/default.aspx">
			  <area shape="rect" coords="402,52,464,80" href="http://mbbank.com.vn/">
			  <area shape="rect" coords="471,52,546,80" href="http://www.vpb.com.vn/">
			  <area shape="rect" coords="554,50,660,81" href="http://www.seabank.com.vn/">
			  <area shape="rect" coords="3,96,78,127" href="http://www.tpb.com.vn/vn/">
			  <area shape="rect" coords="80,98,172,127" href="http://www.msb.com.vn/">
			  <area shape="rect" coords="176,93,278,127" href="http://www.pgbank.com.vn/pages/pghome.aspx">
			  <area shape="rect" coords="282,97,372,127" href="http://mb.softbank.jp/en/">
			  <area shape="rect" coords="378,99,517,125" href="https://ebank.vtc.vn/">
			  
			</map>			
		</div>
                    <div class="clear"></div>
                </div>
                <div class="tab-content" id="logo-partner" style="display: none;">
                <div align="left" style="padding:0; height:100px">
                    <table border="0" cellpadding="0" cellspacing="10" align="left">
                    
                      <tr>
                        <td><a href="#" target="_blank"><img src="../pictures/vienthong/mobiphone.png" width="110" height="25" /></a></td>
                        <td><a href="#" target="_blank"><img src="../pictures/vienthong/viettel.png" width="88" height="60" /></a></td>
                        <td><a href="#" target="_blank"><img src="../pictures/vienthong/vinaphone.png" width="122" height="40" /></a></td>
                        <td><a href="#" target="_blank"><img src="../pictures/vienthong/vnmobile.png" width="100" height="65" /></a></td>
                        <td><a href="#" target="_blank"><img src="../pictures/vienthong/beeline.png" width="65" height="50" /></a></td>
                        <td><a href="#" target="_blank"><img src="../pictures/vienthong/evn.png" width="120" height="30" /></a></td>


                        </tr>
                   </table>
                    
              </div>
                </div>
            <script language="javascript">
            $('#tab-box li a').each(function(index) {
                $(this).bind('mouseover', function() {
                    $('#tab-box li').removeClass('active').eq(index).addClass('active');
                    $('.tab-content').hide().eq(index).show();
                    return false;
                }).bind('click',function() {return false;});
            });
            </script>	
           </div>
             <!--End-Box hỗ trợ - thanh toán-->