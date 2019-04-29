<?php
require_once("conn.php");
require_once("session.php");
$id = uniqid();
function generateRandomString()
{
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < 6; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
$idQuiz = generateRandomString();
$idSoal = uniqid();
if (!isset($_SESSION['idQuiz'])) {
    $_SESSION['idQuiz'] = $idQuiz;
}
if (isset($_SESSION['idQuiz'])) {
    $idQuiz = $_SESSION['idQuiz'];
}
if (isset($_POST['input']) || isset($_POST['input_quiz'])) {
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
            if (isset($_SESSION['idQuiz']))
                $params = array(
                    ":id" => $id,
                    ":username" => $username
                );
            else
                $params = array(
                    ":id" => $idQuiz,
                    ":username" => $username
                );
            $saved = $stmt->execute($params);
        } else
            $saved = false;
        if ($saved) {
            $_SESSION['id_user'] = $id;
            $_SESSION['username'] = $username;
            echo "Input User Baru Success";
        } else {
            echo "Deteksi User Berhasil";
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
        }
    }
    if (!isset($_SESSION['id_quiz'])) {
        $inputQuiz = "INSERT INTO quiz (id_quiz, id_user)
                      VALUES (:id_quiz, :id_user)";
        $inputQuizSQL = $db->prepare($inputQuiz);
        $inputQuizParams = array(
            ":id_quiz" => $idQuiz,
            ":id_user" => $_SESSION['id_user']
        );
        $quiz = $inputQuizSQL->execute($inputQuizParams);
        if ($quiz) {
            echo "Input Quiz Success";
            $_SESSION['id_quiz'] = $idQuiz;
        }
    }
    print_r($_SESSION);
    $soal = filter_input(INPUT_POST, 'soal', FILTER_SANITIZE_STRING);
    $inputSoal = "INSERT INTO soal (id_soal, id_quiz, soal)
                  VALUES (:id_soal, :id_quiz, :soal)";
    $inputSoalSQL = $db->prepare($inputSoal);
    $inputSoalParams = array(
        ":id_soal" => $idSoal,
        ":id_quiz" => $_SESSION['id_quiz'],
        ":soal" => $soal
    );
    $iSoal = $inputSoalSQL->execute($inputSoalParams);
    if ($iSoal) {
        echo "Input Soal Success";
        $n = 5;
        for ($i = 1; $i <= $n; $i++) {
            $idJawaban = uniqid();
            $jawaban = filter_input(INPUT_POST, 'jawaban_' . $i, FILTER_SANITIZE_STRING);
            $poin = filter_input(INPUT_POST, 'poin_' . $i, FILTER_SANITIZE_STRING);
            $inputJawaban = "INSERT INTO jawaban (id_jawaban, id_soal, jawaban, poin)
                                VALUES (:id_jawaban, :id_soal, :jawaban, :poin)";
            $inputJawabanSQL = $db->prepare($inputJawaban);
            $inputJawabanParams = array(
                ":id_jawaban" => $idJawaban,
                ":id_soal" => $idSoal,
                ":jawaban" => $jawaban,
                ":poin" => $poin
            );
            $iJawab = $inputJawabanSQL->execute($inputJawabanParams);
            if ($iJawab) {
                echo "Input Jawaban Success";
            } else
                echo "Input Jawaban Gagal";
        }
    }
}
if (isset($_POST['input_quiz'])) {
    header("Location: index");
}
?>
<!DOCTYPE html>
<html style="height:100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tambah Quiz | Survey Planet</title>
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
                <div class="container hero" style="padding: 50px 100px;">
                    <form action="" method="POST">
                        <div id="form_nama">
                            <h1 class="text-center" style="color:white;font-family:Bitter, serif;margin-top:0px;">ID QUIZ = <?php echo $_SESSION['idQuiz']; ?></h1>
                            <h1 class="text-center" style="color:white;font-family:Bitter, serif;margin-top:0px;">Nama Pembuat Quiz</h1>
                            <div class="form-group d-flex justify-content-center">
                                <input class="form-control form-control-lg" type="text" required autofocus="" name="username" id="username" style="text-align: center;color:white;font-family:Bitter, serif;margin-top:0px;background-color: transparent;">
                            </div>
                        </div>
                        <h1 class="text-center" style="color:white;font-family:Bitter, serif;margin-top:30px;">Masukkan Pertanyaan dan Jawaban</h1>
                        <div class="form-group">
                            <input type="text" name="soal" placeholder="Pertanyaan" id="pertanyaan" required class="form-control form-control-lg" style="color:white;font-family:Bitter, serif;margin-top:20px;background-color: transparent;" />
                        </div>
                        <div class="form-group d-flex">
                            <input type="text" placeholder="Jawaban" name="jawaban_1" required class="form-control form-control-lg" style="color:white; font-family:Bitter, serif;margin-right:10px;background-color: transparent" />
                            <input type="text" placeholder="Poin" name="poin_1" required class="form-control form-control-lg" style="color:white; font-family:Bitter, serif;background-color: transparent;width:20%;" />
                            <!--<button class="btn btn-light btn-block btn-lg" type="button" style="color:white;width: auto;background-color: #CFD4D9;" id="button_$i">+</button>-->
                        </div>
                        <div class="form-group d-flex">
                            <input type="text" placeholder="Jawaban" name="jawaban_2" class="form-control form-control-lg" style="color:white;  font-family:Bitter, serif;margin-right:10px;background-color: transparent" />
                            <input type="text" placeholder="Poin" name="poin_2" class="form-control form-control-lg" style="color:white; font-family:Bitter, serif;background-color: transparent;width:20%;" />
                            <!--<button class="btn btn-light btn-block btn-lg" type="button" style="color:white;width: auto;background-color: #CFD4D9;" id="button_$i">+</button>-->
                        </div>
                        <div class="form-group d-flex">
                            <input type="text" placeholder="Jawaban" name="jawaban_3" class="form-control form-control-lg" style="color:white; font-family:Bitter, serif;margin-right:10px;background-color: transparent" />
                            <input type="text" placeholder="Poin" name="poin_3" class="form-control form-control-lg" style="color:white; font-family:Bitter, serif;background-color: transparent;width:20%;" />
                            <!--<button class="btn btn-light btn-block btn-lg" type="button" style="color:white;width: auto;background-color: #CFD4D9;" id="button_$i">+</button>-->
                        </div>
                        <div class="form-group d-flex">
                            <input type="text" placeholder="Jawaban" name="jawaban_4" class="form-control form-control-lg" style="color:white;font-family:Bitter, serif;margin-right:10px;background-color: transparent" />
                            <input type="text" placeholder="Poin" name="poin_4" class="form-control form-control-lg" style="color:white; font-family:Bitter, serif;background-color: transparent;width:20%;" />
                            <!--<button class="btn btn-light btn-block btn-lg" type="button" style="color:white;width: auto;background-color: #CFD4D9;" id="button_$i">+</button>-->
                        </div>
                        <div class="form-group d-flex">
                            <input type="text" placeholder="Jawaban" name="jawaban_5" class="form-control form-control-lg" style="color:white; font-family:Bitter, serif;margin-right:10px;background-color: transparent" />
                            <input type="text" placeholder="Poin" name="poin_5" class="form-control form-control-lg" style="color:white; font-family:Bitter, serif;background-color: transparent;width:20%;" />
                            <!--<button class="btn btn-light btn-block btn-lg" type="button" style="color:white;width: auto;background-color: #CFD4D9;" id="button_$i">+</button>-->
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <button class="btn btn-info btn-block btn-lg" style="color:white;font-family:Bitter, serif;height:50px;margin-top:10px;font-size:20px;" type="submit" name="input">Tambah Pertanyaan</button></div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button class="btn btn-info btn-block btn-lg" style="color:white;font-family:Bitter, serif;height:50px;margin-top:10px;font-size:20px;" type="submit" name="input_quiz">Input Quiz</button></div>
                            </div>
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
<?php
if (isset($_SESSION['id_user'])) {
    $user_name = $_SESSION['username'];
    echo $user_name;
    echo "
    <script>
    document.getElementById('username').value='$user_name'</script>";
}


?>