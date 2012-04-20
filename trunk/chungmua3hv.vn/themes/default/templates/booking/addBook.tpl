<script>
var null_name = '{#null_name#}';
var null_email = '{#null_email#}';
var null_phone = '{#null_phone#}';
var null_address = '{#null_address#}';
var null_city = '{#null_city#}';
var null_country = '{#null_country#}';
var null_adult = '{#null_adult#}';
var null_security = '{#null_security#}';
var invalide_email = '{#invalide_email#}';
var security_incorrect = '{#security_incorrect#}';
</script>
{literal}
<script language="javascript">	
	function validateForm( frm )
	{
		var RE_EMAIL = /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;

		if ( frm.txtName.value == '')
		{
			alert (null_name);
			frm.txtName.focus();
			return false;
		}
		if ( frm.txtPhone.value == '')
		{
			alert (null_phone);
			frm.txtPhone.focus();
			return false;
		}
		if ( frm.txtEmail.value == '')
		{
			alert (null_email);
			frm.txtEmail.focus();
			return false;
		}
		if ( !RE_EMAIL.test(frm.txtEmail.value) )
		{
			alert (invalide_email);
			frm.txt_email.focus();
			return false;
		}
		if ( frm.txtEmailConfirm.value == '')
		{
			alert (null_email);
			frm.txtEmailConfirm.focus();
			return false;
		}
		if ( !RE_EMAIL.test(frm.txtEmailConfirm.value) )
		{
			alert (invalide_email);
			frm.txtEmailConfirm.focus();
			return false;
		}
		if ( frm.txtAddress.value == '')
		{
			alert (null_address);
			frm.txtAddress.focus();
			return false;
		}
		if ( frm.txtCity.value == '')
		{
			alert (null_city);
			frm.txtCity.focus();
			return false;
		}
		if ( frm.txtCountry.value == '')
		{
			alert (null_country);
			frm.txtCountry.focus();
			return false;
		}
		if ( frm.txtAdult.value == '')
		{
			alert (null_adult);
			frm.txtAdult.focus();
			return false;
		}
		if ( frm.txtSecurity.value == '')
		{
			alert (security_incorrect);
			frm.txtSecurity.focus();
			return false;
		}
		
	}
</script>
{/literal}


