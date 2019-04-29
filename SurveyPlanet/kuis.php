<?php
require_once("conn.php");
require_once("session.php");
$n = 4;
$id = uniqid();
if (isset($_SESSION['id_quiz'])) {
    $idQuiz = $_SESSION['id_quiz'];
    $loadSoal = "SELECT * FROM soal where id_quiz=:id_quiz";
    $loadSoalSQL = $db->prepare($loadSoal);
    $loadSoalParams = array(
        ":id_quiz" => $idQuiz
    );
    $loadSoalSQL->execute($loadSoalParams);
    $soal = $loadSoalSQL->fetchAll();
} else
    header("Location: index");
if (isset($_POST["submit"])) {
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
    if (!isset($_SESSION['id_user'])) {
        $checkUsername = "SELECT * FROM user WHERE username = :username";
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $checkUsernameSQL = $db->prepare($checkUsername);
        $checkUsernameParams = array(
            ":username" => $username
        );
        $checkUsernameSQL->execute($checkUsernameParams);
        $user = $checkUsernameSQL->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            $sql = "INSERT INTO user (id_user, username) 
            VALUES (:id, :username)";
            $stmt = $db->prepare($sql);
            // bind parameter ke query
            $params = array(
                ":id" => $id,
                ":username" => $username
            );
            $saved = $stmt->execute($params);
        } else
            $saved = false;
        for ($i = 1; $i <= $n; $i++) {
            $jawaban[$i] = filter_input(INPUT_POST, 'jawaban_' . $i, FILTER_SANITIZE_STRING);
        }
        if ($saved) {
            $_SESSION['id_user'] = $id;
        } else
            $_SESSION['id_user'] = $user['id_user'];
    } else {
        for ($i = 1; $i <= $n; $i++) {
            $jawaban[$i] = filter_input(INPUT_POST, 'jawaban_' . $i, FILTER_SANITIZE_STRING);
        }
    }
    $i = 1;
    $poin = 0;
    $jJawab = 0;
    foreach ($soal as $row) {
        $loadJawaban = "SELECT * FROM jawaban where id_soal=:id_soal";
        $idSoal = $row['id_soal'];
        $loadJawabanSQL = $db->prepare($loadJawaban);
        $loadJawabanParams = array(
            ":id_soal" => $idSoal
        );
        $loadJawabanSQL->execute($loadJawabanParams);
        $jawabanD = $loadJawabanSQL->fetchAll();
        $jawaban[$i] = str_replace(' ', '', $jawaban[$i]);
        $jawab[$i] = explode(',', $jawaban[$i]);
        $jawUniq[$i] = array_unique($jawab[$i]);
        foreach ($jawUniq[$i] as $un){
            $jJawab++;
        }
        foreach ($jawabanD as $rowJawab) {
            foreach ($jawUniq[$i] as $jaw) {
                if (strcasecmp($rowJawab['jawaban'], $jaw) == 0) {
                    $poin += $rowJawab['poin'];
                }
            }
        }
        if (!$jawabanD) {
            echo "error baca database";
        }
        $i++;
    }
    $n = $i - 1;
    $poin /= $n;
    $jJawab /= $n;
    $time /= $n;
    if (isset($_SESSION['id_user'])) {
        $_SESSION['poin'] = $poin;
        $_SESSION['waktu'] = $time;
        $_SESSION['jJawab'] = $jJawab;
        #echo "<script>window.location.href='?t='+totalSeconds</script>";
        header("Location: fuzzy?l=q");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Quiz | Survey Planet</title>
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
                <div class="form-group" style="font-size:29px;font-family:Bitter, serif;color:rgb(243,245,248);">
                    <p class="text-center" style="color:rgba(255,255,255,0.8);margin-top:0px;margin-bottom:-50px;font-size:24px;padding:4px;background-color:#6fb7db;height:46px;"><label>Waktu </label><label id="minutes">00</label>:<label id="seconds">00</label></p>
                </div>
                <form action="" method="POST" style="padding-top:150px;">
                    <input hidden class="form-control form-control-lg" type="text" name="time" id="time" style="color:white;font-family:Bitter, serif;margin-top:20px;width:50%;background-color: transparent;">
                    <div id="form_nama">
                        <h1 class="text-center" style="font-family:Bitter, serif;margin-top:0px;">Nama Peserta</h1>
                        <div class="form-group d-flex justify-content-center">
                            <input class="form-control form-control-lg" type="text" autofocus="" name="username" id="username" style="text-align:center;color:white;font-family:Bitter, serif;margin-top:20px;width:50%;background-color: transparent;">
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button class="btn btn-info btn-block btn-lg" name="submitNama" type="button" id="button" style="color:;font-family:Bitter, serif;width:50%;height:50px;margin-top:10px;font-size:20px;">Lanjutkan</button>
                        </div>
                    </div>
                    <?php
                    $i = 1;
                    foreach ($soal as $row) {
                        ?>
                        <div id="form_<?php echo $i ?>"">
                                <h1 class=" text-center" style="font-family:Bitter, serif;color:;margin-top:0px;"> <?php echo $row['soal']; ?></h1>
                            <div class="form-group d-flex justify-content-center">
                                <input name="jawaban_<?php echo $i ?>" class="form-control form-control-lg" type="text" style="text-align:center; width:50%;color:white;font-family:Bitter, serif;margin-top:20px;background-color: transparent;">
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <button name="but_<?php echo $i ?>" class="btn btn-info btn-block btn-lg" type="button" id="button_<?php echo $i ?>" style="width:50%;color:;font-family:Bitter, serif;height:50px;margin-top:10px;font-size:20px;">Masukkan Jawaban</button>
                            </div>
                        </div>
                        <?php
                        $i++;
                        # code...
                        $n = $i;
                    }
                    ?>
                    <div id="form_submit">
                        <div class="form-group d-flex justify-content-center">
                            <button id="xxx" class="btn btn-info btn-block btn-lg" type="submit" style="width:50%;color:;font-family:Bitter, serif;height:50px;margin-top:10px;font-size:20px;" name="submit" value="submit">Submit Jawaban</button>
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
<script>
    var minutesLabel = document.getElementById("minutes");
    var secondsLabel = document.getElementById("seconds");
    var totalSeconds = 0;

    function setTime() {
        ++totalSeconds;
        secondsLabel.innerHTML = pad(totalSeconds % 60);
        minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
    }

    function pad(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }
    $("#form_submit").hide()
    $("#button").click(function() {
        if (document.getElementById("username").value == "") {
            alert("Masukkan nama anda bro");
        } else {
            setInterval(setTime, 1000);
            $("#form_nama").fadeOut(1000);
            $("#form_1").fadeIn(1000);
        }
    });
</script>
<?php
$i = 1;
foreach ($soal as $row) {
    echo "<script> 
    $('#form_$i').hide(); 
    </script>";
    $i++;
}
if (isset($_SESSION['id_user'])) {
    echo "
    <script> $('#form_nama').hide();
    setInterval(setTime, 1000);
    $('#form_1').show();</script>
    ";
}
$i = 1;
foreach ($soal as $row) {
    if (!isset($_SESSION['id_user']))
        echo "
        <script> 
        $('#form_$i').hide(); 
        </script>";
    $i++;
}
$n == $i;
$i = 1;
foreach ($soal as $row) {
    $j = $i + 1;
    if ($j != $n)
        echo "<script> $('#button_$i').click(function() {
            $('#form_$i').fadeOut(1000);
            $('#form_$j').fadeIn(1000);
        });</script>";
    $i++;
}
$i--;
echo "<script> $('#button_$i').click(function() {
    ";
$i = 1;
foreach ($soal as $row) {
    echo "$('#form_$i').fadeIn(1000);
    $('#button_$i').hide();";
    $i++;
}
echo "$('#form_submit').fadeIn(1000);
});
</script>";
?>
<script>
    $('#xxx').click(function() {
        document.getElementById('time').value = totalSeconds;
    });
</script>