<?php 
/** ensure this file is being included by a parent file */ 
defined( '_JEXEC' ) or die( 'Restricted access' );

class HTML_ngrabnews { 

    function editGrab_lic( $row, $option, $act, $task, $button, $licStatus ) {
        ?>
        <script language="javascript" type="text/javascript">
        <!--

        function submitbutton(pressbutton) {
            var form = document.adminForm;
            if (pressbutton == 'cancel') {
                submitform( pressbutton );
                return;
            }
            // do field validation
            if (form.serial_number.value == "") {
                return alert( "<?php echo JText::_('GN_ADM_LIC_serial_number_ERROR');?>" );
			}else if (form.license_key.value == "") {
                return alert( "<?php echo JText::_('GN_ADM_LIC_license_key_ERROR');?>" );
           } else {
                submitform( pressbutton );
            }
        }
        //-->
        </script>

	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%" class="sectionname"><img src="components/com_ngrabnews/images/logo.png" alt="Nh3 Logo" /></td>
		</tr>
	</table>


        <form action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
        <table class="adminform admintable" style="border: 1px solid rgb(233, 233, 233);">
        <tr>
            <td class="key"><?php echo JText::_('GN_ADM_LIC_STATUS');?>:</td>
			<td>
			<?php
				$stylebgcolor = ($licStatus==1) ? 'background-color: #008000' : 'background-color: #990000';
				$lictype = $row->lictype ? 'Free' : 'Paid';
			?>
			<font color="#FFFFFF"><span style="padding:3px; <?php echo $stylebgcolor; ?>"><?php echo ($licStatus==1) ? 'License to ' .$row->licname .' (' .$lictype .')' : JText::_('GN_ADM_LIC_INVALID');?></span></font>
			</td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_LIC_serial_number');?>:</strong></td>
            <td>
			<?php if ($licStatus==1) { ?>
				<?php echo $row->serial_number; ?>
				<input type="hidden" name="serial_number" value="<?php echo $row->serial_number; ?>" />
			<?php } else { ?>
            	<input class="inputbox" type="text" name="serial_number" size="40" valign="top" value="<?php echo $row->serial_number; ?>" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
			<?php } ?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_LIC_license_key');?>:</strong></td>
            <td>
			<?php if ($licStatus==1) { ?>
				<?php echo $row->license_key; ?>
				<input type="hidden" name="license_key" value="<?php echo $row->license_key; ?>" />
			<?php } else { ?>
            	<input class="inputbox" type="text" name="license_key" size="40" valign="top" value="<?php echo $row->license_key; ?>" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
			<?php } ?>
            </td>
        </tr>
        <tr>
            <td class="key"><?php echo JText::_('Your Limit');?>:</td>
			<td>
			<?php echo $row->limitfilter;?>
			</td>
        </tr>

        <tr>
            <td class="key">&nbsp;</td>
            <td><input type="button" name="B2" value="<?php echo $button; ?>" onclick="javascript:submitbutton('<?php echo $task;?>');" /></td>
        </tr>
		
        </table>

        <input type="hidden" name="option" value="<?php echo $option; ?>" />
    	<input type="hidden" name="act" value="<?php echo $act;?>" />
        <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
        <input type="hidden" name="task" value="<?php echo $task;?>" />
        </form>
        <?php
    }



//############## Grab Filter #######################
function listGrab_filter( $option, &$rows, &$pageNav, &$lists, $Itemid, $act ) {

    ?>

<form action="index.php" method="post" name="adminForm">

<table cellpadding="4" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%" class="sectionname"><img src="components/com_ngrabnews/images/logo.png" alt="Nh3 Logo" /></td>
	</tr>
</table>

<table cellpadding="4" cellspacing="0" class="adminlist">
	<thead>
    <tr>
		<th width="20">#</th>
		<th width="30" align="left"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
        <th align='left'><?php echo JText::_('GN_ADM_FILLTER_filter_name');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_FILLTER_user_id');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_FILLTER_id');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_FILLTER_TEST');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_CDATE');?></th>
        <th style="text-align:center" width='60'><?php echo JText::_('GN_ADM_DELL');?></th>
    </tr>
    </thead>

	<tfoot>
		<tr>
			<td colspan="8">
				<?php echo $pageNav->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>

    <?php
        $k = 0;
        for ($i=0, $n=count( $rows ); $i < $n; $i++) {
        $row = &$rows[$i];

			$row->id 	= $row->cid;
			$link 		= 'index.php?option=com_ngrabnews&act=filter&task=edit&hidemainmenu=1&cid[]='. $row->id;
    ?>

    <tr class="<?php echo "row$k"; ?>">
			<td style="text-align:center"><?php echo $i+$pageNav->limitstart+1; ?></td>
			<td width="30">
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onClick="isChecked(this.checked);" />
			</td>

			<td>
					<a href="<?php echo $link; ?>" title="<?php echo JText::_('GN_ADM_EDIT');?>">
					<?php echo $row->filter_name; ?>
					</a>
			</td>

        <td style="text-align:left"><?php echo $row->username;?></td>
        <td style="text-align:left"><?php echo $row->id;?></td>
        <td style="text-align:left">
		<a href="#" onclick="popupWindow('index3.php?option=com_ngrabnews&amp;act=filter&amp;task=test&amp;cid[]=<?php echo $row->id?>','win1',800,500,'yes');"><?php echo JText::_('GN_ADM_FILLTER_TEST_RUN');?></a>
		</td>
        <td style="text-align:left"><?php echo $row->created;?></td>

        <td style="text-align:center" width="60"><a href = "javascript:if (confirm('<?php echo JText::_('GN_ADM_DELL_CONFIRM');?>')){ location.href='index.php?option=com_ngrabnews&amp;act=filter&amp;task=remove&amp;cid[]=<?php echo $row->id?>';}" title="<?php echo JText::_('GN_ADM_DELL');?>"><strong><?php echo JText::_('GN_ADM_DELL');?></strong></a></td>


            <?php $k = 1 - $k; ?>
        </tr>
            <?php } ?>
	</tbody>
    </table>

    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="act" value="<?php echo $act;?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="hidemainmenu" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<?php

}

    function editGrab_filter( $row, $option, $lists, $list, $act ) {
        ?>
        <script language="javascript" type="text/javascript">
        <!--

        function submitbutton(pressbutton) {
            var form = document.adminForm;
            if (pressbutton == 'cancel') {
                submitform( pressbutton );
                return;
            }
            // do field validation
            if (form.filter_name.value == "") {
                return alert( "<?php echo JText::_('GN_ADM_FILLTER_filter_name_ERROR');?>" );
			} else if (form.filter_spec.value == "") {
                return alert( "<?php echo JText::_('GN_ADM_FILLTER_filter_spec_ERROR');?>" );
           } else {
                submitform( pressbutton );
            }
        }
        //-->
        </script>

        <form action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
        <table class="adminform admintable" style="border: 1px solid rgb(233, 233, 233);">
            <td class="key"></td>
            <td>
			<?php echo JText::_('GN_ADM_FILLTER_TITLE');?>: <?php echo $row->id ? JText::_('GN_ADM_EDIT') : JText::_('GN_ADM_ADD');?>
            </td>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_FILLTER_filter_name');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="filter_name" size="50" valign="top" value="<?php echo $row->filter_name; ?>" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_FILLTER_filter_spec');?>:</strong></td>
            <td>
			<textarea name="filter_spec" rows="20" cols="80"><?php echo $row->filter_spec; ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="key">&nbsp;</td>
            <td>
				If your source HTML looks something like this:
				<font color="blue"><blockquote><pre>
				&lt;p&gt;My favourite ASCII characters are #, $, @, | and \&lt;/p&gt;
				</pre></blockquote></font>

				Then your detail should escape the special characters:
				<font color="red"><blockquote><pre>
				&lt;p&gt;My favourite ASCII characters are \#, \$, \@, \| and \\&lt;/p&gt;
				</pre></blockquote></font>			
            </td>
        </tr>
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_FILLTER_filter_inc_top');?>:</strong></td>
            <td>
			<textarea name="inc_top" rows="8" cols="80"><?php echo htmlentities($row->inc_top); ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_FILLTER_filter_inc_bot');?>:</strong></td>
            <td>
			<textarea name="inc_bot" rows="8" cols="80"><?php echo htmlentities($row->inc_bot); ?></textarea>
            </td>
        </tr>
		
        </table>

        <input type="hidden" name="user_id" value="<?php echo $row->user_id; ?>" />
        <input type="hidden" name="option" value="<?php echo $option; ?>" />
    	<input type="hidden" name="act" value="<?php echo $act;?>" />
        <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
        <input type="hidden" name="task" value="" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php JHTML::_('behavior.keepalive'); ?>		
        </form>
        <?php
    }

    function testGrab_filter( $results, $row, $realUrl ) {
  	$rows = array ();
  	$rowcount = 0;
  	$rowfieldcount = 0;
	echo $row->inc_top;
	//echo $realUrl;
        ?>

	<table cellpadding="4" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="100%"><span class="sectionname"><?php echo JText::_('GN_ADM_FILLTER_TEST');?>:
            </span>
            </td>
		</tr>
	</table>
	<?php
    echo '<table cellspacing="0" cellpadding="2" border="1" width="100%">
';
    echo '<tr>
';
  $m = 0;
  while ($m < count ($results[0]['fields']))
  {
   echo '<td>' . $results[0]['fields'][$m]['name'] . '</td>';
    ++$m;
  }
	
  $m = 0;
  while ($m < count ($results[0]['patternfields']))
  {
    if (0 < strlen ($results[0]['patternfields'][$m]['name']))
    {
       echo '<td>' . htmlspecialchars($results[0]['patternfields'][$m]['name']) . '</td>';
    }

    ++$m;
  }
  echo '</tr>';
	
  echo '
';
  $z = 0;
  while ($z < count ($results))
  {
    echo '<tr>';

    echo '
';
    $rowfieldcount = 0;
    $m = 0;
    while ($m < count ($results[$z]['fields']))
    {
        echo '<td><pre>';

      echo htmlspecialchars ($results[$z]['fields'][$m]['value']);
      echo '</pre></td>';
      ++$m;
    }

    $m = 0;
    while ($m < count ($results[$z]['patternfields']))
    {
      if (0 < strlen ($results[$z]['patternfields'][$m]['name']))
      {
          echo '<td><pre>';

        //echo htmlspecialchars ($results[$z]['patternfields'][$m]['value']);
        //echo substr_count($results[0]['patternfields'][$m]['name'],'>') .'<b>fff</b>';
		echo autoFixLink($realUrl,$results[$z]['patternfields'][$m]['value']);
        echo '</pre><br />';
		$taguse =parseTagUse($row->inc_top.$results[$z]['patternfields'][$m]['value'].$row->inc_bot);
        echo $taguse ? 'New Tag Found: <textarea rows="2" name="S1" cols="50" wrap=off>'.$taguse.'</textarea>' : '';
		echo '</td>';
      }

      ++$m;
    }

    echo '</tr>';

    echo '
';
    ++$rowcount;
    ++$z;
  }	
	
    echo '</table><br>';
	
	echo $row->inc_bot;
	?>	
    
	<?php
    }

