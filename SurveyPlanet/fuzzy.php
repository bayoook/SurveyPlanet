<?php
require_once("session.php");
require_once("conn.php");
$waktu = $_SESSION['waktu'];
$poin = $_SESSION['poin'];
$jJawab = $_SESSION['jJawab'];
$lanjutan = $_GET['l'];
$atas = 0;
$jumlahKecil = 0;
$bawah = 0;
$JumlahBesar = 0;
$sample = 10;
$d = 100/$sample;
$ts = 0;
$ts += $d;
$tsz = [];
$kb = [];
$j = 0;
$jJawab *= 10;
#$waktu = 40;
function waktuCepat($x)
{
    if ($x >= 10) $hasil = 0;
    else if ($x > 3 and $x < 10) $hasil = (10 - $x) / 7;
    else $hasil = 1;
    return $hasil;
}
function waktuSedang($x)
{
    if ($x <= 3 or $x >= 20) $hasil = 0;
    else if ($x > 3 and $x < 10) $hasil = ($x - 3) / 7;
    else if ($x > 13 and $x < 20) $hasil = (20 - $x) / 7;
    else $hasil = 1;
    return $hasil;
}
function waktuLambat($x)
{
    if ($x <= 13) $hasil = 0;
    else if ($x > 13 and $x < 20) $hasil = ($x - 13) / 7;
    else $hasil = 1;
    return $hasil;
}
$wc = waktuCepat($waktu);
$ws = waktuSedang($waktu);
$wl = waktuLambat($waktu);

function poinKecil($x)
{
    if ($x >= 50) $hasil = 0;
    else if ($x > 20 and $x < 50) $hasil = (50 - $x) / 30;
    else $hasil = 1;
    return $hasil;
}
function poinSedang($x)
{
    if ($x <= 20 or $x >= 100) $hasil = 0;
    else if ($x > 20 and $x < 50) $hasil = ($x - 20) / 30;
    else if ($x > 50 and $x < 100) $hasil = (100 - $x) / 50;
    else $hasil = 1;
    return $hasil;
}
function poinBesar($x)
{
    if ($x <= 50) $hasil = 0;
    else if ($x > 50 and $x < 100) $hasil = ($x - 50) / 50;
    else $hasil = 1;
    return $hasil;
}
$pk = poinKecil($poin);
$ps = poinSedang($poin);
$pb = poinBesar($poin);

function jSedikit($x)
{
    if ($x >= 22) $hasil = 0;
    else if ($x > 12 and $x < 22) $hasil = (22 - $x) / 10;
    else $hasil = 1;
    return $hasil;
}
function jSedang($x)
{
    if ($x <= 12 or $x >= 44) $hasil = 0;
    else if ($x > 12 and $x < 22) $hasil = ($x - 12) / 10;
    else if ($x > 34 and $x < 44) $hasil = (44 - $x) / 10;
    else $hasil = 1;
    return $hasil;
}
function jBanyak($x)
{
    if ($x <= 34) $hasil = 0;
    else if ($x > 34 and $x < 44) $hasil = ($x - 34) / 10;
    else $hasil = 1;
    return $hasil;
}
$jk = jSedikit($jJawab);
$js = jSedang($jJawab);
$jb = jBanyak($jJawab);

for($i = 1; $i <= 13; $i ++)
    $k[$i] = 0;
for($i = 1; $i <= 14; $i ++)
    $b[$i] = 0;
for($i = 1; $i <= 27; $i ++)
    $r[$i] = 0;

