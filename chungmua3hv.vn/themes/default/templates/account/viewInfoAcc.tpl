
    	<div id="pageCenter">
            <div class="signupContent">
            	<img src="{$smarty.const.SITE_URL}themes/default/images/signupTitle.png" alt="photo">
                <form method="post" action="{$smarty.const.SITE_URL}signup.html">
                <ul class="signupForm">
                    <li>
                    <input class="signupInput signupLabel" id="Name" name="fullname" value="" title="Họ Tên" type="text">
                    </li>
                    <li>
                    <input class="signupInput1" id="EMail" name="email" value="{$smarty.session.emaillogin}" readonly title="" type="text">
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
                    <div class="signupDetail">Thông tin xác thực thanh toán:</div>
                    <input value="" class="signupInput signupLabel" id="Subject" name="subject" title="Số điện thoại" type="text">
                    </li>
                    <li>
                    <input class="signupButton" value="Đăng ký thành viên" type="submit">
                    </li>
                </ul>
                </form>
                <div class="error" {if $error}style="display:block;"{/if}>
                	<p>{$error1}</p>
                    <p>{$error2}</p>
                    <p>{$error3}</p>
                    <p>{$error4}</p>
                    <p>{$error5}</p>
                    <p>{$error6}</p>
                    <p>{$error7}</p>
                </div>
            </div>           
        <div class="clr"></div>
        </div>     
    <!--ket thuc #pageContent-->
    