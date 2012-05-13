<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
?>

<script language="javascript">
        function SwithTabs(nameprefix, count, activeindex)
        {
                for(i=0;i<count;i++)
                {
                        var obj=document.getElementById(nameprefix+i);
                        obj.style.display="none";
                }
                
                var obj=document.getElementById(nameprefix+activeindex);
                obj.style.display="block";
        }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_youtubegallery&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="youtubegallery-form" class="form-validate">
        <fieldset class="adminform">
				<?php echo JText::_( 'ID' ); ?>: <?php echo $this->row->id; ?>
                
                
                <legend><?php echo JText::_( 'YouTube Gallery' ); ?> (Free Version)</legend>
                
                <p>
                <?php echo JText::_( 'Gallery Name' ); ?>
				<input type="text" name="galleryname" id="galleryname" class="inputbox" size="40" value="<?php echo $this->row->galleryname; ?>" />
                </p>
                
                
                
                <?php //Links ?> <h4><?php echo JText::_( 'List of Video Links' ); ?></h4>
                <div style="border: 1px dotted #000000;padding:10px;margin:0px;">
                       
                        <table style="border:none;">
                                <tbody>
                                        <tr><td><textarea cols="60" rows="20" name="gallerylist" id="gallerylist" class="inputbox" ><?php echo $this->row->gallerylist; ?></textarea></td>
										<td>
											<code>
						example:<br>
						http://www.youtube.com/watch?v=baLkXC_qWJY&feature=related<br>
						http://www.youtube.com/watch?v=H1wXsygQTVA&feature=related<br>
						http://www.youtube.com/watch?v=VSGMqfGmjG0<br>
						<br>
						http://www.youtube.com/playlist?list=PL5298F5DAD70298FC&feature=mh_lolz<br>
						http://www.youtube.com/user/designcompasscorp<br>
						youtubestandard:<i>video_feed</i><br>
						
						<a href="http://extensions.designcompasscorp.com/index.php/youtube-gallery-standard-feeds" target="_blank">More about Standard Video Feeds</a><br>
						<br>
						http://vimeo.com/8761657<br>
						http://video.yahoo.com/watch/2342109/7336957<br>
						http://video.google.com/videoplay?docid=-1667589095394987118#<br>
						http://www.collegehumor.com/video/6446891/what-pi-sounds-like<br>
										
											<?php
						
						if(ini_get('allow_url_fopen')==0)
						{
							echo '<p>
						<b>Please note:</b><br>
						
						For Yahoo! Video, Vimeo and Google Video<br>
						<span style="color: red;">php 5.x and [allow_url_fopen=on] record in php.ini file are required.</span>
						</p>';
						}
						?>
						<p>
						Also you may have your own title, description and thumbnail for each video.<br>
						To do this type comma then "title","description","imageurl","specail_parameters"<br>
						Should look like: http://www.youtube.com/watch?v=baLkXC_qWJY,"Video Title","Video description","images/customthumbnail.jpg"<br>
						or<br>
						http://www.youtube.com/watch?v=baLkXC_qWJY,"Video Title",,"images/customthumbnail.jpg"
						</p>
						<p>Special parameter:
						<br><br>max-results=<i>NUMBER</i>,start-index=<i>NUMBER</i>,orderby=<i>FIELD_NAME</i>
						<br><a href="http://extensions.designcompasscorp.com/index.php/youtube-gallery-special-parameters" target="_blank">More about Special Parameters</a>
						</p>
				
						
										
										</td></tr>
										
						
						
                                </tbody>
                        </table>
                </div>
                
                <p><br /><br /></p>
               
                <?php $d=($this->row->customlayout!='' ? 'none' : 'block' ); ?>
                <div style="border: 1px dotted #000000;padding:10px;margin:0px;display: <?php echo $d; ?>;" id="layouttab_0" class="layouttab_content">
                        <div style="margin-top:-50px;">
                                 <?php //Layout Wizard ?> <h4>Layout Wizard | <a href="javascript: SwithTabs('layouttab_',2,1)">Custom Layout</a></h4>
                        </div>
                        <table style="border:none;">
                                <tbody>
                                        <tr><td><?php echo JText::_( 'Show Gallery Name' ); ?></td><td>:</td><td><input type="radio" name="showgalleryname" class="inputbox" value="1" <?php echo ($this->row->showgalleryname==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="showgalleryname" class="inputbox" value="0" <?php echo ($this->row->showgalleryname==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?></td></tr>
                                        <tr><td><?php echo JText::_( 'Gallery Name CSS Style' ); ?></td><td>:</td>
											<td>AVAILABLE IN "PRO" VERSION ONLY</td></tr>
                                        <tr><td><?php echo JText::_( 'Pagination' ); ?></td><td>:</td><td>
										
										<?php
							$columns=array();
							$columns[]=array('vlu'=>0, 'text'=>'No');
							$columns[]=array('vlu'=>1, 'text'=>'Above');
							$columns[]=array('vlu'=>2, 'text'=>'Below');
							$columns[]=array('vlu'=>3, 'text'=>'Both');
							
							
							echo JHTML::_('select.genericlist',  $columns, 'pagination', 'class="inputbox"', 'vlu', 'text', $this->row->pagination); ?>
										
										</td></tr>
                                        <tr><td><?php echo JText::_( 'Show Active Video Title' ); ?></td><td>:</td><td><input type="radio" name="showactivevideotitle" class="inputbox" value="1" <?php echo ($this->row->showactivevideotitle==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="showactivevideotitle" class="inputbox" value="0" <?php echo ($this->row->showactivevideotitle==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?>
						<?php
						
						if(!ini_get('allow_url_fopen'))
						{
							echo '<br><span style="color: red;">php 5.x and [allow_url_fopen=on] record in php.ini file are required.</span>';
						}
						?></td></tr>
										<tr><td><?php echo JText::_( 'Video Title CSS Style' ); ?></td><td>:</td><td>AVAILABLE IN "PRO" VERSION ONLY</td></tr>
                                        <tr><td><?php echo JText::_( 'Show First Video' ); ?></td><td>:</td><td><input type="radio" name="playvideo" class="inputbox" value="1" <?php echo ($this->row->playvideo==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'Play First Video' ); ?>
						<input type="radio" name="playvideo" class="inputbox" value="0" <?php echo ($this->row->playvideo==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'Gallery Only' ); ?></td></tr>
                                        <tr><td><?php echo JText::_( 'Player Width' ); ?></td><td>:</td><td><input type="text" name="width" id="width" class="inputbox" size="40" value="<?php echo $this->row->width; ?>" /></td></tr>
                                        <tr><td><?php echo JText::_( 'Player Height' ); ?></td><td>:</td><td><input type="text" name="height" id="height" class="inputbox" size="40" value="<?php echo $this->row->height; ?>" /></td></tr>
                                        <tr><td><?php echo JText::_( 'Description CSS Style' ); ?></td><td>:</td><td>AVAILABLE IN "PRO" VERSION ONLY</td></tr>
                                        <tr><td><?php echo JText::_( 'Description Position' ); ?></td><td>:</td><td><?php
							$position=array();
							$position[]=array('vlu'=>0, 'text'=>'Above Video');
							$position[]=array('vlu'=>1, 'text'=>'Below Video');
							
							
							echo JHTML::_('select.genericlist',  $position, 'descr_position', 'class="inputbox"', 'vlu', 'text', $this->row->descr_position); ?>
								 </td></tr>
                                        <tr><td><?php echo JText::_( 'Show Active Video Description' ); ?></td><td>:</td><td><input type="radio" name="description" class="inputbox" value="1" <?php echo ($this->row->description==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="description" class="inputbox" value="0" <?php echo ($this->row->description==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?>
						
						<?php
						
						if(!ini_get('allow_url_fopen'))
						{
							echo '<br><span style="color: red;">php 5.x and [allow_url_fopen=on] record in php.ini file are required.</span>';
						}
						?></td></tr>
                                        <tr>
											<td><?php echo JText::_( 'CSS Style' ); ?></td>
											<td>:</td>
											<td>AVAILABLE IN "PRO" VERSION ONLY</td>
										</tr>
                                </tbody>
                        </table>
                </div>
                
                <?php $d=($this->row->customlayout!='' ? 'block' : 'none' ); ?>
                <div style="border: 1px dotted #000000;padding:10px;margin:0px;display: <?php echo $d; ?>;" id="layouttab_1" class="layouttab_content">
                        <div style="margin-top:-50px;">
                                 <?php //Layout Wizard ?> <h4><a href="javascript: SwithTabs('layouttab_',2,0)">Layout Wizard</a> | Custom Layout</h4>
                        </div>
                        <table style="border:none;">
                                <tbody>
                                        <tr>
                                                <td valign="top">Custom Layout</td><td>:</td><td>
												
												 <textarea filter="raw" cols="40" rows="23" name="customlayout"><?php echo $this->row->customlayout; ?></textarea>
												</td>
												
												
                                                <td valign="top">
                                                        
                                                        Layout tags:
                                                        
                                                        <table>
                                                                <tbody>
                                                                        <tr><td valign="top">[galleryname]</td><td>:</td><td>Gallery Name</td></tr>
                                                                        <tr><td valign="top">[videodescription]</td><td>:</td><td>Show Active Video Description</td></tr>
                                                                        <tr><td valign="top">[videoplayer]</td><td>:</td><td>Player</td></tr>
                                                                        <tr><td valign="top">[navigationbar]</td><td>:</td><td>Navigation Bar (list or table of thumbnails)</td></tr>
                                                                        <tr><td valign="top">[rel]</td><td>:</td><td>Rel option to apply any shadow/lightbox</td></tr>
                                                                        <tr><td valign="top">[count]</td><td>:</td><td>Number of videos (thumbnails)</td></tr>
                                                                        <tr><td valign="top">[pagination]</td><td>:</td><td>Pagination</td></tr>
                                                                        
                                                                </tbody>
                                                        </table>
                                                        
                                                        <br />
                                                        Example:<br>
                                                        
                                                        
                                                        <textarea cols="30" rows="12"><h3>[galleryname]</h3>
[if:videodescription]<h4>[videodescription]</h4>[endif:videodescription]
[videoplayer]
[if:videotitle]<h3>[videotitle]</h3>[endif:videotitle]

[if:count]
<hr  style="border-color:#E7E7E9;border-style:solid;border-width:1px;"  />
[navigationbar:classictable,simple]
[endif:count]</textarea>
                                                
                                                </td>                                
                                                      
                                        
                                        </tr>
                                                                                
                                </tbody>
                        </table>
                </div>
                
                

                
                <?php //Player Settings ?><h4>Player Settings</h4>
                <div style="border: 1px dotted #000000;padding:10px;margin:0px;">
                        <table style="border:none;">
                                <tbody>
                                        <tr><td><?php echo JText::_( 'Show Border' ); ?></td><td>:</td><td><input type="radio" name="border" class="inputbox" value="1" <?php echo ($this->row->border==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="border" class="inputbox" value="0" <?php echo ($this->row->border==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?></td></tr>
                                        <tr><td><?php echo JText::_( 'Primary Border Color' ); ?></td><td>:</td><td><input type="text" name="color1" id="color1" class="inputbox" size="20" value="<?php echo $this->row->color1; ?>" />
						RGB value in hexadecimal format.
						<br>
						Example: FF0000   <i>red</i></td></tr>
                                        <tr><td><?php echo JText::_( 'Secondary Border Color' ); ?></td><td>:</td><td><input type="text" name="color2" id="color2" class="inputbox" size="20" value="<?php echo $this->row->color2; ?>" />
						Video control bar background color and secondary border color. RGB value in hexadecimal format
						<br>
						Example: 00FF00   <i>green</i></td></tr>
                                        <tr><td><?php echo JText::_( 'Autoplay' ); ?></td><td>:</td><td><input type="radio" name="autoplay" class="inputbox" value="1" <?php echo ($this->row->autoplay==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="autoplay" class="inputbox" value="0" <?php echo ($this->row->autoplay==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?></td></tr>
                                        <tr><td><?php echo JText::_( 'Repeat (loop)' ); ?></td><td>:</td><td>	<input type="radio" name="repeat" class="inputbox" value="1" <?php echo ($this->row->repeat==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="repeat" class="inputbox" value="0" <?php echo ($this->row->repeat==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?></td></tr>
                                        <tr><td><?php echo JText::_( 'Fullscreen' ); ?></td><td>:</td><td><input type="radio" name="fullscreen" class="inputbox" value="1" <?php echo ($this->row->fullscreen==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="fullscreen" class="inputbox" value="0" <?php echo ($this->row->fullscreen==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?></td></tr>
                                        <tr><td><?php echo JText::_( 'Related Videos' ); ?></td><td>:</td><td>	<input type="radio" name="related" class="inputbox" value="1" <?php echo ($this->row->related==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="related" class="inputbox" value="0" <?php echo ($this->row->related==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?></td></tr>
                                        <tr><td><?php echo JText::_( 'Show Info' ); ?></td><td>:</td><td><input type="radio" name="showinfo" class="inputbox" value="1" <?php echo ($this->row->showinfo==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="showinfo" class="inputbox" value="0" <?php echo ($this->row->showinfo==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?></td></tr>
                                        <tr><td><?php echo JText::_( 'Controls' ); ?></td><td>:</td><td><input type="radio" name="controls" class="inputbox" value="1" <?php echo ($this->row->controls==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="controls" class="inputbox" value="0" <?php echo ($this->row->controls==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?></td></tr>
                                        
										<tr><td><?php echo JText::_( 'Mute' ); ?></td><td>:</td><td><input type="radio" name="muteonplay" class="muteonplay" value="1" <?php echo ($this->row->controls==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="muteonplay" class="inputbox" value="0" <?php echo ($this->row->muteonplay==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?></td></tr>
										
										<tr><td><?php echo JText::_( 'Player Type' ); ?></td><td>:</td><td><?php
							$position=array();
						    $position[]=array('vlu'=>1, 'text'=>'HTML5 (New Player)');
							$position[]=array('vlu'=>0, 'text'=>'Flash Only (Old Player)');
							$position[]=array('vlu'=>2, 'text'=>'Flash Only With Flash Detection (Old Player)');
							
							
							echo JHTML::_('select.genericlist',  $position, 'playertype', 'class="inputbox"', 'vlu', 'text', $this->row->playertype);
						?></td></tr>
                                        <tr><td><?php echo JText::_( 'Youtube Parameters' ); ?></td><td>:</td>
										<td>
											
											<table>
											<tbody>
											<tr>
											<td>
												<textarea cols="60" rows="5" name="youtubeparams" id="youtubeparams" class="inputbox" ><?php echo $this->row->youtubeparams; ?></textarea>
											</td>
											<td>
												<p>
														<i>Example:</i><br/>
														hd=1;<br>
														autohide=1;
												</p>
												<p>
													This may overwrite any settings set above. <a href="http://code.google.com/apis/youtube/player_parameters.html" target="_blank">More here</a>
												</p>
											</td>
											</tr>
											</tbody>
											</table>						
									
										</td></tr>
                                        
                                </tbody>
                        </table>
                </div>


                <?php //Navigation Bar ?><h4>Navigation Bar</h4>
                <div style="border: 1px dotted #000000;padding:10px;margin:0px;">
                        <table style="border:none;">
                                <tbody>
                                        <tr><td><?php echo JText::_( 'Navigation bar CSS Style' ); ?></td><td>:</td>
											<td>
											AVAILABLE IN "PRO" VERSION ONLY
											
											</td></tr>
                                        <tr><td><?php echo JText::_( 'Cols' ); ?></td><td>:</td><td>
										
										<?php
							$columns=array();
							
							$columns[]=array('vlu'=>1, 'text'=>'Table with 1 column');
							$columns[]=array('vlu'=>2, 'text'=>'Table with 2 columns');
							$columns[]=array('vlu'=>3, 'text'=>'Table with 3 columns');
							$columns[]=array('vlu'=>4, 'text'=>'Table with 4 columns');
							$columns[]=array('vlu'=>5, 'text'=>'Table with 5 columns');
							$columns[]=array('vlu'=>6, 'text'=>'Table with 6 columns');
							$columns[]=array('vlu'=>7, 'text'=>'Table with 7 columns');
							$columns[]=array('vlu'=>8, 'text'=>'Table with 8 columns');
							
							echo JHTML::_('select.genericlist',  $columns, 'cols', 'class="inputbox"', 'vlu', 'vlu', $this->row->cols); ?>
								 
						Number pf thumbnails per line
										
										</td></tr>
                                        <tr><td><?php echo JText::_( 'Thumbnail bgcolor' ); ?></td><td>:</td><td><input type="text" name="bgcolor" id="bgcolor" class="inputbox" size="40" value="<?php echo $this->row->bgcolor; ?>" />
						Example: FF0000   <i>red</i></td></tr>
                                        <tr><td><?php echo JText::_( 'Thumbnail CSS Style' ); ?></td><td>:</td><td>AVAILABLE IN "PRO" VERSION ONLY</td></tr>
										
                                        <tr><td><?php echo JText::_( 'Show Video Title' ); ?></td><td>:</td><td><input type="radio" name="showtitle" class="inputbox" value="1" <?php echo ($this->row->showtitle==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="showtitle" class="inputbox" value="0" <?php echo ($this->row->showtitle==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?>
						<br>
						<span style="color: red;">php 5.x and [allow_url_fopen=on] record in php.ini file are required.</span></td></tr>
                                        <tr><td><?php echo JText::_( 'Line CSS Style' ); ?></td><td>:</td><td>AVAILABLE IN "PRO" VERSION ONLY</td></tr>
                                </tbody>
                        </table>
                </div>
		
			
                <?php //Misc ?><h4>Misc</h4>
                <div style="border: 1px dotted #000000;padding:10px;margin:0px;">
                        <table style="border:none;">
                                <tbody>
                                        <tr><td><?php echo JText::_( 'Pagination Limit' ); ?></td><td>:</td><td><input type="text" name="customlimit" id="customlimit" class="inputbox" size="10" value="<?php echo (int)$this->row->customlimit; ?>" />
						Custom limit of items (thumbnails) per page, if not set or 0 the Joomla default will be used.</td></tr>
                                        <tr><td><?php echo JText::_( 'Randomization' ); ?></td><td>:</td><td><input type="radio" name="randomization" class="inputbox" value="1" <?php echo ($this->row->randomization==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="randomization" class="inputbox" value="0" <?php echo ($this->row->randomization==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?>
						<br>Mix the video list</td></tr>
                                        <tr><td><?php echo JText::_( 'Open in a New Window' ); ?></td><td>:</td><td><input type="radio" name="openinnewwindow" class="inputbox" value="1" <?php echo ($this->row->openinnewwindow==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="openinnewwindow" class="inputbox" value="0" <?php echo ($this->row->openinnewwindow==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?>
						<br>Play first video will be ignored in this case.</td></tr>
                                        <tr><td><?php echo JText::_( 'Rel Option' ); ?></td><td>:</td><td><input type="text" name="rel" id="rel" class="inputbox" size="100" value="<?php echo $this->row->rel; ?>" />
						<br>rel option to apply any shadow/lightbox
						<br>the page will be opened without a template and without video navigation bar. Video player only. example: lightbox</td></tr>
                                        <tr><td><?php echo JText::_( 'HREF addon' ); ?></td><td>:</td><td><input type="text" name="hrefaddon" id="hrefaddon" class="inputbox" size="100" value="<?php echo $this->row->hrefaddon; ?>" />
						<br>this will be added to all links to the video (some shadowbox plugin use this)</td></tr>
                                        <tr><td><?php echo JText::_( 'Use glass cover' ); ?></td><td>:</td><td><input type="radio" name="useglass" class="inputbox" value="1" <?php echo ($this->row->useglass==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="useglass" class="inputbox" value="0" <?php echo ($this->row->useglass==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?>
						<br>This Glass cover (transparent div tag) to prevent clicking on a video and leaving the website.</td></tr>
                                        <tr><td><?php echo JText::_( 'Logo Cover' ); ?></td><td>:</td><td>	<input type="text" name="logocover" id="logocover" class="inputbox" size="100" value="<?php echo $this->row->logocover; ?>" />
						<br>An image to place over the Youtube logo (your responsability)</td></tr>
                        
						<?php /*
						<tr><td><?php echo JText::_( 'Enable Cache' ); ?></td><td>:</td><td><input type="radio" name="enablecache" class="inputbox" value="1" <?php echo ($this->row->enablecache==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="enablecache" class="inputbox" value="0" <?php echo ($this->row->enablecache==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?>
						<br>This will increase page load speed a lot. Every time you save this page (gallery setting), the cache will be updated.</td></tr>
						*/?>
						
						
						<tr><td><?php echo JText::_( 'Cache Update Period' ); ?></td><td>:</td><td>
										
										<?php
							$periods=array();
							$periods[]=array('vlu'=>0, 'text'=>'Every Day');
							$periods[]=array('vlu'=>3, 'text'=>'Every 3 Days');
							$periods[]=array('vlu'=>7, 'text'=>'Every Week');
							$periods[]=array('vlu'=>10, 'text'=>'Every 10 Days');
							$periods[]=array('vlu'=>30, 'text'=>'Every Month');
							$periods[]=array('vlu'=>365, 'text'=>'Every Year');
							
							
							echo JHTML::_('select.genericlist',  $periods, 'updateperiod', 'class="inputbox"', 'vlu', 'text', $this->row->updateperiod); ?>
										
						</td></tr>

                        <tr><td><?php echo JText::_( 'Prepare Head Tags' ); ?></td><td>:</td><td><input type="radio" name="prepareheadtags" class="inputbox" value="1" <?php echo ($this->row->prepareheadtags==1 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'YES' ); ?>
						<input type="radio" name="prepareheadtags" class="inputbox" value="0" <?php echo ($this->row->prepareheadtags==0 ? 'checked="checked"' : '' ) ?> /> <?php echo JText::_( 'NO' ); ?>
						<br>Set Page Title to Current Video Title and add list of images (to let Facebook know what image to show when you share the link) to the header.</td></tr>

                                </tbody>
                        </table>
                </div>

        </fieldset>
        <div>
                <input type="hidden" name="task" value="galleryform.edit" />
				<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>
