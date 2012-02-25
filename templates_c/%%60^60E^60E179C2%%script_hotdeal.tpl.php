<?php /* Smarty version 2.6.10, created on 2012-02-26 01:05:30
         compiled from D:/AppServ/www/projects/templates/shopping/script_hotdeal.tpl */ ?>
<!-- Hotdeals -->
<link href="css/<?php echo $this->_tpl_vars['name_template']; ?>
/hotdeals.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="includes/js/JQuery/jquery.deals.js"></script>
<script type="text/javascript" src="includes/js/JQuery/deals.core.js"></script>
<script type="text/javascript" src="includes/js/JQuery/deals.ajax.js"></script>
<?php echo '
<script type="text/javascript">
//<![CDATA[
var index_script = \'index.php\';
var current_path = \'\';
var changes_warning = \'Y\';

var lang = {
	cannot_buy: \'You cannot buy the product with these option variants \',
	no_products_selected: \'No products selected\',
	error_no_items_selected: \'No items selected! At least one check box must be selected to perform this action.\',
	delete_confirmation: \'Are you sure you want to delete the selected items?\',
	text_out_of_stock: \'Out-of-stock\',
	in_stock: \'In stock\',
	items: \'item(s)\',
	text_required_group_product: \'Please select a product for the required group [group_name]\',
	notice: \'Notice\',
	warning: \'Warning\',
	loading: \'Loading...\',
	none: \'None\',
	text_are_you_sure_to_proceed: \'Are you sure you want to proceed?\',
	text_invalid_url: \'You have entered an invalid URL\',
	text_cart_changed: \'Items in the shopping cart have been changed. Please click on \\"OK\\" to save changes, or on \\"Cancel\\" to leave the items unchanged.\',
	error_validator_email: \'The email address in the <b>[field]<\\/b> field is invalid.\',
	error_validator_confirm_email: \'The email addresses in the <b>[field]<\\/b> field and confirmation fields do not match.\',
	error_validator_phone: \'The phone number in the <b>[field]<\\/b> field is invalid. The correct format is (555) 555-55-55 or 55 55 555 5555.\',
	error_validator_integer: \'The value of the <b>[field]<\\/b> field is invalid. It should be integer.\',
	error_validator_multiple: \'The <b>[field]<\\/b> field does not contain the selected options.\',
	error_validator_password: \'The passwords in the <b>[field2]<\\/b> and <b>[field1]<\\/b> fields do not match.\',
	error_validator_required: \'The <b>[field]<\\/b> field is mandatory.\',
	error_validator_zipcode: \'The ZIP / Postal code in the <b>[field]<\\/b> field is incorrect. The correct format is [extra].\',
	error_validator_message: \'The value of the <b>[field]<\\/b> field is invalid.\',
	text_page_loading: \'Loading... Your request is being processed, please wait.\',
	view_cart: \'View cart\',
	checkout: \'Checkout\',
	product_added_to_cart: \'Product was added to your cart\',
	products_added_to_cart: \'Products were added to your cart\',
	product_added_to_wl: \'Product was added to your Wish list\',
	product_added_to_cl: \'Product was added to your Compare list\',
	close: \'Close\',
	error: \'Error\',
	error_ajax: \'Oops, something goes wrong ([error]). Please try again.\',
	text_changes_not_saved: \'Your changes have not been saved.\',
	text_data_changed: \'Your changes have not been saved.\\n\\nPress OK to continue, or Cancel to stay on the current page.\'
}

var warning_mark = "&lt;&lt;";

var currencies = {
	\'primary\': {
		\'decimals_separator\': \'.\',
		\'thousands_separator\': \',\',
		\'decimals\': \'2\',
		\'coefficient\': \'1.00000\'
	},
	\'secondary\': {
		\'decimals_separator\': \'.\',
		\'thousands_separator\': \',\',
		\'decimals\': \'2\',
		\'coefficient\': \'1.00000\'
	}
};

var cart_language = \'\';
var images_dir = \'\';
var notice_displaying_time = 5;
var cart_prices_w_taxes = false;
var translate_mode = false;
var iframe_urls = new Array();
var iframe_extra = new Array();
var regexp = new Array();
$(document).ready(function(){
	jQuery.runCart(\'C\');
});

document.write(\'<style>.cm-noscript { display:none }</style>\'); // hide noscript tags
//]]>
</script>
'; ?>