//############## Begin Cron manager #######################
function listGrab_cron( $option, &$rows, &$pageNav, &$lists, $Itemid, $act ) {
$database =& JFactory::getDBO();
    ?>
<script type="text/javascript">
function blink(id) {
  if(document.getElementById(id).style.backgroundColor != "red") {
    document.getElementById(id).style.backgroundColor = "red";
  } else {
    document.getElementById(id).style.backgroundColor = "white";
  }
}
</script>
<form action="index.php" method="post" name="adminForm">

<table cellpadding="4" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="80%" class="sectionname"><img src="components/com_ngrabnews/images/logo.png" alt="NhutCorp Logo" /></td>
	</tr>
</table>

<table cellpadding="4" cellspacing="0" class="adminlist">
	<thead>
    <tr>
		<th width="20">#</th>
		<th width="30" align="left"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
        <th align='left'><?php echo JText::_('GN_ADM_CRON_cron_name');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_CRON_cron_url');?></th>
		<!--
        <th align='left'><?php echo JText::_('GN_ADM_CRON_filter_id');?></th>
		-->
        <th align='left'><?php echo JText::_('GN_ADM_CRON_cat_id');?></th>
		<!--
        <th align='left'><?php echo JText::_('GN_ADM_CRON_field_unique');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_CRON_field_created');?></th>
         <th align='left'><?php echo JText::_('GN_ADM_CRON_field_state');?></th>
		-->
         <th align='left'><?php echo JText::_('GN_ADM_CRON_field_complete');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_CRON_cron_mhdmd');?></th>
       <th align='left'><?php echo JText::_('GN_ADM_CRON_cron_ran');?></th>
       <th style="text-align:center" width='120'><?php echo JText::_('GN_ADM_CRON_COUNT_USAGE');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_PUBLISH');?></th>
        <th style="text-align:center" width='60'><?php echo JText::_('GN_ADM_DELL');?></th>
    </tr>
    </thead>

	<tfoot>
		<tr>
			<td colspan="15">
				<?php echo $pageNav->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>

    <?php
        $k = 0;
        for ($i=0, $n=count( $rows ); $i < $n; $i++) {
        $row = &$rows[$i];
        $field_state   =   $row->field_state ? '<font color="#800000">unpublish</font>' : '<font color="#008000">publish</font>';
        $task   =   $row->published ? 'unpublish' : 'publish';
        $img    =   $row->published ? 'publish_g.png' : 'publish_x.png';
        $alt    =   $row->published ? JText::_('GN_ADM_PUBLISHED') : JText::_('GN_ADM_UNPUBLISHED');

			$row->id 	= $row->id;
			$link 		= 'index.php?option=com_ngrabnews&act=cron&task=edit&hidemainmenu=1&cid[]='. $row->id;

		  # Kiem tra cac cron detail chua chay het
			$query = "SELECT COUNT(*) FROM #__ngrab_usage WHERE is_detail=0 AND cron_id=".$row->id;
			$database->setQuery( $query );
			$total = $database->loadResult();
			if ($total >0) {
				$fstatus = "Pending " .$total ." item(s)..";
				$stylebgcolor = 'background-color: #990000';
				$isfound =true;
			}else{
				//$fstatus = "OK"	;		
				$fstatus = $row->lastsuccess	;		
				$stylebgcolor = 'background-color: #008000';
			}

			?>

    <tr class="<?php echo "row$k"; ?>">
			<td style="text-align:center"><?php echo $i+$pageNav->limitstart+1; ?></td>
			<td width="30">
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onClick="isChecked(this.checked);" />
			</td>

			<td>
					<a href="<?php echo $link; ?>" title="<?php echo JText::_('GN_ADM_EDIT');?>">
					<?php echo $row->cron_name; ?>
					</a><?php echo $row->cron_parent ? '('.$row->cron_parent .')' : ''; ?> 
			</td>
			
        <td style="text-align:left"><?php echo $row->cron_url;?></td>
		<!--
        <td style="text-align:left"><?php echo $row->filter_name;?></td>
		-->
        <td style="text-align:left"><?php echo $row->section;?> &gt; <?php echo $row->category;?></td>
		<!--
        <td style="text-align:left"><?php echo $row->field_unique;?></td>
        <td style="text-align:left"><?php echo $row->username;?></td>
        <td style="text-align:left"><?php echo $row->field_state;?></td>
		-->
        <td style="text-align:center"><font color="#ffffff"><span style="padding:3px; <?php echo $stylebgcolor; ?>"><?php echo $fstatus;?></span></font></td>
        <td style="text-align:left"><?php echo $row->cron_mhdmd;?></td>
        <td style="text-align:left"><?php echo $row->cron_ran;?></td>
        <td style="text-align:center">
				<?php
				if (count_grabusage($row->id) >0) {	 ?>
					<a href="#" onclick="popupWindow('index3.php?option=com_ngrabnews&amp;act=cron&amp;task=view&amp;cid[]=<?php echo $row->id?>','win1',750,440,'yes');"><?php echo JText::_('GN_ADM_CRON_USAGE_VIEW');?>(<?php echo count_grabusage($row->id);?>)</a>
					|
					<a href = "javascript:if (confirm('<?php echo JText::_('GN_ADM_CRON_USAGE_DELETE_CONFIRM');?>')){ location.href='index.php?option=com_ngrabnews&amp;act=cron&amp;task=clear&amp;cid[]=<?php echo $row->id?>';}" title="<?php echo JText::_('GN_ADM_CRON_USAGE_DELETE');?>"><?php echo JText::_('GN_ADM_CRON_USAGE_DELETE');?></a>
				<?php } else { ?>
					&nbsp;
				<?php } ?>
		
		</td>
		
        <td width="50" style="text-align:center" nowrap><a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a></td>

        <td style="text-align:center" width="60"><a href = "javascript:if (confirm('<?php echo JText::_('GN_ADM_DELL_CONFIRM');?>')){ location.href='index.php?option=com_ngrabnews&amp;act=cron&amp;task=remove&amp;cid[]=<?php echo $row->id?>';}" title="<?php echo JText::_('GN_ADM_DELL');?>"><strong><?php echo JText::_('GN_ADM_DELL');?></strong></a></td>


            <?php $k = 1 - $k; ?>
        </tr>
            <?php } ?>
	</tbody>
	
<?php if ($isfound) { ?>
	<tfoot>
		<tr>
			<td colspan="15">
			<span id="flademe">Choose Cron is waiting, and click Run Now button to complete</span>
			</td>
		</tr>
	</tfoot>
	<tbody>

<script type="text/javascript">
var B = setInterval('blink("flademe")',1000);
</script>
<?php } ?>
	
	
	
    </table>


    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="act" value="<?php echo $act;?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="hidemainmenu" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>	

</form>

<?php

}




    function editGrab_cron( &$row, &$sections, &$lists, &$categories, $option, $act ) {
        ?>
        <script language="javascript" type="text/javascript">
        <!--

        function submitbutton(pressbutton) {
            var form = document.adminForm;
            if (pressbutton == 'cancel') {
                submitform( pressbutton );
                return;
            }
			
			// do field validation
			if (form.cron_name.value == "") {
				return alert( "<?php echo JText::_('GN_ADM_CRON_cron_name_ERROR');?>" );
			} else if (form.filter_id.value == "") {
				return alert( "<?php echo JText::_('GN_ADM_CRON_filter_id_ERROR');?>" );
			} else if (form.cron_url.value == "") {
				return alert( "<?php echo JText::_('GN_ADM_CRON_cron_url_ERROR');?>" );
			} else if (form.section_id.value == -1) {
				return alert( "<?php echo JText::_('GN_ADM_CRON_section_id_ERROR');?>" );
			} else if (form.cat_id.value == -1) {
				return alert( "<?php echo JText::_('GN_ADM_CRON_cat_id_ERROR');?>" );
			} else if (form.field_title.value == "") {
				return alert( "<?php echo JText::_('GN_ADM_CRON_field_title_ERROR');?>" );
			} else if (form.field_intro.value == "") {
				return alert( "<?php echo JText::_('GN_ADM_CRON_field_intro_ERROR');?>" );
			} else if (form.field_full.value == "") {
				return alert( "<?php echo JText::_('GN_ADM_CRON_field_full_ERROR');?>" );
			} else if (form.field_unique.value == "") {
				return alert( "<?php echo JText::_('GN_ADM_CRON_field_unique_ERROR');?>" );
			} else if (form.field_created.value == "") {
				return alert( "<?php echo JText::_('GN_ADM_CRON_field_created_ERROR');?>" );
			} else if (form.cron_mhdmd.value == "") {
				return alert( "<?php echo JText::_('GN_ADM_CRON_cron_mhdmd_ERROR');?>" );
			} else {
				submitform( pressbutton );
			}
		
        }
        //-->
        </script>

<script language="javascript" type="text/javascript">
	var sectioncategories = new Array;
<?php
$i = 0;
foreach ($categories as $k=>$items) {
	foreach ($items as $v) {
		echo "sectioncategories[".$i++."] = new Array( '$k','".addslashes( $v->id )."','".addslashes( $v->name )."' );\n";
	}
}
?>
</script>  

<script>
 function update_crontab(){

 document.adminForm.cron_mhdmd.value =   document.adminForm.minute2.value+" "+
                  document.adminForm.hour2.value+" "+
                  document.adminForm.day2.value+" "+
                  document.adminForm.month2.value+" "+
                  document.adminForm.weekday2.value;
 }
</script>

<script>
function popup_preview(idvalue) {
	if (idvalue != "") {
		popupWindow('index3.php?option=com_ngrabnews&amp;act=filter&amp;task=test&amp;cid[]='+idvalue,'win1',750,440,'yes');
	} else {
		return alert ('Please choose filter');
	}
}
</script>

        <form action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
        <table class="adminform admintable" style="border: 1px solid rgb(233, 233, 233);">
        <tr>
            <td class="key"></td>
            <td>
            <?php echo JText::_('GN_ADM_CRON_TITLE');?>:
           <?php echo $row->id ? JText::_('GN_ADM_EDIT') : JText::_('GN_ADM_ADD');?>
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_PUBLISH');?>:</strong></td>
            <td>
            <?php echo $lists['published']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_cron_name');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="cron_name" size="20" valign="top" value="<?php echo $row->cron_name; ?>" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Group Check');?>:</strong></td>
            <td>
            <?php echo $lists['parent']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_filter_id');?>:</strong></td>
            <td>
            <?php echo $lists['filter_id']; ?> <a href="javascript: void(0);" onclick="popup_preview(document.adminForm.filter_id.options[document.adminForm.filter_id.selectedIndex].value);"><img border="0" src="images/downarrow.png" width="12" height="12" align="middle" alt="<?php echo JText::_('GN_ADM_FILLTER_TEST');?>" /></a> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_cron_url');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="cron_url" size="50" valign="top" value="<?php echo $row->cron_url; ?>" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_section_id');?>:</strong></td>
            <td>
            <?php echo $lists['section_id']; ?> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_cat_id');?>:</strong></td>
            <td>
            <?php echo $lists['cat_id']; ?> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_field_title');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="field_title" size="20" valign="top" value="<?php echo $row->field_title; ?>" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_field_intro');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="field_intro" size="20" valign="top" value="<?php echo $row->field_intro; ?>" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_field_full');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="field_full" size="20" valign="top" value="<?php echo $row->field_full; ?>" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_full_filter');?>:</strong></td>
            <td>
            <?php echo $lists['full_filter']; ?> <a href="javascript: void(0);" onclick="popup_preview(document.adminForm.full_filter.options[document.adminForm.full_filter.selectedIndex].value);"><img border="0" src="images/downarrow.png" width="12" height="12" align="middle" alt="<?php echo JText::_('GN_ADM_FILLTER_TEST');?>" /></a> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_field_unique');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="field_unique" size="20" valign="top" value="<?php echo $row->field_unique; ?>" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>
		
        <tr>
            <td class="key"></td>
            <td>
            <strong><?php echo JText::_('Image Intro');?></strong>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Get Detail Image');?>:</strong></td>
            <td>
            <?php echo $lists['extract_img']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_thumb_width');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="thumb_width" size="8" valign="top" value="<?php echo $row->thumb_width; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_thumb_height');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="thumb_height" size="8" valign="top" value="<?php echo $row->thumb_height; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Image Align');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="image_align" size="8" valign="top" value="<?php echo $row->image_align; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Horizontal Spacing');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="image_hspace" size="8" valign="top" value="<?php echo $row->image_hspace; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Vertical Spacing');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="image_vspace" size="8" valign="top" value="<?php echo $row->image_vspace; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Image Border');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="image_border" size="8" valign="top" value="<?php echo $row->image_border; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"></td>
            <td>
            <strong><?php echo JText::_('Image Detail');?></strong>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_detail_width');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="detail_width" size="8" valign="top" value="<?php echo $row->detail_width; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_detail_height');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="detail_height" size="8" valign="top" value="<?php echo $row->detail_height; ?>" />
            </td>
        </tr>

		
        <tr>
            <td class="key"><strong><?php echo JText::_('Image Align');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="detail_align" size="8" valign="top" value="<?php echo $row->detail_align; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Horizontal Spacing');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="detail_hspace" size="8" valign="top" value="<?php echo $row->detail_hspace; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Vertical Spacing');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="detail_vspace" size="8" valign="top" value="<?php echo $row->detail_vspace; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Image Border');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="detail_border" size="8" valign="top" value="<?php echo $row->detail_border; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"></td>
            <td>
            <strong><?php echo JText::_('Article Setting');?></strong>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_field_created');?>:</strong></td>
            <td>
            <?php echo $lists['field_created']; ?> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Show intro');?>:</strong></td>
            <td>
            <?php echo $lists['show_intro']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_field_state');?>:</strong></td>
            <td>
            <?php echo $lists['field_state']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_front_page');?>:</strong></td>
            <td>
            <?php echo $lists['front_page']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_content_source');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="content_source" size="20" valign="top" value="<?php echo $row->content_source; ?>" />
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Auto Fix HTML');?>:</strong></td>
            <td>
            <?php echo $lists['fix_html']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Remove Style');?>:</strong></td>
            <td>
            <?php echo $lists['remove_style']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Remove Internal Link');?>:</strong></td>
            <td>
            <?php echo $lists['remove_link']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key" valign="top"><strong><?php echo JText::_('Tag Allow');?>:</strong></td>
            <td>
			<textarea class="inputbox" rows="7" name="tag_allowed" cols="50"><?php echo $row->tag_allowed; ?></textarea>
			<br />* Add your new tag and defaul tag (preview detail filter to found new tag) or leave blank to use default tag: <br />
			<textarea class="inputbox" rows="7" name="tag_default_allowed" cols="50" readonly><?php echo DEFAULT_TAG_ALLOW; ?></textarea>
			
			</td>
        </tr>
		
        <tr>
            <td class="key"><strong><?php echo JText::_('Auto Keyword');?>:</strong></td>
            <td>
            <?php echo $lists['get_keyword']; ?>
            </td>
        </tr>
		
        <tr>
            <td class="key" valign="top"><strong><?php echo JText::_('Black Keyword');?>:</strong></td>
            <td>
			<textarea class="inputbox" rows="7" name="black_word" cols="50"><?php echo $row->black_word; ?></textarea>
			<br />* Auto remove this form keyword, exp: hack,hot girls,sex
			
			</td>
        </tr>
		
        <tr>
            <td class="key"></td>
            <td>
            <strong><?php echo JText::_('Auto Run Setting');?></strong>
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_RUNAT');?>:</strong></td>
            <td>
             <table>
