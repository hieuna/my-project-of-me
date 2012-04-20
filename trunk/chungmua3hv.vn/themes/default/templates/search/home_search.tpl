<div class="searchContent">
      <div class="searchTitle">
          <div class="searchTitleInside">TÌM KIẾM NÂNG CAO</div>     
      </div>
      	<span style="display:none;"><img class="trigger" id="trigger" alt="" src="{$smarty.const.SITE_URL}themes/{$smarty.session.theme}/images/blank.gif" /></span>
      <form class="searchAdvanceForm" method="get" action="{$smarty.const.SITE_URL}{$smarty.session.lang}/search/">
          <table cellspacing="0" cellpadding="0" border="0" class="searchTable">
              <tbody><tr>
                  <td class="searchLabel"><label for="keyword">Từ khóa:</label></td>
                  <td><input type="search" value="{if $smarty.get.keywords!='NỘI DUNG TÌM KIẾM..'}{$smarty.get.keywords}{/if}" name="keywords" class="searchInput" id="keyword"></td>
              </tr>
              <tr>
                  <td class="searchLabel"><label for="destination">Địa danh:</label></td>
                  <td>
                  	<select name="s_id" id="sites" onchange="get_deals_ajax(1)">
                   <option value="">{#all_destination#}</option>
                      {foreach from=$arrPanrent key=k item=v}
                      	<option {if $smarty.get.s_id==$k} selected="selected"{/if} value="{$k}">{$v}</option>
                      {/foreach}
                    </select>
                  </td>
              </tr>
              <tr>
                  <td class="searchLabel"><label for="catalogy">Danh mục:</label></td>
                  <td>
                  	<select name="cate_id" id="category" onchange="get_deals_ajax(1)">
                   <option value="">Tất cả danh mục</option>
                      {foreach from=$arrtype key=k item=v}
                      	<option {if $smarty.get.cate_id==$k} selected="selected"{/if} value="{$k}">{$v}</option>
                      {/foreach}
                    </select>
                  </td>
              </tr>
              <tr>
                  <td class="searchLabel"><label for="timeBegin">Thời giam bắt đầu:</label></td>
                  <td>
                  		<input type="text" id="startdate" class="date" value="" name="startdate"/>
						<input type="hidden" name="sd_timestamp" id="sd_timestamp" />
                  </td>
              </tr>
              <tr>
                  <td class="searchLabel"><label for="timeEnd">Thời gian kết thúc:</label></td>
                  <td>
                  		<input type="text" id="enddate" class="date" value="" name="enddate"/>
                        <input type="hidden" name="ed_timestamp" id="ed_timestamp" /><span class="nights"></span>
                  </td>
              </tr>
              <tr>
                  <td class="searchLabel"><label for="sortBy">Sắp xếp theo:</label></td>
                  <td>
                  	<select id="sortBy" name="sortBy" onchange="get_deals_ajax(1)">
                    	<option value="latest">Deals Latest</option>
                  		<option value="az">Name (A-Z)</option>
                      	<option value="za">Name (Z-A)</option>
                        <option value="lh">Price (low to hight)</option>
                        <option value="hl">Price (hight to low)</option>	
                     </select>
                  </td>
              </tr>
              <tr>
                  <td class="searchLabel"></td>
                  <td><input type="submit" value="Tìm kiếm" class="searchButton" id="sortBy"></td>
              </tr>
          </tbody></table>
      </form>
  </div>
  <div id="waiting" style="display:none;">
      <center>
          <img src="{$smarty.const.SITE_URL}upload/ajax-loader.gif" title="Loader" alt="Loader" />
      </center>
  </div>
  <div class="searchinfo" id="searchinfo"></div>
  {literal}<script>
<!--//
function get_deals_ajax(page) {
	$('#waiting').show(500);
	$("#waiting").fadeOut(1000);
    var p = {};
		p['name'] = $('#keyword').val();
		p['sites'] = $('#sites').val();
		p['category'] = $('#category').val();
		p['sortBy'] = $('#sortBy').val();
		p['startdate'] = $('#sd_timestamp').val();
		p['enddate'] = $('#ed_timestamp').val();
    $('#searchinfo').load('{/literal}{$smarty.const.SITE_URL}{literal}index.php/{/literal}{$smarty.session.lang}{literal}/?mod=search&task=deals&ajax=true&page='+page+'/',p);
    return false;
}
//-->
</script>{/literal}
<script>
	get_deals_ajax({$smarty.get.page|default:1});
</script>