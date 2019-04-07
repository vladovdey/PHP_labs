<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>
<body>
    <h1>Лабораторная работа 2</h1>
    <div class="buttons">
    <a>Добавить</a>
    <a>Выполнить</a>
    </div>
    <div class="table">
    <table>
        <tr>
            <th class="headers">Название команды</th>
            <th class="headers">Количество выигрышей</th>
            <th class="headers">Количество проигрышей</th>
            <th class="headers">Количество ничьих</th>
            <th class="headers">Количество нарушений</th>
            <th class="headers">Количество очков</th>
        </tr>
    <?php
        $result = array();
        $str = file_get_contents('./test.txt');//Reading file

        //Array separation on worlds, parts
        function reading($file_str){
        $arr_str = explode("\n", $file_str);
        $fullArray = array();

        foreach($arr_str as $k=>$elem) {
            list($teamName,$wins,$loses,$draws,$fouls) = explode(" ", $elem);
            $points = ($wins*3+$loses*-3)+$draws;

            $fullArray[] = [
                "team" => $teamName,
                "wins" => $wins,
                "loses" => $loses,
                "draws" => $draws,
                "fouls" => $fouls,
                "points" => $points
            ];
        }
        return $fullArray;
    }

        //Bubble sort
        function sorter($array){
            for ($j = 0; $j < count($array) - 1; $j++){
                for ($i = 0; $i < count($array) - $j - 1; $i++){
                    if ($array[$i]['points'] < $array[$i + 1]['points']){
                        $tmp_var = $array[$i + 1];
                        $array[$i + 1] = $array[$i];
                        $array[$i] = $tmp_var;
                    }
                }
            }
            return $array;
        }

        //Function for display file
        function display_file($resultArray){
            foreach ($resultArray as $i => $elem){
                echo "<tr>";

                echo "<th>"
                    .$resultArray[$i]['team']."</th><th>"
                    .$resultArray[$i]['wins']. "</th><th>"
                    .$resultArray[$i]['loses']. "</th><th>"
                    .$resultArray[$i]['draws']. "</th><th>"
                    .$resultArray[$i]['fouls']. "</th><th>"
                    .$resultArray[$i]['points']. "</th>";

                echo '<th> <a href="/add.php?id='.$i.'">Изменить</a> <a href="/del.php?id='.$resultArray[$i]['team'].'">Удалить</a> </th>';

                echo "</tr>";
            }

        }
    
        $fullArray = reading($str);
        $result = sorter($fullArray);
        display_file($result);

    ?>
    </table>    
    </div>
    
</body>
</html>