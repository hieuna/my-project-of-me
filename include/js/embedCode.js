shp.embedCode = {}

shp.embedCode.show = function (html, bbcode, update){ 
    bbcode = (bbcode==null||bbcode=='')?'Không hỗ trợ':bbcode;
    
    if (update){
        $('#embedCodeBox #html_code').val(html);
        $('#embedCodeBox #bb_code').val(bbcode);
        return;
    }
    
    txtTitle = shp.join ('<div class="title_popup">')
    	('<div class="text">Mã nhúng</div>')
    ('</div>')();

    txtContent = shp.join ('<div id="embedCodeBox" class="clearfix" style="font-size: 12px; padding: 10px;">')
    	('<div>')
            ('<div id="cError"></div>')
            ('<table width="100%" celspacing="2" celpadding="3" border="0">')
    		('<tr><td valign="top"><label>Mã nhúng HTML</label></td><td width="420" style="padding-bottom: 10px;"><textarea style="width: 400px; height: 70px;" id="html_code" onfocus="this.select();">'+html+'</textarea></td></tr>')
            ('<tr><td valign="top"><label>Mã nhúng Forum</label></td><td style="padding-bottom: 10px;"><textarea style="width: 400px; height: 70px;" id="bb_code" onfocus="this.select();">'+bbcode+'</textarea></td></tr>')
            ('<tr><td valign="top"><label>Demo</label></td><td id="demo">'+html+'</td></tr>')
            ('</table>')
    	('</div>')();
     
     shp.show_overlay_popup(10, txtTitle, txtContent);
}

$(document).ready(function (){
    // SET default button type value on edit page
    var button_type = $('#user_product_button input[name=product_button_type]').val();
    $('#user_product_button input[name=theme_type][value='+button_type+']').attr('checked', 'checked');
    
    $('#user_product_button .create-form-title').click(function (e){
        e.preventDefault();
        $('#user_product_button #create-form').slideToggle();
    })
    
    $('#user_product_button .embedCodeShow').click(function (e){
        e.preventDefault();
        id = parseInt($(this).attr('rel'));
        codeHTML = $('#user_product_button input[name=embed_html_'+id+']').val();
        codeBBCODE = $('#user_product_button input[name=embed_bbcode_'+id+']').val();
        
        shp.embedCode.show(codeHTML, codeBBCODE);
    })
    
    $('#user_product_button .actionConfirm').click(function (e){
        //e.preventDefault();
        title = $(this).attr('title');
        return confirm('Bạn có chắc chắn muốn '+title+' không?');
    })
    
    $('#generateEmbedCode').submit(function (e){
        e.preventDefault();
        
        var themeType = $('#generateEmbedCode input[name=theme_type]:checked').val();
        shp.embedCode.show('Đang xử lý', 'Đang xử lý');
        
        $.getJSON(
            'user_product_button.php', 
            {
                task: 'embed',
                theme:  themeType
            },
            function (json){
                html_code = (json.html==null)?'Có lỗi trong quá trình xử lý':json.html;
                bb_code = (json.bbcode==null)?null:json.bbcode;
                shp.embedCode.show(html_code, bb_code);
            }
        );
    })
})