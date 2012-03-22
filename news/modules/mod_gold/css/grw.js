// JavaScript Document
function grw(url,id,eval_str){
    if(document.getElementById){var x=(window.ActiveXObject)?new ActiveXObject("Microsoft.XMLHTTP"):new XMLHttpRequest();}
    if(x){x.onreadystatechange=function() {
        el=document.getElementById(id);
        el.innerHTML='loading....';
        if(x.readyState==4&&x.status==200){
            el.innerHTML='';
            el=document.getElementById(id);
            el.innerHTML=x.responseText;
            eval(eval_str);
            }
        }
    x.open("GET",url,true);x.send(null);
    }
}
function change(id){
    grw('../modules/mod_gold/tmpl/weather.php?id='+id,'noidung');
}