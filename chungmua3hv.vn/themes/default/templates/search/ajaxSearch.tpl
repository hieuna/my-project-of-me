{foreach from=$deals item=deals}
<div class="soldBox">
    <div class="soldTitle"><a href="{$smarty.const.SITE_URL}deals/{$deals.Product_ID}/{$deals.Product_Name|removeMarks}.html">{$deals.Product_Name|truncate:50}</a></div>
    <div class="soldImage">
        <div class="soldLabel">Giảm<p>{$deals.save}%</p></div>
        <div class="soldPrice">{$deals.Product_DealPrice|number_format} đ</div>
        <a href="{$smarty.const.SITE_URL}deals/{$deals.Product_ID}/{$deals.Product_Name|removeMarks}.html"><img alt="{$deals.Product_Name}" src="{$smarty.const.SITE_URL}upload/product/{$deals.Product_Photo}"></a>
    </div>
    <div class="soldValue">Giá trị: <b>{$deals.Product_Price|number_format} đ </b></div>    
    <div class="soldSave">Tiết kiệm: <b>{$deals.Product_Price-$deals.Product_DealPrice|number_format} đ </b></div>    
</div>   
{/foreach}             
<!-- Mot box hien thi-->
<!-- Phan trang-->
<div class="page">
   {$sPaging}
</div>
  <div style="clear:both;"></div>