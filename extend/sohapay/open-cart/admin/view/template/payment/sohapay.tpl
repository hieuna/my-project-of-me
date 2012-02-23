<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background: url('view/image/payment.png') no-repeat left center; padding-left: 30px;"><?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
    
      
        <tr>
          <td><span class="required">*</span> <?php echo $entry_merchant; ?></td>
          <td><input type="text" name="sohapay_site_code" value="<?php echo $sohapay_site_code; ?>" />
            <?php if ($error_merchant) { ?>
            <span class="error"><?php echo $error_merchant; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_security; ?></td>
          <td><input type="text" name="sohapay_secure_secret" value="<?php echo $sohapay_secure_secret; ?>" />
            <?php if ($error_security) { ?>
            <span class="error"><?php echo $error_security; ?></span>
            <?php } ?></td>
        </tr>
         <tr>
          <td><?php echo $entry_receiver; ?></td>
          <td><input name="sohapay_receiver" type="text" cols="40" value="<?php echo $sohapay_receiver; ?>"/></td>
        </tr>
        <tr>
          <td><?php echo $entry_callback; ?></td>
          <td><textarea cols="40" rows="5"><?php echo $callback; ?></textarea></td>
        </tr>
        <tr>
          <td><?php echo $entry_order_status; ?></td>
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
          <td><?php echo $entry_status; ?></td>
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
          <td><?php echo $entry_sort_order; ?></td>
          <td><input type="text" name="sohapay_sort_order" value="<?php echo $sohapay_sort_order; ?>" size="1" /></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php echo $footer; ?>