<tr><td valign='top'>Minute(s):<br>
<select multiple name=minute2 size=10 onchange="update_crontab()">
<option value=*> Every Minute
<option value=*/2> Every Other Minute
<option value=*/5> Every Five Minutes
<option value=*/10> Every Ten Minutes

<option value=*/15> Every Fifteen Minutes
<option value=0> 0
<option value=1> 1
<option value=2> 2
<option value=3> 3
<option value=4> 4
<option value=5> 5
<option value=6> 6
<option value=7> 7

<option value=8> 8
<option value=9> 9
<option value=10> 10
<option value=11> 11
<option value=12> 12
<option value=13> 13
<option value=14> 14
<option value=15> 15
<option value=16> 16

<option value=17> 17
<option value=18> 18
<option value=19> 19
<option value=20> 20
<option value=21> 21
<option value=22> 22
<option value=23> 23
<option value=24> 24
<option value=25> 25

<option value=26> 26
<option value=27> 27
<option value=28> 28
<option value=29> 29
<option value=30> 30
<option value=31> 31
<option value=32> 32
<option value=33> 33
<option value=34> 34

<option value=35> 35
<option value=36> 36
<option value=37> 37
<option value=38> 38
<option value=39> 39
<option value=40> 40
<option value=41> 41
<option value=42> 42
<option value=43> 43

