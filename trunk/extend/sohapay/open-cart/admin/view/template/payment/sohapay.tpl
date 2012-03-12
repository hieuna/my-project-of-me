<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form" width="100%">
         <tr>
          <td><span class="required">*</span><strong><?php echo $entry_receiver; ?></strong></td>
          <td><input name="sohapay_receiver" size="50" type="text" value="<?php echo $sohapay_receiver; ?>"/>
            <?php if ($error_receiver) { ?>
            <span class="error"><?php echo $error_receiver; ?></span>
            <?php } ?>
          </td>
        </tr>  
        <tr>
        	<td><span class="required">*</span><strong><?php echo $entry_site_code; ?></strong></td>
        	<td><input name="sohapay_site_code" size="50" type="text" value="<?php echo $sohapay_site_code; ?>"/>
            <?php if ($error_site_code) { ?>
            <span class="error"><?php echo $error_site_code; ?></span>
            <?php } ?>
          </td>
        </tr>
        <tr>
        	<td><span class="required">*</span><strong><?php echo $entry_secure_secret; ?></strong></td>
        	<td><input name="sohapay_secure_secret" size="50" type="text" value="<?php echo $sohapay_secure_secret; ?>"/>
            <?php if ($error_secure_secret) { ?>
            <span class="error"><?php echo $error_secure_secret; ?></span>
            <?php } ?>
          </td>
        </tr>
        <tr>
        	<td><span class="required">*</span><strong><?php echo $entry_return_url; ?></strong></td>
        	<td><input name="sohapay_return_url" size="50" type="text" value="<?php echo $sohapay_return_url; ?>"/>
            <?php if ($error_return_url) { ?>
            <span class="error"><?php echo $error_return_url; ?></span>
            <?php } ?>
          </td>
        </tr>  
        <tr>
          <td><strong><?php echo $entry_order_status; ?></strong></td>
          <td><select name="sohapay_order_status_id">
              <?php foreach ($order_statuses as $order_status) { ?>
              <?php if ($order_status['order_status_id'] == $sohapay_order_status_id) { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
        </tr>
        <tr>
          <td><strong><?php echo $entry_status; ?></strong></td>
          <td><select name="sohapay_status">
              <?php if ($sohapay_status) { ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select></td>
        </tr>
        <tr>
          <td><strong><?php echo $entry_sort_order; ?></strong></td>
          <td><input type="text" name="sohapay_sort_order" value="<?php echo $sohapay_sort_order; ?>" size="1" /></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
<?php echo $footer; ?>