if ($wc and $pk and $jk) { $k[1] = min($wc, $pk, $jk); $r[1] = $k[1]; $s[1] = "Kecil"; }
if ($wc and $pk and $js) { $k[2] = min($wc, $pk, $js); $r[2] = $k[2]; $s[2] = "Kecil"; }
if ($wc and $pk and $jb) { $k[3] = min($wc, $pk, $jb); $r[3] = $k[3]; $s[3] = "Kecil"; }
if ($wc and $ps and $jk) { $k[4] = min($wc, $ps, $jk); $r[4] = $k[4]; $s[4] = "Kecil"; }
if ($wc and $ps and $js) { $b[1] = min($wc, $ps, $js); $r[5] = $b[1]; $s[5] = "Besar"; }
if ($wc and $ps and $jb) { $b[2] = min($wc, $ps, $jb); $r[6] = $b[2]; $s[6] = "Besar"; }
if ($wc and $pb and $jk) { $b[3] = min($wc, $pb, $jk); $r[7] = $b[3]; $s[7] = "Besar"; }
if ($wc and $pb and $js) { $b[4] = min($wc, $pb, $js); $r[8] = $b[4]; $s[8] = "Besar"; }
if ($wc and $pb and $jb) { $b[5] = min($wc, $pb, $jb); $r[9] = $b[5]; $s[9] = "Besar"; }

if ($ws and $pk and $jk) { $k[5] = min($ws, $pk, $jk); $r[10] = $k[5]; $s[10] = "Kecil"; }
if ($ws and $pk and $js) { $k[6] = min($ws, $pk, $js); $r[11] = $k[6]; $s[11] = "Kecil"; }
if ($ws and $pk and $jb) { $k[7] = min($ws, $pk, $jb); $r[12] = $k[7]; $s[12] = "Kecil"; }
if ($ws and $ps and $jk) { $k[8] = min($ws, $ps, $jk); $r[13] = $k[8]; $s[13] = "Kecil"; }
if ($ws and $ps and $js) { $k[9] = min($ws, $ps, $js); $r[14] = $k[9]; $s[14] = "Kecil"; }
if ($ws and $ps and $jb) { $b[6] = min($ws, $ps, $jb); $r[15] = $b[6]; $s[15] = "Besar"; }
if ($ws and $pb and $jk) { $b[7] = min($ws, $pb, $jk); $r[16] = $b[7]; $s[16] = "Besar"; }
if ($ws and $pb and $js) { $b[8] = min($ws, $pb, $js); $r[17] = $b[8]; $s[17] = "Besar"; }
if ($ws and $pb and $jb) { $b[9] = min($ws, $pb, $jb); $r[18] = $b[9]; $s[18] = "Besar"; }

if ($wl and $pk and $jk) { $k[10] = min($wl, $pk, $jk); $r[19] = $k[10]; $s[19] = "Kecil"; }
if ($wl and $pk and $js) { $k[11] = min($wl, $pk, $js); $r[20] = $k[11]; $s[20] = "Kecil"; }
if ($wl and $pk and $jb) { $k[12] = min($wl, $pk, $jb); $r[21] = $k[12]; $s[21] = "Kecil"; }
if ($wl and $ps and $jk) { $k[13] = min($wl, $ps, $jk); $r[22] = $k[13]; $s[22] = "Kecil"; }
if ($wl and $ps and $js) { $k[14] = min($wl, $ps, $js); $r[23] = $k[14]; $s[23] = "Kecil"; }
if ($wl and $ps and $jb) { $k[15] = min($wl, $ps, $jb); $r[24] = $k[15]; $s[24] = "Kecil"; }
if ($wl and $pb and $jk) { $b[10] = min($wl, $pb, $jk); $r[25] = $b[10]; $s[25] = "Besar"; }
if ($wl and $pb and $js) { $b[11] = min($wl, $pb, $js); $r[26] = $b[11]; $s[26] = "Besar"; }
if ($wl and $pb and $jb) { $b[12] = min($wl, $pb, $jb); $r[27] = $b[12]; $s[27] = "Besar"; }


$kecil = max($k);
$besar = max($b);