<option value=44> 44
<option value=45> 45
<option value=46> 46
<option value=47> 47
<option value=48> 48
<option value=49> 49
<option value=50> 50
<option value=51> 51
<option value=52> 52

<option value=53> 53
<option value=54> 54
<option value=55> 55
<option value=56> 56
<option value=57> 57
<option value=58> 58
<option value=59> 59
</select><br><br>
</td>

<td valign='top'>Hour(s):<br>
<select multiple name=hour2 size=5  onchange="update_crontab()">
<option value=*> Every Hour
<option value=*/2> Every Other Hour
<option value=*/4> Every Four Hours
<option value=*/6> Every Six Hours
<option value=0> 0 = 12 AM/Midnight
<option value=1> 1 = 1 AM
<option value=2> 2 = 2 AM

<option value=3> 3 = 3 AM
<option value=4> 4 = 4 AM
<option value=5> 5 = 5 AM
<option value=6> 6 = 6 AM
<option value=7> 7 = 7 AM
<option value=8> 8 = 8 AM
<option value=9> 9 = 9 AM
<option value=10> 10 = 10 AM
<option value=11> 11 = 11 AM

<option value=12> 12 = 12 PM/Noon
<option value=13> 13 = 1 PM
<option value=14> 14 = 2 PM
<option value=15> 15 = 3 PM
<option value=16> 16 = 4 PM
<option value=17> 17 = 5 PM
<option value=18> 18 = 6 PM
<option value=19> 19 = 7 PM
<option value=20> 20 = 8 PM

