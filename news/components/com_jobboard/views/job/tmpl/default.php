<?php
/**
 * @package JobBoard
 * @copyright Copyright (c)2010 Tandolin
 * @license GNU General Public License version 2, or later
 */

defined('_JEXEC') or die('Restricted access');
?>
<?php $layout = JRequest::getVar('lyt', ''); ?>
<?php $this->catid = (!is_int($this->catid) || $this->catid <1)? 1 : $this->catid; ?>
<?php $applink = 'index.php?option=com_jobboard&view=apply&job_id='.$this->id.'&catid='.$this->catid.'&lyt='.$layout; ?>
<?php $back = 'index.php?option=com_jobboard&view=list&catid='.$this->catid.'&layout='.$layout; ?>
<?php $share = 'index.php?option=com_jobboard&view=share&job_id='.$this->id.'&catid='.$this->catid.'&lyt='.$layout; ?>

<?php $registry =& JFactory::getConfig(); ?>
<?php $sitename = $registry->getValue( 'config.sitename' ); ?>

<?php $uri = JRoute::_('http://' . urlencode($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']));    ?>

<?php $job_opng = JText::_('JOB_OPENING').': '; ?>
<?php $title_prefix = urlencode($job_opng);    ?>
<?php $LinkedIn_long = 'http://www.linkedin.com/shareArticle?mini=true&url='.$uri.'&title='.$title_prefix.$this->data->job_title.'&source='.$sitename; ?>
<?php $Twitter_long = 'http://twitter.com/home?status='.$title_prefix.$this->data->job_title.' - '.$uri; ?>
<?php $FB_long = 'http://www.facebook.com/sharer.php?u='.$uri.'&t='.$title_prefix.$this->data->job_title.'&src='.$sitename; ?>

<?php if(strlen($this->data->description) > 250) : ?>
<?php $article_summary = substr($this->data->description, 0, 250) . '...'; ?>
<?php else : $article_summary = '';  ?>
<?php endif; ?>
<?php $return = JText::_("RETURN_TO_LIST"); ?>

<!--  set job type css class -->
<?php function setJobType($jt) {?>
	<?php switch($jt){
		 case 'DB_JFULLTIME' : 
			 return 'full-time';
		 break;
		 case 'DB_JPARTTIME' : 
			return 'part-time';
		 break;
		 case 'DB_JCONTRACT' : 
			return 'contract';
		 break;
		 case 'DB_JTEMP' : 
			return 'temporary';
		 break;
		 case 'DB_JINTERN' : 
			return 'internship';
		 break;
		 case 'DB_JOTHER' : 
			return 'other';
		 break;
	?>
	<?php }?>
<?php }?>
<?php if($this->config->jobtype_coloring == 1) :?>
	<?php $jt_color = '<span class="jobtype '.setJobType($this->data->job_type).'">'.JText::_($this->data->job_type).'</span>';?>
<?php else : ?>
	<?php $jt_color = JText::_($this->data->job_type);?>
<?php endif; ?>
<!-- end job coloring -->

<div id="jobcont">
 <?php if($this->config->show_job_summary == 1) :?>
  <div id="jobsumm">
     <small>
       <h3><?php echo JText::_('JOB_SUMMARY'); ?></h3>
	   <?php if($this->config->use_location == 1) : ?>
       <div class="jsrow">
           <?php $location_string = ($this->data->country_name <> 'DB_ANYWHERE_CNAME')? $this->data->city.', '.$this->data->country_name.', '.$this->data->country_region : JText::_('WORK_FROM_ANYWHERE'); ?>
           <?php echo '<span class="summtitle">'.JText::_('LOCATION').':</span><br />'.$location_string; ?>
       </div>
       <?php endif; ?>
       <div class="jsrow">
          <?php echo '<span class="summtitle">'.JText::_('CAREER_LEVEL').':</span><br />'.$this->data->job_level; ?>
       </div>
       <div class="jsrow">
          <?php echo '<span class="summtitle">'.JText::_('EDUCATION').':</span><br />'.$this->data->education; ?>
       </div>
       <div class="jsrow">
          <?php echo '<span class="summtitle">'.JText::_('JOB_TYPE').':</span><br />'.$jt_color; ?>
       </div>
       <div class="jsrow">
          <?php echo '<span class="summtitle">'.JText::_('POSITIONS').':</span><br />'.$this->data->positions; ?>
       </div>
       <div class="jsrow">
          <?php $this_salary = (strlen($this->data->salary) < 1)? JText::_('NEGOTIABLE') : $this->data->salary; ?>
          <?php echo '<span class="summtitle">'.JText::_('SALARY').':</span><br /><b>'.$this_salary.'</b>'; ?>
       </div>
       <?php if($this->data->expiry_date <> "0000-00-00 00:00:00"):?>
	       <div class="jsrow">
	       	  <?php $exp_date = new JDate($this->data->expiry_date); ?>
			  <?php echo '<span class="summtitle">'.JText::_('APPLY_BEFORE').':</span><br /><b>'; ?>
				<?php switch($this->config->long_date_format) {
					case 0: echo $exp_date->toFormat("%d %b, %Y").'</b>';break;
					case 1: echo $exp_date->toFormat("%b %d, %Y").'</b>';break;
					case 2: echo $exp_date->toFormat("%Y, %b %d").'</b>';break; ?>					          	
				<?php } ?> 
	       </div>
       <?php endif; ?>
       <div align="center" style="padding: 5px; margin-top: 5px">
       	<?php if($this->config->allow_applications == 1) :?>
          <a href="<?php echo JRoute::_($applink); ?>"> <div class="button applbut">&nbsp;&nbsp;<?php echo JText::_('APPLY_NOW'); ?>&nbsp;&nbsp;</div></a>
        <?php endif; ?>
        <?php if($this->config->send_tofriend == 1) :?>
          <a href="<?php echo JRoute::_($share); ?>">
            <div class="button applbut"><?php echo JText::_('EMAIL_TO_A_FRIEND'); ?></div>
         </a>
        <?php endif; ?>
         <br />
          <small><a href="<?php echo JRoute::_($back) ?>"><b>&#171;&nbsp;</b><?php echo $return; ?></a></small>
       </div>
     </small>
  </div>
  <?php endif; ?>
  <div <?php if($this->config->show_job_summary == 1) echo 'id="jobdet"'; ?>>
    <h3><?php echo $this->data->job_title; ?></h3>
    <div style="width: 100%">
    <?php if($this->config->show_viewcount == 1 || $this->config->show_applcount == 1) :?>
      <div id="hitsumm">
        <small>
        	<?php if($this->config->show_applcount == 1) :?>
	            <?php if($this->data->num_applications == 1) : ?>
	              <?php echo '<b>*</b> '.JText::_('THERE_HAS_BEEN'). ' <span class="hit">'. $this->data->num_applications . '</span>  '. JText::_('APPLICATION_FOR_THIS_POSITION'); ?>
	            <?php else : ?>
	              <?php echo '<b>*</b> '.JText::_('THERE_HAVE_BEEN'). ' <span class="hit">'. $this->data->num_applications . '</span>  '. JText::_('APPLICATIONS_FOR_THIS_POSITION'); ?>
	            <?php endif; ?>
            	<br />
            <?php endif; ?>
            <?php if($this->config->show_viewcount == 1) :?>
            	<?php echo '<b>*</b> '.JText::_('THIS_JOB_OPENING_HAS_BEEN_VIEWED'). ' <span class="hit">'. $this->data->hits . '</span>  '. JText::_('TIMES'); ?>
            <?php endif; ?>
        </small>
        <small id="hsback"><a href="<?php echo JRoute::_($back) ?>"><b>&#171;&nbsp;</b><?php echo $return; ?></a></small>
      </div>      
    <?php endif; ?>
      <div style="padding-top: 10px; clear: both; padding-bottom: 15px">
      <?php echo '<b>'.JText::_('ABOUT_THIS_JOB').'</b>'; ?>
      </div>
      <?php echo $this->data->description; ?> <br />
      <?php if(($job_duties = $this->data->duties) <> '' ) : ?>
        <?php echo '<br /><b>'.JText::_('THIS_JOB_DUTIES').'</b>'; ?> <br />
        <?php echo $job_duties; ?> <br />
      <?php endif; ?>
      <?php if(strlen($this->data->job_tags) > 0) : ?>
         <?php $job_keywords = explode(',', $this->data->job_tags); ?>
         <?php $jtag_count = count($job_keywords); ?>
         <?php $jtag_iter = 1; ?>
         <span class="jtlabel"><?php echo '<small>'.JText::_('THIS_JOB_KEYWDS').':&nbsp;</small>';?></span>
         <span class='jtspan'>
         <?php foreach ($job_keywords as $keywd) : ?>
         	<?php $jtag_link = 'index.php?option=com_jobboard&view=taglist&layout='.$layout.'&keysrch='.trim($keywd); ?>
            <?php echo '<small><a href="'.JRoute::_($jtag_link).'">'.$keywd.'</a></small>'; ?>
            <?php if($jtag_iter < $jtag_count) echo ', ';?>
         	<?php $jtag_iter += 1; ?>
         <?php endforeach; ?>
         </span>
      <?php endif; ?>      
      <div align="center" id="divbottom">
      	<?php if($this->config->allow_applications == 1) :?>
         <a href="<?php echo JRoute::_($applink); ?>">
            <div class="button applbut" style="width: 20%">&nbsp;&nbsp;<?php echo JText::_('APPLY_NOW'); ?>&nbsp;&nbsp;</div>
         </a>&nbsp;&nbsp;&nbsp;&nbsp;
         <?php endif; ?>
         <?php if($this->config->show_job_summary == 0 && $this->config->send_tofriend == 1) : ?>
         	<a href="<?php echo JRoute::_($share); ?>"><small><?php echo JText::_('EMAIL_TO_A_FRIEND'); ?></small></a>&nbsp;&nbsp;
         <?php endif; ?>         
         <div class="lsretrn">         	
         	<small><a href="<?php echo JRoute::_($back) ?>"><b>&#171;&nbsp;</b><?php echo $return; ?></a></small>
         </div>
         <?php if($this->config->show_social == 1) :?>
            <?php if($this->config->social_icon_style == 1) :?> 
	            <div id="socialbtns">
		           	<div id="jblishare">
			         	<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script>
			         	<script type="in/share" data-url="<?php echo $LinkedIn_long; ?>" data-counter="top"></script>
		           	</div>
		            <div id="jbtweet">
			            <a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo $Twitter_long; ?>" data-count="vertical"><?php echo JText::_('TWITTER_SHARE') ?></a>
			            <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		            </div>
		            <div>
			            <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
			            <fb:like href="<?php echo $FB_long; ?>" layout="box_count" show_faces="false" width="90"></fb:like>
		            </div>
	            </div>
            <?php endif; ?>
            <!-- old share buttons -->
            <?php if($this->config->social_icon_style == 0) :?>
	            <a target="_blank" href="<?php echo $LinkedIn_long; ?>" title="<?php echo JText::_('LINKEDIN_SHARE') ?>"><div id="linkedin">&nbsp;</div></a> 
	            <a target="_blank" href="<?php echo $Twitter_long; ?>" title="<?php echo JText::_('TWITTER_SHARE') ?>"><div id="twitter">&nbsp;</div></a> 
	            <a target="_blank" href="<?php echo $FB_long; ?>" title="<?php echo JText::_('FACEBOOK_SHARE') ?>"><div id="facebook">&nbsp;</div></a> 
	        <?php endif; ?>
         <?php endif; ?>
      </div>
    </div>
  </div>
</div>
 <?php echo $this->setstate; ?>