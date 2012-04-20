                <div class="pageTitle">SẢN PHẨM ĐÃ BÁN</div>     
<div class="pageDefault">
{if $product_item_sold}{foreach from=$product_item_sold item=oProduct}
                <!-- Mot box hien thi-->
                <div class="soldBox">
                	<div class="soldTitle"><a title="{$oProduct.Product_Name}" href="san-pham-{$oProduct.Product_ID}/{$oProduct.Product_LinkName}.html" >{$oProduct.Product_Name|truncate:100}</a></div>
                    <div class="soldImage">
                        <div class="soldLabel">Giảm<p>{$oProduct.Product_Price-$oProduct.Product_DealPrice|percent:$oProduct.Product_Price}%</p></div>
                        <a title="{$oProduct.Product_Name}" href="san-pham-{$oProduct.Product_ID}/{$oProduct.Product_LinkName}.html"><img  src="upload/product/{$oProduct.Product_Photo}" alt="{$oProduct.Product_Name}"/></a>
                    </div>
                    <div class="soldPrice">{$oProduct.Product_DealPrice|number_format} đ</div>
                    <div class="soldInfo">
                        Giá trị: <b class="soldValue">{$oProduct.Product_Price|number_format} đ </b><br />
                        Tiết kiệm: <b class="soldSave">{$oProduct.Product_Price-$oProduct.Product_DealPrice|number_format} đ </b>
                    </div>   
                </div>
                
                
            {/foreach}
            {else}
            Chưa có dữ liệu
            {/if}       
                <div class="page">
             {if $sPaging}   {$sPaging}{/if}      <!-- Phan trang-->
                   
                </div>
                <div class="clr"></div>
            </div>
