admin_members = {}

$(document).ready(function (){
  admin_members.user_type($('#user_type'));
  admin_members.user_shipping($('#site_shipping_allow'));
  $('#user_type').change(function (){
    admin_members.user_type(this);
  });
  $('#site_shipping_allow').change(function (){
    admin_members.user_shipping(this);
  })
});

admin_members.user_type = function (obj){
  user_type = $(obj).val();
  $('.user_type_seller').css('display', (user_type==1)?'none':'');
}

admin_members.user_shipping = function (obj){
  $('.user_shipping').css('display', ($('#site_shipping_allow').is(':checked')?'':'none'));
}