<option value=21> 21 = 9 PM
<option value=22> 22 = 10 PM
<option value=23> 23 = 11 PM
</select>
<br><br>Day(s):<br>
<select multiple name=day2 size=5  onchange="update_crontab()">
<option value=*> Every Day
<option value=1> 1
<option value=2> 2
<option value=3> 3

<option value=4> 4
<option value=5> 5
<option value=6> 6
<option value=7> 7
<option value=8> 8
<option value=9> 9
<option value=10> 10
<option value=11> 11
<option value=12> 12

<option value=13> 13
<option value=14> 14
<option value=15> 15
<option value=16> 16
<option value=17> 17
<option value=18> 18
<option value=19> 19
<option value=20> 20
<option value=21> 21

<option value=22> 22
<option value=23> 23
<option value=24> 24
<option value=25> 25
<option value=26> 26
<option value=27> 27
<option value=28> 28
<option value=29> 29
<option value=30> 30

<option value=31> 31
</select><br><br>
</td><td valign='top'>Months(s):<br>
<select multiple name=month2 size=5  onchange="update_crontab()">
<option value=*> Every Month
<option value=1> January
<option value=2> February
<option value=3> March
<option value=4> April
<option value=5> May

<option value=6> June
<option value=7> July
<option value=8> August
<option value=9> September
<option value=10> October
<option value=11> November
<option value=12> December
</select>
<br><br>Weekday(s):<br>

