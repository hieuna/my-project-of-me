<div class="boxRight">
    <div class="boxTitle">
        Tư vấn trực tiếp
    </div>
    {foreach from=$support item=support}
        <div class="boxDiscount">
            <div class="nameSupport">{$support.Support_Name}</div>
            <div class="numbberSupport" style="font-weight:bold; font-family:'Times New Roman', Times, serif; font-size:14px;">{$support.Support_Phone}</div>
            <div class="numbberSupport"><a href="ymsgr:sendIM?{$support.Support_Value}"><img src="http://opi.yahoo.com/online?u={$support.Support_Value}&m=g&t=2&l=us" border="0" /></a></div>
        </div>
      {/foreach}    
</div>