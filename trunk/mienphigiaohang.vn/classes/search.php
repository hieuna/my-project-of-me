<?php
echo "linhnobi";
include'database.php'; 
 
?><!--
		<span onmouseover="_tipon(this)" onmouseout="_tipoff()">
		<span class="google-src-text" style="direction: ltr; text-align: left">
		<!-- Use of this code assumes agreement with the Google Custom Search Terms of Service.</span> Sử dụng mã này giả định thỏa thuận với các Điều khoản Dịch vụ Google Tìm kiếm Tuỳ chỉnh của.</span> <span onmouseover="_tipon(this)" onmouseout="_tipoff()"><span class="google-src-text" style="direction: ltr; text-align: left">--> <!-- The terms of service are available at http://www.google.com/cse/docs/tos.html -->
<!--		 <form name=cse id=searchbox_demo action=http://www.google.com/cse> 
			 <input type=hidden name=cref value="" />
			 <input type=hidden name=ie value=utf-8 /> 
			 <input type=hidden name=hl value="" /> 
			 <input name=q type=text size=40 /> 
			 <input type=submit name=sa value=Search /> 
		 </form>
		 <script type=text/javascript src=http://www.google.com/cse/tools/onthefly?form=searchbox_demo&lang=></script>
		 </span> -> <- Điều khoản dịch vụ có sẵn tại http://www.google.com/cse/docs/tos.html -> 
		 <form name = cse id = searchbox_demo action = http://www. google.com / cse> 
		 <input type=hidden name=cref value="" /> <input type=hidden name=ie value=utf-8 /> 
		 <input type=hidden name=hl value="" /> < nhập tên = q loại = văn bản kích thước = 40 />
		 <input type=submit name=sa value=Search />
		 </ form> <script type = text / javascript src = http://www.google.com/cse/ công cụ / onthefly hình thức = searchbox_demo & lang => </ script>
		 </span> 
		 011035517979324464264:b8_6ago2h0w
		 -->007446901747837198769: rhfdjs5upeq 
<!-- Google CSE Search Box Begins  -->
<!-- SEARCH FORM -->
<style type="text/css">
/* results positioning */
#search-results		{ position:absolute; z-index:90; top:40px; right:10px; visibility:hidden; }
/* triangle! */
#search-results-pointer { width:0px; height:0px; border-left:20px solid transparent; border-right:20px solid transparent; border-bottom:20px solid #eee; margin-left:80%; }
/* content DIV which holds search results! */
#search-results-content { position:relative; padding:20px; background:#fff; border:3px solid #eee; width:380px; min-height:200px; -webkit-box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5) }
</style>
<form action="http://www.google.com/search" method="get">
  <!-- HTML5 SEARCH BOX!  -->
  <input type="search" id="search-box" name="q" results="5" placeholder="Search..." autocomplete="on" />
  <!-- SEARCH davidwalsh.name ONLY! -->
  <input type="hidden" name="sitesearch" value="mienphigiaohang.vn" />
  <!-- SEARCH BUTTON -->
  <input id="search-submit" type="submit" value="Search" />
</form>

<!-- ASYNCHRONOUSLY LOAD THE AJAX SEARCH API;  MOOTOOLS TOO! -->
<script type="text/javascript" src="http://www.google.com/jsapi?key=007446901747837198769: rhfdjs5upeq "></script>
<script type="text/javascript">
  google.load('mootools','1.2.4');
  google.load('search','1');
</script>
<!--
<form action="mienphigiaohang.vn" id="searchbox_007446901747837198769_rhfdjs5upeq">
  <input type="hidden" name="cx" value="007446901747837198769: rhfdjs5upeq " />
  <input type="hidden" name="cof" value="FORID:11" />
  <input type="text" name="q" size="25" />
  <input type="submit" name="sa" value="Search" />
</form>
<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=searchbox_007446901747837198769: rhfdjs5upeq &lang=vi"></script>

<div id="results_007446901747837198769:rhfdjs5upeq" style="display:none">
  <div class="cse-closeResults"> 
    <a>&times; close</a>
  </div>
  <div class="cse-resultsContainer"></div>
</div>
<style type="text/css">
@import url(http://www.google.com/cse/api/overlay.css);
</style>
<script src="http://www.google.com/uds/api?file=uds.js&v=1.0&key=ABQIAAAAUn5tEf3q6Jscs9Op1yPoFxQvGR1jgERgm47npeRX2H65OI_5ZxQzAtyjpAKknLwy967R4NRt9xwSUQ&hl=vi" type="text/javascript"></script>
<script src="http://www.google.com/cse/api/overlay.js"></script>
<script type="text/javascript">
function OnLoad() {
  new CSEOverlay("007446901747837198769: rhfdjs5upeq ",
                 document.getElementById("searchbox_007446901747837198769: rhfdjs5upeq "),
                 document.getElementById("results_007446901747837198769: rhfdjs5upeq "));
}
GSearch.setOnLoadCallback(OnLoad);
</script>-->
<!-- Google CSE Code ends -->  
<script type="text/javascript">
window.addEvent('domready',function(){

  /* search */
  var searchBox = $('search-box'), searchLoaded=false, searchFn = function() {

    /*
      We're lazyloading all of the search stuff.
      After all, why create elements, add listeners, etc. if the user never gets there?
    */
    if(!searchLoaded) {
      searchLoaded = true; //set searchLoaded to "true"; no more loading!

      //build elements!
      var container = new Element('div',{ id: 'search-results' }).inject($('search-area'),'after');
      var wrapper = new Element('div',{
        styles: {
          position: 'relative'
        }
      }).inject(container);
      new Element('div',{ id: 'search-results-pointer' }).inject(wrapper);
      var contentContainer = new Element('div',{ id: 'search-results-content' }).inject(wrapper);
      var closer = new Element('a', {
        href: 'javascript:;',
        text: 'Close',
        styles: {
          position: 'absolute', //position the "Close" link
          bottom: 35,
          right: 20
        },
        events: {
          click: function() {
            container.fade(0);
          }
        }
      }).inject(wrapper);

      //google interaction
      var search = new google.search.WebSearch(),
        control = new google.search.SearchControl(),
        options = new google.search.DrawOptions();

      //set google options
      options.setDrawMode(google.search.SearchControl.DRAW_MODE_TABBED);
      options.setInput(searchBox);

      //set search options
      search.setUserDefinedClassSuffix('siteSearch');
      search.setSiteRestriction('davidwalsh.name');
      search.setLinkTarget(google.search.Search.LINK_TARGET_SELF);

      //set search controls
      control.addSearcher(search);
      control.draw(contentContainer,options);
      control.setNoResultsString('No results were found.');

      //add listeners to search box
      searchBox.addEvents({
        keyup: function(e) {
          if(searchBox.value && searchBox.value != searchBox.get('placeholder')) {
            container.fade(0.9);
            control.execute(searchBox.value);
          }
          else {
            container.fade(0);
          }
        }
      });
      searchBox.removeEvent('focus',searchFn);
    }
  };
  searchBox.addEvent('focus',searchFn);
});
</script>