shop.district = {
	listDistrict: new Array(),
	listDistrictDropdown: {},
	showDistrict:function(obj){
		
		var d = jQuery(obj).attr('value');
			d = d.toLowerCase();
		if(d)  {
			var return_arr = new Array();
			for(i in shop.district.listDistrict)
			{
				str = shop.district.listDistrict[i].title;
				str = str.toLowerCase();
				if(str.match(d))
				{
					var mat = str.match(d);
					var tempArr = shop.district.listDistrict[i];
					tempArr['lang'] = shop.district.listDistrict[i].title;
					return_arr.push(tempArr);
				}
				else{
					shop.district.hideDistrict();
				}
			}
			shop.district.displayDistrict(return_arr);
			jQuery("#listDistrict").highlight(d);
		}
		else{
			shop.district.hideDistrict();
		}
	},
	displayDistrict:function(obj){
		var html = '';
		for(x in obj){
			html += '<a href="javascript:void(0)" class="linkListDis" onclick="shop.district.insertDistrict(\''+obj[x].lang+'\');">'+obj[x].title+'</a>';
		}
		if(html != ''){
			jQuery("#listDistrict").html(html);
			jQuery("#listDistrict").show();
		}
	},
	hideDistrict:function(){
		jQuery("#listDistrict").hide();
	},
	insertDistrict:function(v){
		jQuery("#district").val(v);
		shop.district.hideDistrict();
	},
	loadDistrict:function(v){
		if(v > 0){
			jQuery.jCache.maxSize = 20;
			var key = 'listDistrict'+v;
			
			shop.district.listDistrict = jQuery.jCache.getItem(key);
			if(!shop.district.listDistrict){
				shop.ajax_popup('act=customer&code=loadDistrict',"POST",{city_id:v},
				function (j) {
					shop.district.listDistrict = j;
					jQuery.jCache.setItem(key, shop.district.listDistrict);
				});
			}
			shop.district.hideDistrict();
		}
	  return false;
	},
	loadDistrictDropdown:function(v, container_id, cb, def, is_ship){
		if(v > 0){
			jQuery.jCache.maxSize = 20;
			var key = 'listDistrictDropdown'+v,districtOpt = '',is_num = def && shop.is_num(def),sl=false;
			
			shop.district.listDistrictDropdown = jQuery.jCache.getItem(key);
			if(!shop.district.listDistrictDropdown){
				shop.ajax_popup('task=loadDistrictDropdown',"POST",{city_id:v, is_ship: is_ship},
				function (j) {
					shop.district.listDistrictDropdown = j;
					jQuery.jCache.setItem(key, j);
					for(var i in j){
						if(is_num){
							sl = def == j[i].id;
						}else{
							sl = def == j[i].title;
						}
						districtOpt += '<option value="'+j[i].id+'"'+(sl?" selected":"")+'>'+j[i].title+'</option>';
					}
					jQuery("#"+container_id).html(districtOpt);
					if(cb){cb()}
				});
			}else {
				for(var i in shop.district.listDistrictDropdown){
					if(is_num){
						sl = def == shop.district.listDistrictDropdown[i].id;
					}else{
						sl = def == shop.district.listDistrictDropdown[i].title;
					}
					districtOpt += '<option value="'+shop.district.listDistrictDropdown[i].id+'"'+(sl?" selected":"")+'>'+shop.district.listDistrictDropdown[i].title+'</option>';
				}
				jQuery("#"+container_id).html(districtOpt);
				if(cb){cb()}
			}
		}
		return false;
	}
};
