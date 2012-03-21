<?php
defined('_JEXEC') or die('Restricted access');
?>
<div class="contenttop_left">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top">
					<div class="featured">
						<div class="wrap">
						   <div id="slide-holder">
								<div id="slide-runner">
									<?php
									$i = 0; 
									foreach ($list as $item) :
									if ($i<=4){  
									?>
										<a href="<?php echo $item->link; ?>">
						    				<img id="slide-img-<?php echo $i;?>" src="http://localhost/projects/news/templates/newspaper/images/20120301T2.jpg" />
						    			</a>
									<?php
									}
									$i++;
									?>	
									<?php endforeach; ?>
								    <div id="slide-controls">
								     <p id="slide-client" class="text"><strong>post: </strong><span></span></p>
								     <p id="slide-desc" class="text"></p>
								     <p id="slide-nav"></p>
								    </div>
								</div>
						   </div>
						   <script type="text/javascript">
						    if(!window.slider) var slider={};
						    slider.data=[
								<?php
								$i = 0;
								foreach ($list as $item) :
								if ($i<=4){
								?>
								{"id":"slide-img-<?php echo $i;?>","client":"<?php echo $item->text; ?>","desc":"<?php echo $item->text; ?>"},
								<?php
								}
								$i++;
								?>	
								<?php endforeach; ?>
						    ];
						   </script>
						</div>
					</div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	</table>
</div>
<div class="contenttop_righ">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top">
				<div class="newsTopmain">
					<h2 class="topnews">Tin nổi bật</h2>
					<?php
					$i = 0;
					foreach ($list as $item) :
					if ($i>4 && $i<8){
					?>
					<div id='item-0' class='newsTopmain-panel'>
						<a href="<?php echo $item->link; ?>">
							<img src="http://localhost/projects/news/templates/newspaper/images/20120310_a1.jpg" alt="" hspace="10" vspace="10" width="447px" />
						</a>
						<div class='info'> 
							<h2><a href="<?php echo $item->link; ?>"><?php echo $item->text; ?></a></h2>
						</div> 
					</div>
					<?php
					}
					$i++;
					?>	
					<?php endforeach; ?>
				</div>
				</td>
			</tr>
		</table>
		<div class="ms-PartSpacingVertical"></div>
		</td>
	</tr>
	<tr>
		<td valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td valign="top">
				<img src='/Style Library/Imagesnew/MIC/line.jpg' border='0' height='1px' class='news'>
				<?php
				$i = 0;
				foreach ($list as $item) :
				if ($i>=8){
				?>
				<div class="MainBottomNormal2">
					<img width="3" hspace="5" height="3" align="absmiddle" src="/Style Library/Imagesnew/MIC/icon_01.jpg" />
					<h2><a href="<?php echo $item->link; ?>"><?php echo $item->text; ?></a></h2>
				</div>
				<?php
				}
				$i++;
				?>	
				<?php endforeach; ?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	</table>
</div>
