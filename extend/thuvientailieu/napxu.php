<?php
/*======================================================================*\
|| #################################################################### ||
|| # Milano Page Product         	                                  # ||
|| # ---------------------------------------------------------------- # ||
|| # Copyright ©2011 ®DNU.VN™ and LetVn.COm.       		    	      # ||
|| # Coded by Mr.Milano	- 0903.24.24.66			       			      # ||
|| #################################################################### ||
\*======================================================================*/
// ######################## SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);
define('THIS_SCRIPT', 'payment');
// #################### PRE-CACHE TEMPLATES AND DATA ######################
// get special phrase groups
$phrasegroups = array();
// get special data templates from the datastore
$specialtemplates = array();
// pre-cache templates used by all actions
$globaltemplates = array(
// change the value below if you wish to rename the template used in the script
        'shell_blank',      
);
// pre-cache templates used by specific actions
$actiontemplates = array();
// ########################## REQUIRE BACK-END ############################
require_once('./global.php');


// Cau Hinh API the cao

$CP_ID = 17;
$khuyenmai = array(
    '10000'     => '20000', // so tien khuyen mai
    '20000'     => '40000',
    '30000'     => '60000',
    '50000'     => '100000',
    '100000'    => '200000',
    '200000'    => '400000',
    '300000'    => '600000',
    '500000'    => '1000000',
	// Hien tai là minh dang de x2 tat ca cac menh gia the do
);


// #################### HARD CODE JAVASCRIPT PATHS ########################
$headinclude = str_replace('clientscript', $vbulletin->options['bburl'] . '/clientscript', $headinclude);
// ########################################################################
// ######################### START MAIN SCRIPT ############################
// ########################################################################
$userid = $vbulletin->userinfo['userid'];
$username = $vbulletin->userinfo['username'];
$xuhientai = ($vbulletin->userinfo['money']>0) ? $vbulletin->userinfo['money']:0;

//---- Begin Settings ---- //
$Mod_Name = 'Payment Card';
$web_title = 'Nạp xu bằng thẻ cào VINA - MOBI';
$navbar_title = 'Nạp xu bằng thẻ cào VINA - MOBI';

//---- End Settings ---- //

$telco= $_REQUEST['type'];
$mathe = trim($_REQUEST['pin']);
$seri  = trim($_REQUEST['serial']);	
$do  = $_REQUEST['do'];

//---- End $_GET ---- //

	// navbar Default
	$navbits = construct_navbits(array(
		$vbulletin->options['bburl'] => $vbulletin->options['bbtitle'],
		'' => $navbar_title
	)); 

