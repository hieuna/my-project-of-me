<?php
defined('_JEXEC') or die('Restricted access');
$baseurl = JURI::base();
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
							<div id="desciption">
								<p id="slide-desc" class="text" style="padding: 0 5px;"></p>
							</div>
						   <div id="slide-holder">
								<div id="slide-runner">
									<?php
									$i = 0; 
									foreach ($list as $item) :
									if ($i<=4){  
									?>
										<a href="<?php echo $item->link; ?>">
											<?php if ($item->images != ""):?>
						    				<img id="slide-img-<?php echo $i;?>" src="<?php echo $baseurl;?>images/stories/<?php echo $item->images;?>" />
						    				<?php else :?>
						    				<img id="slide-img-<?php echo $i;?>" src="<?php echo $baseurl;?>images/no_image.jpg" />
						    				<?php endif;?>
						    			</a>
									<?php
									}
									$i++;
									?>	
									<?php endforeach; ?>
								    <div id="slide-controls">
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
								{"id":"slide-img-<?php echo $i;?>","client":"","desc":"<?php echo $item->text; ?>"},
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
					<div class="orther_specials">
						<ul>
						<?php
						$i = 0;
						foreach ($list as $item) :
						if ($i>4 && $i<11){
						?>
						<li>
							<a href="<?php echo $item->link; ?>">
								<?php if ($item->images != ""):?>
								<img src="<?php echo $baseurl;?>images/stories/<?php echo $item->images;?>" alt="<?php echo $item->title;?>" hspace="10" vspace="10" width="447px" />
								<?php else :?>
								<img src="<?php echo $baseurl;?>images/no_image.jpg" alt="<?php echo $item->title;?>" />
								<?php endif;?>
							</a>
							<a href="<?php echo $item->link; ?>"><?php echo $item->text; ?></a>
						</li>
						<div class="clr"></div>
						<?php
						}
						$i++;
						?>	
						<?php endforeach; ?>
						</ul>
					</div>
					<div class="orther_specials">
						<ul>
						<?php
						$i = 0;
						foreach ($list as $item) :
						if ($i>10 && $i<17){
						?>
						<li>
							<a href="<?php echo $item->link; ?>">
								<?php if ($item->images != ""):?>
								<img src="<?php echo $baseurl;?>images/stories/<?php echo $item->images;?>" alt="<?php echo $item->title;?>" hspace="10" vspace="10" width="447px" />
								<?php else :?>
								<img src="<?php echo $baseurl;?>images/no_image.jpg" alt="<?php echo $item->title;?>" />
								<?php endif;?>
							</a>
							<a href="<?php echo $item->link; ?>"><?php echo $item->text; ?></a>
						</li>
						<?php
						}
						$i++;
						?>	
						<?php endforeach; ?>
						</ul>
					</div>
				</div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	</table>
</div>
