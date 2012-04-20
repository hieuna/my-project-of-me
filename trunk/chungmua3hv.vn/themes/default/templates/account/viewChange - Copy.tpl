
    	<div id="pageCenter">
            <div class="signupContent">
            	<img src="{$smarty.const.SITE_URL}themes/default/images/doimk.png" alt="photo">
                <form method="post" action="{$smarty.const.SITE_URL}changepass.html">
                <ul class="signupForm">
                    <li>
                    <input class="signupInput signupLabel" id="EMail" name="email" value="{$smarty.session.emaillogin}" title="{$smarty.session.emaillogin}" type="text">
                    </li>
                    <li>
                    <input class="signupInput signupLabel" onkeyup="testPassword(this.value)" onfocus="{literal}this.type='password';if(this.value==this.defaultValue){this.value='';}return true;{/literal}" onblur="{literal}if(this.value==''){this.type='text';this.value=this.defaultValue}{/literal}" name="pass" title="Mật khẩu" type="text" value="">
                    </li>
                        <div class="passVerc">
                                   <div id="levelPass"><div class="level" id="level"></div></div>
                                   <div id="pass_strong"></div>
                        </div>
                    <li>
                    <input class="signupInput signupLabel" onfocus="{literal}this.type='password';if(this.value==this.defaultValue){this.value='';}return true;{/literal}" onblur="{literal}if(this.value==''){this.type='text';this.value=this.defaultValue}{/literal}" name="passconf" title="Nhập lại mật khẩu" type="text" value="">
                    </li>
                    <li>
                    <input class="signupButton" value="Thay đổi mật khẩu" type="submit">
                    </li>
                </ul>
                </form>
                <div class="error" {if $error}style="display:block;"{/if}>
                    <p>{$error2}</p>
                    <p>{$error3}</p>
                    <p>{$error4}</p>
                    <p>{$error5}</p>
                </div>
            </div>           
        <div class="clr"></div>
        </div>     
    <!--ket thuc #pageContent-->
    