$bKecil = 80 - $kecil * 30;
$bBesar =  50 + $besar * 30;
$kc = 0;
$bs = 0;
for($i = 1; $i <= $sample; $i++){
    if($ts <= 50) {
        $atas += $ts * $kecil;
        $tKcl[$kc] = array("x" => $ts, "y" => $kecil);
        $kc++;
        $jumlahKecil++;
    }
    else if($ts >= 80){
        $atas += $ts * $besar;
        $JumlahBesar++;
        $tBsr[$bs] = array("x" => $ts, "y" => $besar);
        $bs++;
    }
    else{
        $kcN = (80 - $ts) / 30;
        $bsN = ($ts - 50) / 30;
        if($kcN > $bsN){
            $tsz[$j] = $ts;
            $kb[$j] = (80 - $tsz[$j]) / 30;
            if($kb[$j] > $kecil)
                $kb[$j] = $kecil;
            if($bsN > $kb[$j])
                $kb[$j] = $bsN;
            $tKcl[$kc] = array("x" => $ts, "y" => $kb[$j]);
            $kc++;
        }
        else {
            $tsz[$j] = $ts;
            $kb[$j] = ($tsz[$j] - 50) / 30;
            if($kb[$j] > $besar)
                $kb[$j] = $besar;
            if($kcN > $kb[$j])
                $kb[$j] = $kcN;
            $tBsr[$bs] = array("x" => $ts, "y" => $kb[$j]);
            $bs++;
        }
        $atas += $tsz[$j] * $kb[$j];
        $j++;
    }
    $ts += $d;
}
$bawah = ($jumlahKecil * $kecil) + ($JumlahBesar * $besar);
for($i = 0; $i < $j; $i++){
    $bawah += $kb[$i];
}

$hasil = $atas / $bawah;

?>

<?php
 
$waktuCepat = array(array("x" => 0, "y" => 1), array("x" => 3, "y" => 1), array("x" => 10, "y" => 0));
$waktuSedang = array(array("x" => 3, "y" => 0), array("x" => 10, "y" => 1),array("x" => 13, "y" => 1),array("x" => 20, "y" => 0));
$waktuLambat = array(array("x" => 13, "y" => 0), array("x" => 20, "y" => 1), array("x" => 500, "y" => 1));

$poinKecil = array(array("x" => 0, "y" => 1), array("x" => 20, "y" => 1), array("x" => 50, "y" => 0));
$poinSedang = array(array("x" => 20, "y" => 0), array("x" => 50, "y" => 1), array("x" => 100, "y" => 0));
$poinBesar = array(array("x" => 50, "y" => 0), array("x" => 100, "y" => 1), array("x" => 150, "y" => 1));

$jKecil = array(array("x" => 0, "y" => 1),array("x" => 12, "y" => 1), array("x" => 22, "y" => 0));
$jSedang = array(array("x" => 12, "y" => 0), array("x" => 22, "y" => 1), array("x" => 34, "y" => 1),array("x" => 44, "y" => 0));
$jBesar = array(array("x" => 34, "y" => 0), array("x" => 44, "y" => 1), array("x" => 50, "y" => 1));

$oKecil = array(array("x" => 0, "y" => 1), array("x" => 50, "y" => 1), array("x" => 80, "y" => 0));
$oBesar = array(array("x" => 50, "y" => 0), array("x" => 80, "y" => 1),array("x" => 100, "y" => 1));


if($wc) $wcpt = array(array("x" => $waktu, "y" => $wc)); else $wcpt = array(array("x" => -5, "y" => 0));
if($ws) $wsdng = array(array("x" => $waktu, "y" => $ws)); else $wsdng = array(array("x" => -5, "y" => 0));
if($wl) $wlmbt = array(array("x" => $waktu, "y" => $wl)); else $wlmbt = array(array("x" => -5, "y" => 0));

if($pk) $pkcl = array(array("x" => $poin, "y" => $pk)); else $pkcl = array(array("x" => -5, "y" => 0));
if($ps) $psdng = array(array("x" => $poin, "y" => $ps)); else $psdng = array(array("x" => -5, "y" => 0));
if($pb) $pbsr = array(array("x" => $poin, "y" => $pb)); else $pbsr = array(array("x" => -5, "y" => 0));

if($jk) $jkcl = array(array("x" => $jJawab, "y" => $jk)); else $jkcl = array(array("x" => -5, "y" => 0));
if($js) $jsdng = array(array("x" => $jJawab, "y" => $js)); else $jsdng = array(array("x" => -5, "y" => 0));
if($jb) $jbsr = array(array("x" => $jJawab, "y" => $jb)); else $jbsr = array(array("x" => -5, "y" => 0));
 
