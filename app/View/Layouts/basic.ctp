<!DOCTYPE html>
<html>
<head>
    <title>Khashkhobar.in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?=$this -> webroot . 'images/logotrans.png';?>"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div id="header">
            <div class="row" style="margin-top:2%">
                <div class="col-lg-4"></div>
                <div class="col-lg-6" style="padding-left:4%">
                    <img height="150px" width="350px" src="<?=$this -> webroot . 'images/logotrans.png';?>" />
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>

        <div id="content">
            <?= $this -> fetch("content"); ?>
        </div>

        <div id="footer">
            <?= $this -> element("footer"); ?>
        </div>
    </div>
</body>
</html>