<div class="container-fluid" style="padding-top:7%">
    <div class="form" style="box-shadow:0px 1px 5px #ddd">
    <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
    <form class="register-form">
        <input type="text" placeholder="name"/>
        <input type="password" placeholder="password"/>
        <input type="text" placeholder="email address"/>
        <button>create</button>
        <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" action="<?=$this->webroot.'Admins/login'?>" method="post">
        <input type="text" name="userName" placeholder="username"/>
        <input type="password" name="passWord" placeholder="password"/>
        <input type="submit" value="Login" />
        <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
    </div>
</div>