if($vbulletin->options['bbactive']==1 && $do=='ajax') 
{
        if($userid<1) {
			$result = array(
                'check' =>  0,
                'messenge' => 'Bạn chưa đăng nhập!',
                'xu' => 0,
                'vnd' => 0,
                'xutotal' => ($vbulletin->userinfo['money'] > 0) ? $vbulletin->userinfo['money'] : 0,
                );
                echo json_encode($result); 
				exit();
		}
				
		$string = @file_get_contents('http://112.78.8.165:6666/AdCardService.aspx?cardSeri='.$seri.'&cardcode='.$mathe.'&telco='.$telco.'&cp_id='.$CP_ID);
		$info=explode('|',$string);
        $menhgia = $info[2];
        $notice = $info[1];
		$sotien = ($khuyenmai[$menhgia] > 0) ? $khuyenmai[$menhgia] : $menhgia/1000;
		
        if($info[0]=='01') {
            $sql = "UPDATE user SET money = money + $sotien";
            $sql .= "WHERE userid = $userid";
            @mysql_query($sql);
            
            $result = array(
                'check' =>  1,
                'messenge' => $notice,
                'xu' => $menhgia,
                'vnd' => $sotien,
                'xutotal' => ($vbulletin->userinfo['money'] > 0) ? $vbulletin->userinfo['money'] : 0,
            );
            echo json_encode($result);
        }
        else {
                $result = array(
                'check' =>  0,
                'messenge' => 'Nạp thẻ thất bại!.',
                'xu' => 0,
                'vnd' => 0,
                'xutotal' => ($vbulletin->userinfo['money'] > 0) ? $vbulletin->userinfo['money'] : 0,
                );
                echo json_encode($result);    
            }
        
}	
else
{
$noidung = <<<MILANO
       <link rel="stylesheet" type="text/css" href="http://kilobooks.com/fbo/upload/grid.css">
    <link rel="stylesheet" type="text/css" href="http://kilobooks.com/fbo/upload/tabs.css">
    <link rel="stylesheet" type="text/css" href="http://kilobooks.com/fbo/upload/button.css">
    <script type="text/javascript" src="http://kilobooks.com/fbo/upload/jquery.tools.min.js"></script>
    <script type="text/javascript" src="http://kilobooks.com/fbo/upload/jquery.ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://kilobooks.com/fbo/upload/custom.css">    
<!-- Show info SMS -->

<div id="chilaclose">
	<!-- napxu begin -->
	<div class="upload">

		<h2 class="blockhead">
			<b>THÔNG TIN TÀI KHOẢN</b>
		</h2> 
		<div class="blockbody formcontrols settings_form_border"> 
			<div class="section">
				<div class="blockrow">
					<label>Tên tài khoản:</label> 
					<div class="for_ie7"><b><a class="link" href="{$vbulletin->options['bburl']}/member.php?u={$userid}">{$username}</a></b></div> 
				</div>

				<div class="blockrow">
					<label>Mã số thành viên:</label> 
					<div class="for_ie7"><b>{$userid}</b></div> 
				</div>
				<div class="blockrow">
					<label>Số dư tài khoản:</label> 
					<div class="for_ie7"><b><span id="soduTK">{$xuhientai}</span></b></div>
					</div>

			</div>
		</div>
		<div class="welcomeBody" style="margin-top:10px;font-weight:bold;padding:10px;">
			<div style="padding:0 25px;background: url(http://www.kilobooks.com/images/buttons/warning.png) no-repeat left center;">Chào <a class="link" href="{$vbulletin->options['bburl']}/member.php?u={$userid}">{$username}</a>, bạn có thể chọn một trong các cách bên dưới để nạp XU. Tài khoản của bạn sẽ được cộng XU ngay lập tức sau khi nạp.<br/>Mọi thắc mắc khiếu nại xin liên hệ hotline: <font color="red">0122 4545 186</font></div>
		</div>

		<!-- Tabs Section -->

		<section class="container_66 clearfix" style="margin:10px 0 0 0; width:100%;">
			<div class="grid_6">
				<ul class="tabs">
					<li><a href="#" class="current"><font color=green><b>THẺ CÀO-TẶNG 50%</b></font> <img src="/fbo/icon/new.gif"/></a></li>
					<li><a name="bank" href="#"><font color=red><b>NGÂN HÀNG-TẶNG 100%</b></font> <img src="/fbo/icon/hot6.gif"/></a></li>
					<li><a href="#"><font color=blue><b>NHẮN TIN SMS</b></font></a></li>

					<li><a href="#">NGÂN LƯỢNG</a></li>
					<li><a href="#">BẢO KIM</a></li>
					<li><a href="#">PAYPAL</a></li>
				</ul>
				<!-- tab "panes" -->
				<div class="panes clearfix">
					<section class="paneltab" style="display: block; ">

						<div class="contentpanes">
						<div style="text-align:center;font-size:20px;color:darkgreen;font-weight:bold;">NẠP XU, MUA TÀI LIỆU BẰNG CÁCH NẠP THẺ CÀO</div><br/>
							<b>I. LỢI ÍCH - TIẾT KIỆM</b><br/>
							<br/>
							Nếu với một tin nhắn SMS 15.000 VNĐ thì bạn có 15 xu trong tài khoản thì với 10.000 VNĐ nạp qua thẻ cào thì bạn sẽ được 15 xu (Gấp 1 lần so với nạp xu bằng SMS). <br/>
							<font color="red"><b>Ví dụ</b></font>: Bạn nạp 20.000 VNĐ thì tài khoản <b><a class="link" href="{$vbulletin->options['bburl']}/member.php?u={$userid}">{$username}</a></b> tại SINHVIENNET của bạn sẽ có 30 Xu<br/>

							<br/>
							<b>II. MỘT SỐ LƯU Ý</b><br/><br/>
							- Hiện tại Sinhviennet chỉ chấp nhận thẻ Vina và Mobi <br/>
							- Nếu bạn nhận được thông tin "Mã số thẻ không đúng" khi nạp thì có thể mã thẻ này sai hoặc đã được sử dụng.<br/>
							- Sau khi bạn nạp thẻ cào thành công, hệ thống sẽ tự động nạp xu cho bạn dựa trên giá trị thẻ cào
							<br/><br/>
<table style="width:100%;">
<tr>
<td style="width:50%;padding-left:50px;">

							<form>
								<div class="blockrow" style="padding:5px 0;">
									<div class="error" id="icoin_respon" style="display:none;">
										<h3 id="icoin_result"></h3>
										<div style="text-align:center; display:none;" id="icoin_progress"><img src="http://www.kilobooks.com/images/misc/13x13progress.gif" alt="" /></div>
									</div>
									<label for="typecard"><b>Loại thẻ cào:</b></label> 
									<label class="lbvms" for="VMS"><input type="radio" id="t3_type1" name="t3_type" value="1" checked="checked" /><img src="http://www.kilobooks.com/images/icons/sms/mobifone.png" alt="MobiCard" /></label>
									<label class="lbvnp" for="VNP"><input type="radio" id="t3_type2" name="t3_type" value="2" /><img src="http://www.kilobooks.com/images/icons/sms/vinaphone.png" alt="VinaCard" /></label>
                                    <label class="lbvtt" for="VTT"><input type="radio" id="t3_type3" name="t3_type" value="3" /><img src="http://www.kilobooks.com/images/icons/sms/viettel.png" alt="Viettel" /></label>
								</div>
								<div class="blockrow" style="padding:0;">
									<label for="numbercard"><b>Mã thẻ cào:</b></label> &nbsp;
									<input style="width:200px;" name="t3_pin" id="t3_pin" type="text" class="primary textbox" maxlength="15" />
                                    <br><label for="numbercard"><b>Seri thẻ cào:</b></label> 
                                    <input style="width:200px;" name="t3_serial" id="t3_serial" type="text" class="primary textbox" maxlength="15" />
									<p class="description"><i>Bạn vui lòng nhập mã thẻ dưới lớp tráng bạc trên thẻ.</i></p> 
								</div>								
								<div class="blockrow"> 
									<p class="description" id='t3_infomation'></p> 
								</div>
									<script type="text/javascript">
								var check = false;							                                   
								function cardvms()
								{
			                         var t3_serial = $('#t3_serial').val();
                                     var t3_pin = $('#t3_pin').val();
                                     var t3_type = 'MOBI';
									//Type card - Vina hoac Mobi
									if($('#t3_type1').is(':checked')){
										t3_type = 'MOBI';	
									}
                                    else if($('#t3_type2').is(':checked')){
										t3_type = 'VINA';	
									}
									else{
										t3_type = 'VT';
									}
                                    if(t3_serial.length<1)alert('Bạn chưa nhập mã thẻ!');
                                    else if(t3_serial.length < 12) alert('Mã seri chưa chính xác, xin kiểm tra lại!');
                                    else if(t3_pin.length < 12 || t3_pin.length > 15) alert('Mã thẻ chưa chính xác, xin kiểm tra lại!');
                                    else {                                                                        
                                     
                                    $('#t3_infomation').html('<font color="red">Đang xử lý</font> <img src="http://www.kilobooks.com/card/ajax-loader.gif" />');
                            		
                                    $.ajax({
                            			url: 'napxu.php',
                            			type: 'GET',
                            			data: 'do=ajax&type='+t3_type+'&serial='+t3_serial+'&pin='+t3_pin,
                            			success: function(string){
                            				var result = $.parseJSON(string);
                                            if(result.check == 1)
                            				{
                            					$('#t3_infomation').html('<font color="green">'+"Bạn vừa nạp card <b>"+result.vnd+"</b>VNĐ.<br />Số xu bạn được nhận là : "+result.xu+"<br />Số xu hiện giờ của bạn là : <b>"+result.xutotal+'</b></font>');
                            				    $('#soduTK').html(result.xutotal);
                                            }
                            				else
                            				{
                          						$('#t3_infomation').html('<font color="red">'+result.messenge+'</font>');	
                            				}
                            			},
                            			error: function (){
                            				alert('Có lỗi xảy ra');
                            			}
                            		});
                                    
                                    }
								}

								</script>

								<div class="blockfoot actionbuttons settings_form_border"> 

									<div class="group" style="text-align:left !important;margin-left:80px;"> 
										<input class="button" style="padding:5px;" value="Nạp tiền" accesskey="s" type="button" onClick="return cardvms();" /> 
										<input class="button" style="padding:5px;" value="Nhập lại" accesskey="r" type="reset" /> 
									</div>
								</div>
</td>
<td style="width:50%;text-align:center;">
							<img src="http://www.kilobooks.com//fbo/thanhtoan/hinhthuc.png" alt="hinh thuc"/><br/><img src="http://sinhviennet.net/images/card.png" alt="card dien thoai"/>

</td>
</tr>
</table>
							</form>
						</div>
					</section>
					<section class="paneltab" style="display: none; ">
						<div class="contentpanes">
							<div style="text-align:center;font-size:20px;color:darkgreen;font-weight:bold;">NẠP XU, MUA TÀI LIỆU BẰNG CÁCH CHUYỂN KHOẢN NGÂN HÀNG</div><br/>
							<b>I. LỢI ÍCH - TIẾT KIỆM</b><br/>

							<br/>
							Nếu với một tin nhắn SMS 15.000 VNĐ thì bạn có 15 xu trong tài khoản thì với 50.000 VNĐ chuyển khoản qua Ngân hàng thì bạn sẽ được 100 xu (Gấp 2 lần so với nạp xu bằng SMS). <br/>
							<div align="center"><img src="http://www.kilobooks.com//fbo/thanhtoan/hinhthuc.png" alt="hinh thuc"/><br/><img src="http://sinhviennet.net/images/bank.png" alt="nạp xu bằng chuyển khoản ngân hàng"/></div>
						        <br/>
							<br/>
							<b>II. QUY TRÌNH NẠP XU QUA NGÂN HÀNG (CHỈ CÓ 2 BƯỚC)</b><br/><br/><b>Bước 1:</b> Chuyển khoản ngân hàng (các ngân hàng được liệt kê phía dưới) <br/> <br/>

<b>Bước 2:</b> Để xác nhận, bạn vui lòng gửi SMS gồm những thông tin sau đến <b><font color="red">0122 4545 186</font> (số điện thoại này chỉ nhận sms) </b><br/><br/>
							
- Ngân hàng chuyển tiền: (Vietcombank/vietinbank/dongabank/agribank...)<br/>
- Họ và tên:<br/>
- Số tài khoản ngân hàng của bạn(Nếu các bạn chuyển khoản)<br/>
- Số tiền gởi:<br/>
- Nội dung chuyển tiền : Nạp Xu cho username : {$username} , ID : {$userid}</font>						

<br/> <br/>									
<h3 class="blocksubhead"><font color="red"><b>CHÚ Ý KHI NẠP XU BẰNG HÌNH THỨC CHUYỂN KHOẢN NGÂN HÀNG</b></font></h3>
<br />
- Số tiền chuyển thấp nhất là 50.000 VNĐ<br/>
- Nên chuyển cùng Ngân hàng để trách mất phí khi giao dịch.<br />
- Bắt buộc phải gửi tin nhắn xác nhận ngay trong ngày chuyển tiền. <br />
- Liên hệ với Sinhviennet ngay trong ngày chuyển tiền nếu xu chưa được nạp.
							<br/><br/>
							<b>III. THÔNG TIN CÁC TÀI KHOẢN NGÂN HÀNG</b><br/><br/>
							<div style="background-color: #ffffff; padding: 10px; border: solid 1px #c6c6c6;">

								<div style="width: 740px; height:110px; border-bottom: dashed 1px #c6c6c6;">
									<div class="content-title-image"><img src="http://www.kilobooks.com/images/icons/bank/vcb.jpg" alt=""/></div>
									<div>
										<div class="focus">Ngân Hàng Ngoại Thương - Vietcombank</div>
										<div>Chủ tài khoản: Ph&#7841;m Minh D&#432;&#417;ng</div>
										<div>Số tài khoản: 0401000153922</div>
										<div>Ngân hàng Vietcombank - Long Thᯨ - &#272;&#7891;ng Nai</div>

										<div style="padding-top:10px; font-weight: bold;">Nội dung (bắt buộc phải ghi): Nạp Xu cho Username : <a class="link" href="{$vbulletin->options['bburl']}/member.php?u={$userid}">{$username}</a> , ID : {$userid} </div>
									</div>
								</div>
								
					
							</div>
							
						</div>

					</section>
					<section class="paneltab" style="display: none; ">
						<div class="contentpanes">

							<div style="background:transparent url(http://www.kilobooks.com/images/icons/keng/keng-icon.png) no-repeat bottom right;" class="blockrow">
								<div style="text-align:center;font-size:20px;color:darkgreen;font-weight:bold;">NẠP XU, MUA TÀI LIỆU BẰNG CÁCH NHẮN TIN SMS</div><br/>
								<font size=3>Chào bạn <font color=red><b><a class="link" href="{$vbulletin->options['bburl']}/member.php?u={$userid}">{$username}</a></b></font>. Mã số thành viên của bạn là:<font color=red><b>{$userid}</b></font><br/> 
									Trước khi nhắn tin vui lòng đọc hết hướng dẫn của chúng tôi để tránh những sai sót đáng tiếc!<br/>

									Từ Điện thoại di động hãy soạn tin nhắn theo Nội dung sau:<br/><br/>
									<div style="border: 2px dashed white; background: #bbdbfd; padding: 5px 0px 5px 1px;text-align:center;font-weight:bold;">
										<font size="5" color="red">SVN {$userid}</font></b> <font color="#000099"><b>rồi gửi tới số</b></font> <b><font size="5" color="green">8788</font></b>
									</div><br/>
									<div class="quote">
										<div style="border-left:3px solid #ccc; margin:0px; padding:0 5px;">

											<img src="images/icons/li.gif"> <font color=red><b>SVN</b></font> là Mã Cú Pháp<br/>
											<img src="images/icons/li.gif"> <font color=red><b>{$userid}</b></font> là Mã số Thành Viên của bạn.<br/>
											<img src="images/icons/li.gif"> Giữa <font color=red><b>SVN</b></font> và <font color=red><b>{$userid}</b></font> là khoảng trống!<br/>

											<img src="images/icons/li.gif"> Phí tin nhắn đến <font color=green><b>8788</b></font> là <b>15.000 VNĐ</b><br/>
											<img src="images/icons/li.gif"> Tổng đài <font color=green><b>8788</b></font> hỗ trợ các mạng <img src="images/icons/sms/viettel.png"/> <img src="images/icons/sms/mobifone.png"/> <img src="images/icons/sms/vinaphone.png"/><br/>

											<img src="images/icons/li.gif"> Mỗi tin nhắn thành công, bạn sẽ có thêm <font color=black><b>15 Xu</b></font> trong tài khoản của mình.
										</div>
									</div>
									<center><font color=red><b>
												Không được gửi 3 tin nhắn trong vòng 5 phút, không được gửi quá 10 tin trong 24 giờ <br/>
												(Bạn có thể dùng số điện thoại khác để nạp XU tiếp khi đã quá 10 tin nhắn)
											</b></font></center>

									<br/><br/>
								</font>
							</div>

						</div>
					</section>
					<section class="paneltab" style="display: none; ">
						<div class="contentpanes">
							Tính năng này dự kiến được hoàn thành vào ngày 11/11/2011
						</div>

					</section>
					<section class="paneltab" style="display: none; ">
						<div class="contentpanes">
						Tính năng này dự kiến được hoàn thành vào ngày 11/11/2011
						</div>
					</section>
					<section class="paneltab" style="display: none; ">
						<div class="contentpanes">
						Tính năng này dự kiến được hoàn thành vào ngày 11/11/2011
						</div>

					</section>

				</div>
			</div>
		</section>    
		<ul class="action-buttons clearfix fr" style="float:right;margin:10px 12px 0 0;">
			<li><a href="forum.php" class="mybutton mybutton-gray"><span class="add"></span>Về trang chủ</a></li>
		</ul>   
		<!-- End Tabs Section -->
	</div>

	<!-- napxu end -->
</div>                        
                        
                        
                        
  </div>                      
                        
                        
                        
                        
    <script type="text/javascript">
		$("ul.tabs").tabs("div.panes > section.paneltab");
		$("ul.sidebar-tabs").tabs("div.panes > section");
    </script>                        
                        
                        
                        
                        
MILANO;


// Copyright Milano
$noidung .= "
<!--
Mod's name: ".$Mod_Name." for vbb 4
Coded by Nguyen Trung Kien
Mobile: 0903.24.24.66
Website: DNU.VN - LetVN.Com
Email: TrungKien@dnu.vn
-->
";

	$navbar = render_navbar_template($navbits);
	//final output
	$templater = vB_Template::create('shell_blank');
	$templater->register_page_templates();
	$templater->register('navbar', $navbar);
	$templater->register('pagetitle', $web_title);
	$templater->register('html', $noidung);
	print_output($templater->render());



}

// Thong bao cho Guest neu chua dang nhap hoac Khong co Quyen
//else $noidung='<center><font color=red size=4><strong>Bạn không có quyền vào khu vực này</strong></font></center>';	

?>