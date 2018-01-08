<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    
    ::-webkit-scrollbar 
    { 
        display: none; 
    }

  </style>
</head>

<body style="border-top:2px solid #eee;background:#eee">
    <div class="container-fluid" style="background:#286090;padding-left:20%;padding-right:20%;padding-top:10%">
        <div class="row">
            <!-- THE LOGIN BOX -->
            <div class="col-lg-6 col-lg-offset-3" style="background:#fff;padding:4%;box-shadow:0px 1px 10px;margin-bottom:15%">
                <form autocomplete="off" action="<?=$this->webroot?>Admins/login" method="post">
                    <div class="row">
                    <div class="col-lg-2">
                        <img src="<?=$this->webroot.'images/Lock.png'?>" height="40" width="40" />
                    </div>
                    <div class="col-lg-9" stle="text-align:left">
                        <span class="help-block" style="font-size:200%;"><b>Secure Login</b></span>
                    </div>
                    </div>         
                    <hr />
                    <label for="u" class="help-block">Username</label>
                    <input name="user" id="u" type="text" placeholder="Username" class="form-control" style="margin-bottom:2%" required />                    
                    <label for="p" class="help-block">Password</label>
                    <input name="pass" id="p" type="password" placeholder="Password" class="form-control" style="margin-bottom:4%" required />
                    <input type="submit" class="btn btn-primary" value="Login" />
                </form>
            </div>
        </div>
    </div>
</body>