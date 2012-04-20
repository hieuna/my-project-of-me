<table width="700" border="0"><tr><td width="972">
                       
                             <h3><em>{#ttcn#}</em></h3>                    
  							<table class="booking" border="0" cellpadding="3" cellspacing="3">
                            <tr>
                            <td width="264"><label><strong>{#name#}</strong></label>
                                 <p><em>{$post.txtName}</em></p>
                           </td>
                            <td><label><strong>{#phone#}</strong>i</label>
                                <p><em>{$post.txtPhone}</em></p>
                           </td>
                            </tr>
                            <tr>
                            <td width="264"><label><strong>{#email#}</strong></label>
                               <p><em>{$post.txtEmail}</em></p>
                           </td>
                            <td width="403"><label><strong>{#email_confirm#}</strong></label>
                              <p><em>{$post.txtEmailConfirm}</em></p>
                            </td></tr>
                             <tr>
                            <td><label><strong>{#fax#}</strong></label>
                             <p><em>{$post.txtFax}</em></p>
                            </td>
                            <td><label><strong>{#address#}</strong></label>
                             <p><em>{$post.txtAddress}</em></p>
                            </td>
                            </tr>
                            <tr>
                            <td width="264"><label><strong>{#city#}</strong></label>
                             <p><em>{$post.txtCity}</em></p>
                            </td>
                            <td><label><strong>{#country#}</strong></label>
                            <p><em>{$post.txtCountry}</em></p>
                            </td>
                            </tr>
                            </table>
                            
                          </td></tr>
                        <tr><td>
                         
                          <h3  class="hbook"><strong><em>{#number_books#}</em></strong></h3>           
                         <table width="685" border="0" cellpadding="3" cellspacing="3" class="booking">
                         <tr>
                           <td width="150"><em>{#adult#}: </em>{$post.txtAdult} </td>
                           <td width="200"><em>{#twobefore#} </em>: {$post.txtChild1} </td>
                                        
                         <td><em>{#twounder#}</em>:  {$post.txtChild2} </td>       
                         </tr>                    
                         </table>
                           
                             <h3 class="hbook"><em><strong>{#info_book#}</strong></em></h3>                    
  							<table class="booking" border="0" cellpadding="3" cellspacing="3">
                            <tr>
                            <td width="271"><label><strong>{#name_book#}</strong></label>
                           	  <em><strong>{$product.Product_Name}</strong></em>
                            </td>
                            <td width="386" rowspan="3" valign="top"><p>
                              <label><strong>{#other_request#}</strong></label>
                              
                              <p><span><em>{$post.txtRequest}</em></span></p></td>
                            </tr>
                            <tr>
                            <td valign="top"><label><strong><em>{#type_room#}</em></strong></label>
                            <p><em>{$post.BooktourAccommdation}</em></p>
                            
                            </td></tr>
                            <tr>
                            <td valign="top"><label><strong><em>{#start_date#} (DD/MM/YY)</em></strong></label>
                            <p><em>{$post.StartDateDay}/{$post.StartDateMonth}/{$post.StartDateYear}</em></p>
                            
                            </td></tr>
                           
                            <tr>
                            <td valign="top"><label><strong><em>{#end_date#} (DD/MM/YY)</em></strong></label>
                            <p><em>{$post.EndDateDay}/{$post.EndDateMonth}/{$post.EndDateYear}</em></p>
                            
                            </td></tr>
                            <tr>
                            <td valign="top"><label><strong><em>{#payment_type#}</em></strong></label>
                            <p><em>{$post.BooktourPaymentId}</em></p>
                            
                            </td></tr>
                           
                           
                            </table>
                                        
                       
                   </td></table>
                    
