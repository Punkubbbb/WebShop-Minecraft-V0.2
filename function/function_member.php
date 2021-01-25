<link href="dist/sa.css" rel="stylesheet">
<script src="dist/sa.js"></script>
<script src="dist/jquery.js"></script>
<body>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Bai+Jamjuree");
        body,td,th {
            font-family: "Bai Jamjuree", sans-serif;
            font-size: 15px;
        }
        body
        {
            background: url('<?php echo $Config['site']['background'] ?>') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
    <?php

    function alert($msg) {
        echo '<script>
                swal({
                    type: "error",
                    title: "ผิดพลาด! (Member)",
                    html: "' . $msg . '",
                    confirmButtonColor: "#e02b2b",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                    confirmButtonClass: "btn btn-danger",
                }).then(function (isConfirm) {
                    if (isConfirm === true) {
                        var url = "index.php";

                        $(location).attr("href", url);
                    } else {
                        var url = "index.php";

                        $(location).attr("href", url);
                    }
                })
            </script>';
    }

    function login($msg) {
        echo '<script>
                swal({
                    type: "success",
                    title: "สำเร็จ! (Member)",
                    html: "' . $msg . '",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                    confirmButtonClass: "btn btn-danger",
                }).then(function (isConfirm) {
                    if (isConfirm === true) {
                        var url = "index.php";

                        $(location).attr("href", url);
                    } else {
                        var url = "index.php";

                        $(location).attr("href", url);
                    }
                })
            </script>';
    }

    if (isset($_GET["login"])) :
        if (empty($_POST["username"])) {
            alert("กรุณากรอกชื่อผู้ใช้งาน");
            exit();
        }
        if (empty($_POST["password"])) {
            alert("กรุณากรอกรหัสผ่าน");
            exit();
        }
        $authme = $engine->prepare("SELECT * FROM authme WHERE username = :username");
        $authme->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
        $authme->execute();
        $password = $authme->fetch();
        if (PasswordHash($_POST["password"], $password["password"]) == true) {
            $_SESSION["username"] = $password["username"];
            login("เข้าสู่ระบบแล้ว");
            exit();
        } else {
            alert("ชื่อผู้ใช้งานหรือรหัสผ่านผิด");
            exit();
        }

    endif;
    if (isset($_GET["logout"])) :
        session_destroy();
        login("ออกจากระบบแล้วครับ");
        exit();
    endif;
    ?>
</body>