<?php
    header('Content-Type: text/html; charset=utf-8');
    $index = (string)$_GET['id'];

    $str = file_get_contents("./test.txt");

    function reading($file_str, $team){
    $arr_str = explode("\n", $file_str);

    foreach($arr_str as $k=>$elem) {
        list($teamName) = explode(" ", $elem);

        if($teamName == $team){
            echo "Данные о команде ".$teamName." удалена \n";
            echo "<a href='index.php'>На главную</a>";
            unset($arr_str[$k]);
        }
    }
    $arr_str = implode("\n", $arr_str);
    file_put_contents("./test.txt",$arr_str);

    return $arr_str;
    }

    reading($str, $index);
?>