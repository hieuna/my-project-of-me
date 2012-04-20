<script type="text/javascript">
 var error_choose = '{#error_choose_answer#}';
 var poll_success = '{#poll_success#}';
{literal}
	function doPoll(pollId){		
		
			var obj = document.frmpoll.radPoll;
			var i , val;
			var flag = false;
			var val ='';
			for(i=0;i<obj.length;i++){
				if(obj[i].checked == true){
					flag = true;
					val += obj[i].value + '||';
				}			
			}
			
			if(flag == true){	
				$.get("{/literal}{$smarty.const.SITE_URL}{literal}index.php?mod=poll&task=poll&ajax",{'answer':val,'pollid':pollId},function(data){
						$("#div_poll").html('<div style="padding:0 0 10px 0; color:red;" align="center">' + poll_success + '</div>');
						$("#button_doPoll").hide();
					}
				);
			}else{
				alert(error_choose);
			}
	};	
	
	
	function statsPoll(id){	
		mywindow=window.open("{/literal}{$smarty.const.SITE_URL}{literal}index.php?mod=poll&task=stats&ajax&id="+ id,"newwindow","width=600px,height=400px,resizeable=false");
		mywindow.moveTo(420,400);
	}
{/literal}
</script>

<div class="boxPoll">
            	<h2>{#POLL#}</h2>
                <div class="content">
                	<span class="question">{$pollQuestion.Poll_Question}</span>
                    <div id="div_poll"></div>
                    {if $hide==1}
								<div style="padding:0 0 10px 0; color:red;" align="center">{#poll_success#}</div>
					{else}		
                    <form name="frmpoll" style="margin:0px;">
                    {foreach from=$pollAnswer item=answer key=id name=poll}
                      <label>  <input type="radio" name="radPoll" value="{$id}"  id="radPoll_{$smarty.foreach.poll.index}"/>{$answer}</label>
                    {/foreach}
                    </form>
                    <input type="button" onclick="doPoll({$pollQuestion.Poll_ID}); return false;" class="buttonPoll" id="button_doPoll" value="{#vote#}" />
                    {/if}<input type="button" onclick="statsPoll({$pollQuestion.Poll_ID}); return false;" class="buttonPoll" value="{#result#}" />
               </div>
            </div>


			