if($kecil) $oKcl = array(array("x" => 0, "y" => $kecil), array("x" => $bKecil, "y" => $kecil), array("x" => 80, "y" => 0)); else $oKcl = array(array("x" => 0, "y" => 0));
if($besar) $oBsr = array(array("x" => 50, "y" => 0), array("x" => $bBesar, "y" => $besar), array("x" => 150, "y" => $besar)); else $oBsr = array(array("x" => 0, "y" => 0));

if($kecil) $dKcl = array(array("x" => 0, "y" => $kecil), array("x" => $bKecil, "y" => $kecil), array("x" => 80, "y" => 0)); else $dKcl = array(array("x" => 0, "y" => 0));
if($besar) $dBsr = array(array("x" => 50, "y" => 0), array("x" => $bBesar, "y" => $besar), array("x" => 150, "y" => $besar)); else $dBsr = array(array("x" => 0, "y" => 0));

if ((isset($_SESSION['id_user'])) && (isset($_SESSION['id_user'])) && ($lanjutan == "q")) {
    $idPoin = uniqid();
    $idUser = $_SESSION['id_user'];
    $idQuiz = $_SESSION['id_quiz'];
    $inputPoin = "INSERT INTO poin (id_poin,id_user,id_quiz,poin) VALUES (:idPoin,:idUser,:idQuiz,:poin)";
    $inputPoinSQL = $db->prepare($inputPoin);
    $inputPoinParams = array(
        ":idPoin" => $idPoin,
        ":idUser" => $idUser,
        ":idQuiz" => $idQuiz,
        ":poin" => $hasil
    );
    $success = $inputPoinSQL->execute($inputPoinParams);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FUZZY | Survey Planet</title>
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
    <script>
    window.onload = function () {
        CanvasJS.addColorSet("warna1",["#CF9996","#C7D5A1","#618ECF","#000", "#000", "#000"]);
        CanvasJS.addColorSet("warna2",["#000", "#000", "#CF9996", "#618ECF"]);
        var waktu = new CanvasJS.Chart("chartWaktu", {
            colorSet: "warna1",
            animationEnabled: true,
            axisX:{minimum: 0, maximum: <?php if($waktu > 30) echo $waktu + 5; else echo 30;?>},
            axisY:{maximum: 1.1, minimum: 0},
            legend:{cursor: "pointer", itemclick: toggleDataSeries},
            toolTip: {shared: true},
            data: [
                {type: "area", markerSize: 0, name: "Cepat", showInLegend: "true", dataPoints: <?php echo json_encode($waktuCepat); ?>},
                {type: "area", markerSize: 0, name: "Sedang", showInLegend: "true", dataPoints: <?php echo json_encode($waktuSedang); ?>},
                {type: "area", markerSize: 0, name: "Lambat", showInLegend: "true", dataPoints: <?php echo json_encode($waktuLambat); ?>},
                {type: "area", name: "x", dataPoints: <?php echo json_encode($wcpt); ?>},
                {type: "area", name: "x", dataPoints: <?php echo json_encode($wsdng); ?>},
                {type: "area", name: "x", dataPoints: <?php echo json_encode($wlmbt); ?>}
            ]
        });
        var poin = new CanvasJS.Chart("chartPoin", {
            colorSet: "warna1",
            animationEnabled: true,
            axisX:{minimum: 0, maximum: 101},
            axisY:{maximum: 1.1},
            legend:{cursor: "pointer", itemclick: toggleDataSeries},
            toolTip: {shared: true},
            data: [
                {type: "area", markerSize: 0, name: "Kecil", showInLegend: "true", dataPoints: <?php echo json_encode($poinKecil); ?>},
                {type: "area", markerSize: 0, name: "Sedang", showInLegend: "true", dataPoints: <?php echo json_encode($poinSedang); ?>},
                {type: "area", markerSize: 0, name: "Besar", showInLegend: "true", dataPoints: <?php echo json_encode($poinBesar); ?>},
                {type: "area", name: "x", dataPoints: <?php echo json_encode($pkcl); ?>},
                {type: "area", name: "x", dataPoints: <?php echo json_encode($psdng); ?>},
                {type: "area", name: "x", dataPoints: <?php echo json_encode($pbsr); ?>}
            ]
        }); 
        var jJawab = new CanvasJS.Chart("chartjJawab", {
            colorSet: "warna1",
            animationEnabled: true,
            axisX:{minimum: 0, maximum: 51},
            axisY:{maximum: 1.1},
            legend:{cursor: "pointer", itemclick: toggleDataSeries},
            toolTip: {shared: true},
            data: [
                {type: "area", markerSize: 0, name: "Sedikit", showInLegend: "true", dataPoints: <?php echo json_encode($jKecil); ?>},
                {type: "area", markerSize: 0, name: "Sedang", showInLegend: "true", dataPoints: <?php echo json_encode($jSedang); ?>},
                {type: "area", markerSize: 0, name: "Banyak", showInLegend: "true", dataPoints: <?php echo json_encode($jBesar); ?>},
                {type: "area", name: "x", dataPoints: <?php echo json_encode($jkcl); ?>},
                {type: "area", name: "x", dataPoints: <?php echo json_encode($jsdng); ?>},
                {type: "area", name: "x", dataPoints: <?php echo json_encode($jbsr); ?>}
            ]
        });

        var output = new CanvasJS.Chart("chartOutput", {
            colorSet: "warna2",
            animationEnabled: true,
            axisX:{minimum: 0, maximum: 101},
            axisY:{maximum: 1.1},
            legend:{cursor: "pointer", itemclick: toggleDataSeries},
            toolTip: {shared: true},
            data: [
                {type: "line", markerSize: 0, name: "Kecil", showInLegend: "true", dataPoints: <?php echo json_encode($oKecil); ?>},
                {type: "line", markerSize: 0, name: "Besar", showInLegend: "true", dataPoints: <?php echo json_encode($oBesar); ?>},
                {type: "area", markerSize: 0, name: "x", dataPoints: <?php echo json_encode($oKcl); ?>},
                {type: "area", markerSize: 0, name: "x", dataPoints: <?php echo json_encode($oBsr); ?>}
            ]
        });

        var defuzz = new CanvasJS.Chart("charDefuzz", {
            colorSet: "warna2",
            animationEnabled: true,
            axisX:{minimum: 0, maximum: 101},
            axisY:{maximum: 1.1},
            legend:{cursor: "pointer", itemclick: toggleDataSeries},
            toolTip: {shared: true},
            data: [
                {type: "line", markerSize: 0, name: "Kecil", showInLegend: "true", dataPoints: <?php echo json_encode($oKecil); ?>},
                {type: "line", markerSize: 0, name: "Besar", showInLegend: "true", dataPoints: <?php echo json_encode($oBesar); ?>},
                {type: "area", markerSize: 0, name: "x", dataPoints: <?php echo json_encode($dKcl); ?>},
                {type: "area", markerSize: 0, name: "x", dataPoints: <?php echo json_encode($dBsr); ?>},
                {type: "scatter", name: "x", dataPoints: <?php echo json_encode($tKcl); ?>},
                {type: "scatter", name: "x", dataPoints: <?php echo json_encode($tBsr); ?>},
            ]
        });
        waktu.render();
        poin.render();
        jJawab.render();
        output.render();
        defuzz.render();
        function toggleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) e.dataSeries.visible = false;
            else e.dataSeries.visible = true;
            waktu.render();
        }

        }
    </script>
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
                <div class="container" style="margin-top: 30px;padding: 10px;">
                    <div class="row" style="padding: 10px;">
                        <div class="col">
                            <h1 class="text-center" style="margin-top: 30px; margin-bottom: 0px">FUZZIFIKASI</h1>
                        </div>
                    </div>
                    <div class="row" style="padding: 10px; margin-top:10px;">
                        <div class="col-lg-3 col-xl-3">
                            <h3 style="color: white;font-family: inherit;"><b>Kecepatan <?php echo $waktu;?>s :</b></h3>
                            <h5 style="color: white;"><?php
                                    if ($wc) echo "- Cepat (".number_format($wc,2,".","").")<br>";
                                    if ($ws) echo "- Sedang (".number_format($ws,2,".","").")<br>";
                                    if ($wl) echo "- Lambat (".number_format($wl,2,".","").")<br>";
                            ?></h5>
                        </div>
                        <div id="chartWaktu" style="height: 300px; width: 10%;" class="col"></div>
                    </div>
                    <div class="row" style="padding: 10px; margin-top:20px">
                        <div class="col-lg-3 col-xl-3">
                            <h3 style="color: white;"><b>Ketepatan <?php echo $poin;?> :</b></h3>
                            <h5 style="color: white;"><?php
                                if ($pk) echo "- Kecil (".number_format($pk,2,".","").")<br>";
                                if ($ps) echo "- Sedang (".number_format($ps,2,".","").")<br>";
                                if ($pb) echo "- Besar (".number_format($pb,2,".","").")<br>";
                            ?></h5>
                        </div>
                        <div id="chartPoin" style="height: 300px; width: 100%;" class="col"></div>
                    </div>
                    <div class="row" style="padding: 10px; margin-top:20px;">
                        <div class="col-lg-3 col-xl-3">
                            <h3 style="color: white;"><b>Percobaan <?php echo $jJawab;?> :</b></h3>
                            <h5 style="color: white;"><?php
                                if ($jk) echo "- Sedikit (".number_format($jk,2,".","").")<br>";
                                if ($js) echo "- Sedang (".number_format($js,2,".","").")<br>";
                                if ($jb) echo "- Banyak (".number_format($jb,2,".","").")<br><br>";
                            ?></h5>
                        </div>
                        <div id="chartjJawab" style="height: 300px; width: 100%;" class="col"></div>
                    </div>
                    <div class="row" style="padding: 10px;">
                        <div class="col">
                        <h1 class="text-center" style="margin-top: 30px; margin-bottom: 10px">INFERENSI</h1>
                        </div>
                    </div>
                    <div class="row" style="padding: 10px; margin-top:0px;">
                        <div class="col-lg-3 col-xl-3">
                            <h3 style="color: white;"><b>Rules :</b></h3>
                            <h5 style="color: white;"><?php
                                for($i = 1; $i <= 27; $i ++)
                                    if($r[$i])
                                        echo "- $i $s[$i](".number_format($r[$i],2,".","").")<br>";
                            ?></h5>
                            <br>
                            <h3 style="color: white;"><b>Output</b></h3>
                            <h5 style="color: white;">
                            <?php
                                if($kecil) echo "- Kecil (".number_format($kecil,2,".","").")<br>";
                                if($besar) echo "- Besar (".number_format($besar,2,".","").")<br><br>";
                            ?>
                            </h5>
                        </div>
                        <div id="chartOutput" style="height: 300px; width: 100%;" class="col"></div>
                    </div>
                    <div class="row" style="padding: 10px;">
                        <div class="col">
                        <h1 class="text-center" style="margin-top: 30px; margin-bottom: 10px">DEFUZZIFIKASI</h1>
                        </div>
                    </div>
                    <div class="row" style="padding: 10px; margin-top:0px;">
                        <div class="col-lg-3 col-xl-3">
                            <h3 style="color: white;"><b>Centroid Method <?php echo $sample ?> Sample</b></h3>
                            <h5 style="color: white;"><?php
                                echo "- Pembilang = ".number_format($atas,2,".","")."<br>";
                                echo "- Penyebut = ".number_format($bawah,2,".","")."<br>";
                            ?></h5>
                            <br>
                            <h3 style="color: white;"><b><?php echo "Hasil"; ?></b></h3>
                            <h5 style="color: white;">
                            <?php
                                echo "y = ".number_format($hasil,2,".","");
                            ?>
                            </h5>
                        </div>
                        <div id="charDefuzz" style="height: 300px; width: 100%;" class="col"></div>
                    </div>
                </div>
                <a class="btn btn-light btn-lg action-button" role="button" href="<?php
                if($lanjutan == "mf")
                    echo "index";
                else
                    echo "rank";
                ?>" style="margin-right:30px;background-color:rgba(255,255,255,0.82);color:rgb(33,117,144);">Next</a>
            </div>
        </div>
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
</body>

</html>