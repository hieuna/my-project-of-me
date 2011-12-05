{literal}
<style type="text/css">
.block_step {
	width:974px; height:35px; background:url(templates/images/step_bg.gif) no-repeat;
}
#step_element_on, #step_element_off {
	height:35px; float:left
}
#step_element_on .step_left, 
#step_element_on .step_center, 
#step_element_on .step_right, 
#step_element_off .step_left, 
#step_element_off .step_center, 
#step_element_off .step_right {
	float:left; height:35px; font-weight:bold; padding-top:10px;
}
#step_element_on .step_left, 
#step_element_off .step_left {
	text-align:center;width:38px; margin-left:10px; font-size:16px; padding-top:8px;
}
#step_element_on .step_center, 
#step_element_off .step_center {
	width:auto; padding-left:5px; padding-right:5px; 
}
#step_element_on .step_right, 
#step_element_off .step_right { 
	width:13px
}
#step_element_on .step_left{background:url(templates/images/step_left_on.gif) no-repeat; color:#148dc6;}
#step_element_on .step_center{background:url(templates/images/step_center_on.gif) repeat-x; color:#FFF; text-shadow:1px 0px 0 #333;}
#step_element_on .step_right{background:url(templates/images/step_right_on.gif) no-repeat}
#step_element_off .step_left{background:url(templates/images/step_left_off.gif) no-repeat; color:#FFF; text-shadow:1px 0px 0 #333;}
#step_element_off .step_right{background:url(templates/images/step_right_off.gif) no-repeat}
</style>
<link type='text/css' href='include/js/jquery/css/overlay.css' media="screen" rel='stylesheet'></script>
{/literal}
<div class="block_step">
	<div id="step_element_{if $step==1}on{else}off{/if}" title="Bước 1: Nhập thông tin tài khoản">
		<div class="step_left" {if $step==1}style="margin:0"{/if}>1</div>
		<div class="step_center">Nhập thông tin tài khoản</div>
		<div class="step_right"></div>
		<div style="clear:both"></div>
	</div>
	
	<div id="step_element_{if $step==2}on{else}off{/if}" title="Bước 2: Kích hoạt tài khoản">
		<div class="step_left">2</div>
		<div class="step_center">Kích hoạt tài khoản</div>
		<div class="step_right"></div>
		<div style="clear:both"></div>
	</div>
	
	<div id="step_element_{if $step==3}on{else}off{/if}" title="Bước 3: Hoàn thành">
		<div class="step_left">3</div>
		<div class="step_center">Hoàn thành</div>
		<div class="step_right"></div>
		<div style="clear:both"></div>
	</div>
</div>