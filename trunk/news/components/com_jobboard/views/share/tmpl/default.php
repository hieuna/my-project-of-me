<?php
/**
 * @package JobBoard
 * @copyright Copyright (c)2010 Tandolin
 * @license GNU General Public License version 2, or later
 */

    defined('_JEXEC') or die('Restricted access');
    if($this->config->send_tofriend == 0) die(JText::_('SHARING_NOT_ALLOWED'));
    $itemid = JRequest::getVar('Itemid', '');
?>
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
<?php $layout = JRequest::getVar('lyt', ''); ?>
<?php $this->errors = JRequest::getVar('errors', '');?>
<?php if($this->errors > 0) : ?>
   <?php $app= JFactory::getApplication(); ?>
   <?php $afields = $app->getUserState('sfields');   ?> 
<?php endif; ?>
<?php $req_marker = '*'; ?>
<?php $path = 'index.php?option=com_jobboard&view=job&task=share'; ?>
<form method="post" action="<?php echo JRoute::_($path); ?>" id="shareFRM" name="shareFRM" enctype="multipart/form-data">
  <div id="aplpwrapper">
    <h3><?php echo JText::_('EMAIL_JOB_POSTING'); ?></h3>
    <div <?php if($this->config->sharing_job_summary == 1) echo 'id="contleft"'; ?>>
        <fieldset>
          <legend><?php echo JText::_('YOUR_DETAILS'); ?></legend>
          <div class="controw">
            <label for="sender_email"><?php echo JText::_('YOUR_EMAIL'); ?><span class="fieldreq"><?php echo $req_marker; ?></span></label>
            <input class="inputfield " maxlength="60" id="sender_email" name="sender_email" size="50" value="<?php echo ($this->errors > 0)? $afields->sender_email: ''; ?>" type="text" />
          </div>
          <div class="controw">
            <label for="sender_name"><?php echo JText::_('YOUR_FULL_NAME'); ?><span class="fieldreq"><?php echo $req_marker; ?></span></label>
            <input class="inputfield " maxlength="60" id="sender_name" name="sender_name" size="50" value="<?php echo ($this->errors > 0)? $afields->sender_name: ''; ?>" type="text" />
          </div>
         <div class="rowsep">&nbsp;</div>
        <legend><?php echo JText::_('YOUR_MESSAGE'); ?></legend>
          <div class="controw">
            <label for="rec_emails"><?php echo JText::_('TO_EMAIL_ADDRESSES'); ?><span class="fieldreq"><?php echo $req_marker; ?></span></label>
            <br />
            <small><?php echo JText::_('COMMA_SEPARATE_MULTIPLE_ADDRESSES'); ?></small>
            <textarea class="inputfield " cols="53" rows="4" id="rec_emails" name="rec_emails"><?php echo ($this->errors > 0)? $afields->rec_emails: ''; ?></textarea>
          </div>
          <div class="controw" style="padding-top: 15px">
            <label for="personal_message"><?php echo JText::_('ENTER_BRIEF_MESSAGE'); ?></label>
            <textarea class="inputfield " style="padding:-top:5px" cols="53" rows="4" id="personal_message" name="personal_message"><?php echo ($this->errors > 0)? $afields->personal_message: $this->msg; ?></textarea>
          </div>
        </fieldset>
        <div align="center" style="clear: both; padding-top: 15px">
            <input name="sendsubmit" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo JText::_('SEND_MESSAGE') ?>&nbsp;&nbsp;&nbsp;&nbsp;" class="button" type="submit">
                      <?php $sel_job='index.php?option=com_jobboard&view=job&id='.$this->id.'&catid='.$this->catid.'&lyt='.$layout.'&Itemid='.$itemid; ?>
                      &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo JRoute::_($sel_job); ?>"><?php echo JText::_('CANCEL'); ?></a>
        </div>
   </div>
   <?php if($this->config->sharing_job_summary == 1) :?>
      <div id="contright">
         <small>
           <h3><?php echo JText::_('JOB_SUMMARY'); ?></h3>
           <div class="jsrow">
              <?php echo '<span class="summtitle">'.JText::_('JOB_TITLE').':</span><br />'.$this->data->job_title; ?>
           </div>
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
           <div class="jsrow <?php if($this->data->expiry_date == "0000-00-00 00:00:00") echo "lrow"; ?>">
              <?php $this_salary = (strlen($this->data->salary) < 1)? JText::_('NEGOTIABLE') : $this->data->salary; ?>
              <?php echo '<span class="summtitle">'.JText::_('SALARY').':</span><br /><b>'.$this_salary.'</b>'; ?>
           </div>
	       <?php if($this->data->expiry_date <> "0000-00-00 00:00:00"):?>
		       <div class="jsrow lrow">
		   		  <?php $exp_date = new JDate($this->data->expiry_date); ?>
		          	<?php echo '<span class="summtitle">'.JText::_('APPLY_BEFORE').':</span><br /><b>'; ?>
			   		  <?php switch($this->config->long_date_format) {
			   		  	case 0: echo $exp_date->toFormat("%d %b, %Y").'</b>';break;
			   		  	case 1: echo $exp_date->toFormat("%b %d, %Y").'</b>';break;
			   		  	case 2: echo $exp_date->toFormat("%Y, %b %d").'</b>';break; ?>					          	
		       	  <?php } ?> 
		       </div>
	       <?php endif; ?>
         </small>
      </div>
     <?php endif; ?>
   </div>
  <input name="job_id" value="<?php echo $this->id; ?>" type="hidden">
  <input name="catid" value="<?php echo $this->catid; ?>" type="hidden">
  <input name="job_title" value="<?php echo $this->data->job_title; ?>" type="hidden">
  <?php if($this->config->use_location == 1) : ?>
  	<?php $location_string = ($this->data->country_name <> 'DB_ANYWHERE_CNAME')? $this->data->city : JText::_('WORK_ANYWHERE'); ?>
  	<input name="job_city" value="<?php echo $location_string; ?>" type="hidden"> 
  <?php else : ?> 
  	<input name="job_city" value="" type="hidden">
  <?php endif; ?>
  <input name="job_path" value="<?php echo JUri::Base().($sel_job); ?>" type="hidden">
  <?php echo JHTML::_('form.token'); ?>
 </form>
 <?php echo $this->setstate; ?>

