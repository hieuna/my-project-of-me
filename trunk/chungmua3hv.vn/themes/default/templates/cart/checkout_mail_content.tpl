<center><span style="font-size:18px; font-weight:bold; text-transform:uppercase">{#title_mail_shop#}</span></center>
<p>
<span style="font-size:16px; font-weight:bold">{#user_infor#}</span><br />
{#name#}: <b>{$info.name}</b><br />
{#email#}: <b>{$info.email}</b><br />
{#address#}: <b>{$info.address}</b><br />
{#phone#}: <b>{$info.phone}</b><br />
</p>
<p>
<span style="font-size:16px; font-weight:bold">{#invoice_infor#}</span><br />
{foreach from=$cart item=item name=cart}
{assign var="pid" value=$item.product.id}
<b>{$smarty.foreach.cart.index+1}. <a href='{$smarty.const.SITE_URL}{"index.php?mod=product&task=view&id=$pid"|url_friendly}'>{$item.Product_Title}</a></b><br />
- {#price#}: <b>{$item.Product_Price|number_format:0:".":"."} {#currency#}</b><br />
- {#quantity#}: <b>{$item.quantity}</b><br />
- {#money#}: <b>{$item.subtotal} {#currency#}</b><br />
-------------------------------<br />
{/foreach}
-- {#total_money#}: <strong>{$total|number_format:0:".":"."} {#currency#}</strong><br />
</p>
<p>
{#other_infor#}: <b>{$info.addition_request}</b><br />
</p>