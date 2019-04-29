<?php
require_once('conn.php');
require_once('session.php');
if(isset($_POST['input'])){
    $_SESSION['waktu'] = filter_input(INPUT_POST, 'kecepatan', FILTER_VALIDATE_FLOAT);
    $_SESSION['poin'] = filter_input(INPUT_POST, 'ketepatan', FILTER_VALIDATE_FLOAT);
    $_SESSION['jJawab'] = filter_input(INPUT_POST, 'percobaan', FILTER_VALIDATE_FLOAT);
    $_SESSION['jJawab'] /= 10;
    echo "asd";
    header("Location: fuzzy?l=mf");
}
?>

<!DOCTYPE html>
<html style="height:100%;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Manual Input Fuzzy | Survey Planet</title>
    <link rel="icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/css/Fixed-Navbar.css">
    <link rel="stylesheet" href="assets/css/Fixed-Navbar1.css">
    <link rel="stylesheet" href="assets/css/Fixed-Navbar2.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Header-Dark.css">
    <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-image:url(&quot;assets/img/Background-Grey.png&quot;);background-color:rgba(255,255,255,0);background-repeat:no-repeat;background-size:cover;background-position:top;">
    <div style="margin-top:99px;">
        <div class="header-blue" style="background-color:rgba(255,255,255,0);background-image:url(&quot;none&quot;);">
            <div class="container hero">
                <nav class="navbar navbar-light navbar-expand-md fixed-top" style="background-color:rgba(255,255,255,0.2);">
                    <div class="container-fluid"><a class="navbar-brand" href="index">Planet Survey</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navcol-1">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item" role="presentation"><a class="nav-link active" href="index" style="color:#ffffff;">Home</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="id?r=rank" style="color:#ffffff;">Rank</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="cara_main" style="color:#ffffff;">Cara Main</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container d-flex justify-content-center hero" style="margin-top: 109px;">
                    <form style="width: 555px;padding: 10px;" method="POST">
                        <h1 class="text-center" style="margin-bottom: 20px;">Manual Input Fuzzy</h1>
                        <div class="form-row" style="padding: 10px;">
                            <div class="col">
                                <h4 style="color: rgb(255,255,255);font-family: Bitter, serif;margin: 0px;margin-top: 4px;">Kecepatan</h4>
                            </div>
                            <div class="col-xl-8"><input type="number" step="0.01" name="kecepatan" class="border rounded form-control" id="inp" style="font-size:20px;color: white;background-color: transparent;" /></div>
                        </div>
                        <div class="form-row" style="padding: 10px;">
                            <div class="col">
                                <h4 style="margin: 0px;color: rgb(255,255,255);font-family: Bitter, serif;margin-top: 4px;">Ketepatan</h4>
                            </div>
                            <div class="col-xl-8"><input type="number" step="0.01" name="ketepatan" class="border rounded form-control" id="inp" style="font-size:20px;color: white;background-color: transparent;" /></div>
                        </div>
                        <div class="form-row" style="padding: 10px;">
                            <div class="col">
                                <h4 style="margin: 0px;color: rgb(255,255,255);font-family: Bitter, serif;margin-top: 4px;">Percobaan</h4>
                            </div>
                            <div class="col-xl-8"><input type="number" step="0.01" name="percobaan" class="border rounded form-control" id="inp" style="font-size:20px;color: white;background-color: transparent;" /></div>
                        </div>
                        <div style="padding: 10px;">
                            <button class="btn btn-info btn-block" style="color:white;font-family:Bitter, serif;font-size:20px;" type="submit" name="input">Hitung Fuzzy</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </div>

</body>

</html>