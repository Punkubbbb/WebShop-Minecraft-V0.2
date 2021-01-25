<?php
function error($msg,$location) {
        echo '<script>
                swal({
                    type: "error",
                    title: "ผิดพลาด! ",
                    html: "' . $msg . '",
                    confirmButtonColor: "#e02b2b",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                    confirmButtonClass: "btn btn-danger",
                }).then(function (isConfirm) {
                    if (isConfirm === true) {
                        var url = "'.$location.'";
                        $(location).attr("href", url);
                    } else {
                        var url = "'.$location.'";
                        $(location).attr("href", url);
                    }
                })
            </script>';
    }
function success($msg,$location) {
        echo '<script>
                swal({
                    type: "success",
                    title: "สำเร็จ! ",
                    html: "' . $msg . '",
                    confirmButtonColor: "#e02b2b",
                    confirmButtonText: "<span style=\"font-family:Bai Jamjuree;\">ตกลง</span>",
                    confirmButtonClass: "btn btn-danger",
                }).then(function (isConfirm) {
                    if (isConfirm === true) {
                        var url = "'.$location.'";
                        $(location).attr("href", url);
                    } else {
                        var url = "'.$location.'";
                        $(location).attr("href", url);
                    }
                })
            </script>';
    }  