<select multiple name=weekday2 size=5  onchange="update_crontab()">
<option value=*> Every Weekday
<option value=0> Sunday
<option value=1> Monday
<option value=2> Tuesday
<option value=3> Wednesday
<option value=4> Thursday
<option value=5> Friday
<option value=6> Saturday

</select>
</td></tr>
<script>

var croncount=2;

function updateform2() {

var ccount=2;

<?php
$fs = explode(" ",$row->cron_mhdmd);

echo 'fieldvals=new Array("'.$fs[0].'","'.$fs[1].'","'.$fs[2].'","'.$fs[3].'","'.$fs[4].'");





	if ("'.$fs[0].'" == "") {
		document.adminForm.minute2.options[5].selected = true;
	}
	if ("'.$fs[1].'" == "") {
		document.adminForm.hour2.options[7].selected = true;
	}
	if ("'.$fs[2].'" == "") {
		document.adminForm.day2.options[0].selected = true;
	}
	if ("'.$fs[3].'" == "") {
		document.adminForm.month2.options[0].selected = true;
	}
	if ("'.$fs[4].'" == "") {
		document.adminForm.weekday2.options[0].selected = true;
	}
 ';
 
 
?>

	var ft = fieldvals[0];
	var far = ft.split(",");
	for (t=0;t<document.adminForm.minute2.options.length;t++) {
		for (var loop=0; loop < far.length; loop++)
		{
			if ( document.adminForm.minute2.options[t].value == far[loop]) {
				document.adminForm.minute2.options[t].selected = true;
			}
		}
	}
	var ft = fieldvals[1];
	var far = ft.split(",");
	for (t=0;t<document.adminForm.hour2.options.length;t++) {
		for (var loop=0; loop < far.length; loop++)
		{
			if ( document.adminForm.hour2.options[t].value == far[loop]) {
				document.adminForm.hour2.options[t].selected = true;
			}
		}
	}
	var ft = fieldvals[2];
	var far = ft.split(",");
	for (t=0;t<document.adminForm.day2.options.length;t++) {
		for (var loop=0; loop < far.length; loop++)
		{
			if ( document.adminForm.day2.options[t].value == far[loop]) {
				document.adminForm.day2.options[t].selected = true;
			}
		}
	}
	var ft = fieldvals[3];
	var far = ft.split(",");
	for (t=0;t<document.adminForm.month2.options.length;t++) {
		for (var loop=0; loop < far.length; loop++)
		{
			if ( document.adminForm.month2.options[t].value == far[loop]) {
				document.adminForm.month2.options[t].selected = true;
			}
		}
	}
	var ft = fieldvals[4];
	var far = ft.split(",");
	for (t=0;t<document.adminForm.weekday2.options.length;t++) {
		for (var loop=0; loop < far.length; loop++)
		{
			if ( document.adminForm.weekday2.options[t].value == far[loop]) {
				document.adminForm.weekday2.options[t].selected = true;
			}
		}
	}

}


