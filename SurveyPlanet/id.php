<?php
require_once("conn.php");
require_once("session.php");
if (isset($_POST['submit'])) {
    $checkID = "SELECT * FROM quiz WHERE id_quiz = :id";
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $checkIDSQL = $db->prepare($checkID);
    $checkIDParams = array(
        ":id" => $id
    );
    $checkIDSQL->execute($checkIDParams);
    $id_Quiz = $checkIDSQL->fetch(PDO::FETCH_ASSOC);
    if ($id_Quiz) {
        $_SESSION['id_quiz'] = $id_Quiz['id_quiz'];
        if ($_GET['r'] == 'main')
            header("Location: kuis");
        if ($_GET['r'] == 'rank')
            header("Location: rank");
    } else
        echo "<script>alert('ID Quiz \"$id\" Tidak Tersedia')</script>";
}
?>

<!DOCTYPE html>
<html style="height:100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Input ID | Survey Planet</title>
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

<body style="background-image:url(&quot;assets/img/Background-Grey.png&quot;);background-color:rgba(255,255,255,0);background-repeat:no-repeat;background-size:cover;">
    <div style="margin-top:99px;">
        <div class="header-blue" style="background-color:rgba(255,255,255,0);background-image:url(&quot;none&quot;);">
            <div class="container hero">
                <nav class="navbar navbar-light navbar-expand-md fixed-top" style="background-color:rgba(255,255,255,0.2);">
                    <div class="container-fluid"><a class="navbar-brand" href="index">Planet Survey</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navcol-1">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item" role="presentation"><a class="nav-link active" href="index" style="color:#ffffff;">Home</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:#ffffff;">Rank</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="cara_main" style="color:#ffffff;">Cara Main</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <form action="" method="POST" style="padding-top:150px;">
                    <div id="form_nama">
                        <h1 class="text-center" style="color:;font-family:Bitter, serif;margin-top:0px;">MASUKKAN ID QUIZ</h1>
                        <div class="form-group d-flex justify-content-center">
                            <input class="form-control form-control-lg" type="text" autofocus="" name="id" id="id" style="text-align:center;color:white;font-family:Bitter, serif;margin-top:20px;width:50%;background-color: transparent;">
                        </div>
                    </div>
                    <div id="form_submit">
                        <div class="form-group d-flex justify-content-center">
                            <button class="btn btn-info btn-block btn-lg" type="submit" style="width:50%;color:;font-family:Bitter, serif;height:50px;margin-top:10px;font-size:20px;" name="submit" value="submit">Masukkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>