<div class="boxContent">
                        <div class="caption">
                            <span class="captionLeft">{#online_booking#}</span>
                        </div><form method="post" onsubmit="return validateForm(this);">
                        <div class="boxItemList">
                             <h2  class="hbook">{#ttcn#}</h2>  
                             {if $msg}<p style="color:#F00;"><b>(*) {$msg}</b></p> {/if}                
                                        
  							<table class="booking" border="0" cellpadding="3" cellspacing="3">
                            <tr>
                            <td width="300"><label>{#name#} (*)</label>
                            <input type="text" name="txtName" value="{$smarty.request.txtName}" class="txtTextbox"/>
                            </td>
                            <td><label>{#phone#} (*)</label>
                            <input type="text" name="txtPhone" value="{$smarty.request.txtPhone}" class="txtTextbox"/>
                            </td>
                            </tr>
                            <tr>
                            <td width="300"><label>{#email#} (*)</label>
                            <input type="text" name="txtEmail" value="{$smarty.request.txtEmail}" class="txtTextbox"/>
                            </td>
                            <td width="300"><label>{#email_confirm#} (*)</label>
                            <input type="text" name="txtEmailConfirm" value="{$smarty.request.txtEmailConfirm}" class="txtTextbox"/>
                            </td>
                             <tr>
                            <td><label>{#fax#}</label>
                            <input type="text" name="txtFax" value="{$smarty.request.txtFax}" class="txtTextbox"/>
                            </td>
                            <td><label>{#address#} (*)</label>
                            <input type="text" name="txtAddress" value="{$smarty.request.txtAddress}" class="txtTextbox"/>
                            </td>
                            </tr>
                            <tr>
                            <td width="300"><label>{#city#} (*)</label>
                            <input type="text" name="txtCity" value="{$smarty.request.txtCity}" class="txtTextbox"/>
                            </td>
                            <td><label>{#country#}(*)</label>
                            <select name="txtCountry" class="txtTextbox" style="padding:2px 5px 2px 5px; height:25px;" id="country" size="1">
                        <option selected="selected" value="">Please select your country</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>

                        <option value="Angola">Angola</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bangladesh">Bangladesh</option>

                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia">Bosnia</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Brazil">Brazil</option>

                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Canada">Canada</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Colombia">Colombia</option>

                        <option value="Cote d'ivoire">Cote d'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Czech republic">Czech republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Dominican republic">Dominican republic</option>

                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="England">England</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>

                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Greece">Greece</option>
                        <option value="Holland">Holland</option>
                        <option value="Hungary">Hungary</option>
                        <option value="India">India</option>

                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran">Iran</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>

                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Laos">Laos</option>

                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Libya">Libya</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Macedonia">Macedonia</option>
                        <option value="Malaysia">Malaysia</option>

                        <option value="Mexico">Mexico</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Netherlands">Netherlands</option>

                        <option value="New zealand">New zealand</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Norway">Norway</option>
                        <option value="Others">Others</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palestine">Palestine</option>

                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto rico">Puerto rico</option>

                        <option value="Rumania">Rumania</option>
                        <option value="Russia">Russia</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="South africa">South africa</option>

                        <option value="South korea">South korea</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri lanka">Sri lanka</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Taiwan">Taiwan</option>

                        <option value="Thailand">Thailand</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>

                        <option value="United arab emirates">United arab emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Venezuela">Venezuela</option>

                        <option value="VietNam">VietNam</option>
                        <option value="Yugoslavia">Yugoslavia</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                            </td>
                            </tr>
                            </table>
                            
                           <div class="clr"></div>
                            
                        </div>
                         <div class="boxItemList">
                          <h2  class="hbook">{#number_books#} (*)</h2>           
                         <table class="booking" border="0" cellpadding="3" cellspacing="3">
                         <tr><td width="150">{#adult#} <select name="txtAdult" id="txtAdult">
                                        <option value="">00</option>
 
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>

                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                    </select></td>
                           <td width="200">{#twobefore#} <select name="txtChild1" id="txtChild1">
                                        <option value="00">00</option>

                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>

                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        </select>
                                        </td>
                                        
                         <td>{#twounder#}<select name="txtChild2" id="txtChild2">
                                        <option value="00">00</option>

                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>

                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                    </select></td>       
                         </tr>                    
                         </table>
                           <div class="clr"></div>
                        </div>
<div class="boxItemList">
                             <h2 class="hbook">{#info_book#} </h2>                    
  							<table class="booking" border="0" cellpadding="3" cellspacing="3">
                            <tr>
                            <td width="300"><label>{#name_book#}</label>
                           	<h2>{$product.Product_Name}</h2>
                            </td>
                            <td rowspan="5"><label>{#description#}</label>
                            <span>{$product.Product_Description}</span>
                            </td>
                            </tr>
                            <tr>
                    <td><label>{#type_room#}</label>
                            <select class="contact_txt" id="BooktourAccommdation" name="BooktourAccommdation">
                            <option value="Standard">Standard</option>
                            <option value="Mid-range">Mid-range</option>
                            <option value="First-class">First-class</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Luxury">Luxury</option>
                            
                            </select>
                            </td>
                           </tr>
                            <tr>
                            <td><label>{#start_date#}</label>
                            {html_select_date field_order='DMY' prefix='StartDate' time=$time start_year='-5'
                               end_year='+1'}
                            </td>
                           </tr>
                            <tr>
                            <td><label>{#end_date#} (*)</label>
                            {html_select_date field_order='DMY' prefix='EndDate' time=$time start_year='-5'
                               end_year='+1' day='+1'}
                            </td>
                           </tr>
                             <tr>
                            <td><label>{#other_request#}</label>
                           <textarea class="txtTextbox" name="txtRequest" style="height:90px; width:100%;"/>{$smarty.request.txtRequest}</textarea>
                            </td>
                            </tr>
                            </table>
                            
                           <div class="clr"></div>
                            
                        </div> 
<div class="boxItemList">
                             <h2 class="hbook">{#payment_type#}</h2>                    
  							<table class="booking" border="0" cellpadding="3" cellspacing="3">
                            
                            <tr>
                    <td><label>{#payment#}</label>
                            <select class="contact_txt" id="BooktourPaymentId" name="BooktourPaymentId">
                            <option value="Bank-transfer">Bank-transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit card">Credit card</option>
                            <option value="Other">Other</option>
                            </select>
                            </td>
                           </tr>
                            <tr><td>
                            <label>{#security#} (*)</label>
                             <img  src="{$smarty.const.SITE_URL}lib/captcha/CaptchaSecurityImages.php?width=100&height=40&characters=5" />
                            <label>{#note_security#}</label>
                            <input type="text" name="txtSecurity" class="txtTextbox" style="height:30px; width:100px;"/>
                            </td></tr>
                            <tr><td><input type="submit" class="submit" value="{#send_request#}" /></td></tr>
                            </table>
                            
                           <div class="clr"></div>
                            
                        </div>                                     
                       </form>
                    </div>
                    