</script>
</table>

            
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_cron_mhdmd');?>:</strong></td>
            <td>
            <input class="inputbox" type="text" name="cron_mhdmd" size="40" valign="top" value="<?php echo $row->cron_mhdmd; ?>" readonly="1" /> *<?php echo JText::_('GN_ADM_REQUIRED');?>
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CRON_cron_ran');?>:</strong></td>
            <td>
            <?php echo $row->cron_ran; ?>
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_MDATE');?>:</strong></td>
            <td>
            <?php echo $row->mdate; ?>
            </td>
        </tr>

        <tr>
            <td class="key"><strong><?php echo JText::_('GN_ADM_CDATE');?>:</strong></td>
            <td>
            <?php echo $row->cdate; ?>
            </td>
        </tr>

        </table>

        <input type="hidden" name="option" value="<?php echo $option; ?>" />
    	<input type="hidden" name="act" value="<?php echo $act;?>" />
        <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
        <input type="hidden" name="task" value="" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php JHTML::_('behavior.keepalive'); ?>		
        </form>
         <script>
      	 eval ("updateform2()");
         </script>
        <?php
    }

//############## Begin Grab usage #######################
function listGrab_usage( $option, &$rows, &$pageNav, &$lists, $Itemid, $act, $cid ) {

    ?>

<form action="index3.php" method="post" name="adminForm">

<table cellpadding="4" cellspacing="0" class="adminlist">
	<thead>
    <tr>
		<th width="20">#</th>
		<th width="30" align="left"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
        <th align='left'><?php echo JText::_('GN_ADM_CDATE');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_USEAGE_cron_id');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_USEAGE_usage_unique');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_USEAGE_content_id');?></th>
    </tr>
    </thead>

	<tfoot>
		<tr>
			<td colspan="6">
				<?php echo $pageNav->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>

    <?php
        $k = 0;
        for ($i=0, $n=count( $rows ); $i < $n; $i++) {
        $row = &$rows[$i];
			$row->id 	= $row->id;

    ?>

    <tr class="<?php echo "row$k"; ?>">
			<td style="text-align:center"><?php echo $i+$pageNav->limitstart+1; ?></td>
			<td width="30">
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onClick="isChecked(this.checked);" />
			</td>

			<td>
					<?php echo $row->cdate; ?>
			</td>
			
        <td style="text-align:left"><?php echo $row->cron_name;?></td>
        <td style="text-align:left"><?php echo $row->usage_unique;?></td>
        <td style="text-align:left"><a href="#" onclick="window.opener.location='index2.php?option=com_content&amp;task=edit&amp;hidemainmenu=1&amp;id=<?php echo $row->aid?>'; window.close();"><?php echo $row->title;?></a></td>

            <?php $k = 1 - $k; ?>
        </tr>
            <?php } ?>
	</tbody>
    </table>

    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="act" value="<?php echo $act;?>" />
    <input type="hidden" name="task" value="view" />
    <input type="hidden" name="cid[]" value="<?php echo $cid;?>" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="hidemainmenu" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>

