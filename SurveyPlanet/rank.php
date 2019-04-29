<?php
require_once("conn.php");
require_once("session.php");
$getPoin = "SELECT * FROM poin WHERE id_quiz = :id";
$id = $_SESSION['id_quiz'];
$getPoinSQL = $db->prepare($getPoin);
$getPoinParams = array(
    ":id" => $id
);
$getPoinSQL->execute($getPoinParams);
$poin = $getPoinSQL->fetchall();
function myComparator($a, $b) {
    return $b['poin'] - $a['poin'] ;
}
usort($poin,"myComparator");
?>


<!DOCTYPE html>
<html style="height:100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Rank | Survey Planet</title>
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
                                <li class="nav-item" role="presentation"><a class="nav-link" href="id?r=rank" style="color:#ffffff;">Rank</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="cara_main" style="color:#ffffff;">Cara Main</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container">
                    <div class="row">
                        <div class="col" style="margin-left:0px;">
                            <div class="row" style="margin-right:0px;margin-left:0px;">
                                <div class="col" id="judul" style="border-radius: 19px;margin-top:;background-color:rgba(241,130,51,0.9);">
                                    <h1 class="text-center" style="margin-top:24px;color:rgb(255,255,255);">PERINGKAT</h1>
                                </div>
                            </div>
                            <div class="row" style="margin-right:0px;margin-left:0px;margin-top:-93px;">
                                <div class="col" id="judul" style="border-radius: 19px;margin-top:110px;background-color:rgba(241,130,51,0.9);">
                                    <p class="text-center" style="color:rgb(255,255,255);margin-bottom:0px;padding:7px;">ID Quiz = <?php echo $_SESSION['id_quiz'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 15px;">
                        <div class="col" id="nilai" style="border-radius: 19px;background-color: rgba(33,16,35,0.9);margin-top: 10px;">
                            <div class="table-responsive" style="padding: 28px;color: rgb(255,255,255);">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th style="width:193px;">Poin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($poin as $row) {
                                            $checkUsername = "SELECT * FROM user WHERE id_user = :id";
                                            $id_u = $row['id_user'];
                                            $checkUsernameSQL = $db->prepare($checkUsername);
                                            $checkUsernameParams = array(
                                                ":id" => $id_u
                                            );
                                            $checkUsernameSQL->execute($checkUsernameParams);
                                            $user = $checkUsernameSQL->fetch(PDO::FETCH_ASSOC);
                                            $username = $user['username'];
                                            $poin = $row['poin'];
                                            echo "<tr><td>$username</td>";
                                            echo "<td>".number_format($poin,2,".","")."</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>