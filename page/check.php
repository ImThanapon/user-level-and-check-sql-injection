<?php
    header('Content-Type: text/html; charset=utf-8');
    //strrev
    function utf8_strrev($str) {
        preg_match_all('/./us', $str, $ar);
        return join('', array_reverse($ar[0]));
    }
    function pass_encrypt($pass, $show = false) {
        //you secret word
        $key1    = 'asdfasf';
        $key2    = 'asdfasdf';
        $loop    = 1;
        $reverse = utf8_strrev($pass); //กลับการเรียงตัวอักษร

        if ($show == true) {
            // echo '<br> กลับตัวอักษร &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ', $reverse;
        }
        for ($i = 0; $i < $loop; $i++) {
            $md5 = md5($reverse);
            if ($show == true) {
                // echo '<br> เข้ารหัสเป็น 32 หลัก : ', $md5;
            }
            $reverse_md5 = utf8_strrev($md5);
            if ($show == true) {
                // echo '<br> กลับตัวอักษร &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ', $reverse_md5;
            }
            $salt = substr($reverse_md5, -13) . md5($key1) . substr($reverse_md5, 0, 19) . md5($key2);
            if ($show == true) {
                // echo '<br> สร้างข้อความใหม่ &nbsp;&nbsp;&nbsp; : ', $salt;
            }
            $new_md5 = md5($salt);
            if ($show == true) {
                // echo '<br> เข้ารหัสเป็น 32 หลัก : ', $new_md5;
            }
            $reverse = utf8_strrev($new_md5);
            if ($show == true) {
                // echo '<br> กลับตัวอักษรอีกครั้ง &nbsp;: ', $reverse;
            }
        }
        //เข้ารหัส md5
        return md5($reverse);
    }

?>