</form>

<?php

}


//############## Begin Grab usage #######################
function listGrab_Logs( $option, &$rows, &$pageNav, &$lists, $Itemid, $act) {

    ?>

<form action="index.php" method="post" name="adminForm">

<table cellpadding="4" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="100%" class="sectionname"><img src="components/com_ngrabnews/images/logo.png" alt="Nh3 Logo" /></td>
	</tr>
</table>

<table cellpadding="4" cellspacing="0" class="adminlist">
	<thead>
    <tr>
		<th width="20">#</th>
		<th width="30" align="left"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
        <th align='left'><?php echo JText::_('GN_ADM_CDATE');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_USEAGE_cron_id');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_USEAGE_usage_unique');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_USEAGE_content_id');?></th>
        <th align='left'><?php echo JText::_('GN_ADM_CRON_field_complete');?></th>
    </tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="7">
				<?php echo $pageNav->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>

    <?php
        $k = 0;
        for ($i=0, $n=count( $rows ); $i < $n; $i++) {
        $row = &$rows[$i];
			$row->id 	= $row->id;
			$img    =   $row->is_detail ? 'publish_g.png' : 'publish_x.png';

    ?>

    <tr class="<?php echo "row$k"; ?>">
			<td style="text-align:center"><?php echo $i+$pageNav->limitstart+1; ?></td>
			<td width="30">
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onClick="isChecked(this.checked);" />
			</td>

			<td>
					<?php echo $row->cdate; ?>
			</td>
			
        <td style="text-align:left"><?php echo $row->cron_name;?></td>
        <td style="text-align:left"><?php echo $row->usage_unique;?></td>
        <td style="text-align:left"><a href="index.php?option=com_content&amp;task=edit&amp;hidemainmenu=1&amp;id=<?php echo $row->aid?>"><?php echo $row->title;?></a></td>
        <td width="50" style="text-align:center" nowrap><img src="images/<?php echo $img;?>" width="12" height="12" border="0" /></td>

            <?php $k = 1 - $k; ?>
        </tr>
            <?php } ?>
	</tbody>
    </table>

    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="act" value="<?php echo $act;?>" />
    <input type="hidden" name="task" value="view" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="hidemainmenu" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>

</form>

<?php

}

}

?> 

