<?php
// header("content-type: text/html; charset=utf-8");

// // 1. 初始設定
// $ch = curl_init();

// // 2. 設定 / 調整參數
// curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/sports.php");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_HEADER, 0);

// // 3. 執行，取回 response 結果
// $pageContent = curl_exec($ch);

// // 4. 關閉與釋放資源
// curl_close($ch);

// $doc = new DOMDocument();
// libxml_use_internal_errors(true);
// $doc->loadHTML($pageContent);

// $xpath = new DOMXPath($doc);
// $entries = $xpath->query("//*[@id='game_table']/tbody/tr");
// //*[@id="game_table"]/tbody/tr[2]/td/table/tbody/tr/td[2]
// //*[@id="game_table"]/tbody/tr[6]/td/table/tbody/tr/td[2]
// //*[@id="game_table"]/tbody/tr[14]/td/table/tbody/tr/td[2]
// //*[@id="game_table"]/tbody/tr[22]/td/table/tbody/tr/td[2]

// foreach ($entries as $entry)
// {
//     $title = $xpath->query("./td/table/tbody/tr/td[2]", $entry);
//     echo "Title：" . $title->item(0)->nodeValue . "<br>";
// }



// header("content-type: text/html; charset=utf-8");

// // 1. 初始設定
// $ch = curl_init();

// // 2. 設定 / 調整參數
// curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/app/member/FT_browse/index.php");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_HEADER, 0);

// // 3. 執行，取回 response 結果
// $pageContent = curl_exec($ch);

// // 4. 關閉與釋放資源
// curl_close($ch);

// echo htmlspecialchars($pageContent);



header("content-type: text/html; charset=utf-8");
//網站
$url1 = 'http://www.228365365.com/sports.php';

// $url2 = 'http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&delay=&league_id=';

// 早
$url2 = 'http://www.228365365.com/app/member/FT_future/body_var.php?uid=test00&rtype=r&langx=zh-cn&g_date=ALL&mtype=3&league_id=';

//cookie
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,$url1);
curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__). '/cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HEADER,0);
$content = curl_exec($ch);

curl_setopt($ch, CURLOPT_URL,$url2);
curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HEADER,0);
$content = curl_exec($ch);

curl_close($ch);

// --------------------------------------------------------------------------------

// $test = substr($content,65);
$arr = explode('parent.GameFT', $content);
// echo count($arr) ;
// echo "<br><br>" ;

// echo $arr[1] ;

// $arrinside = explode(',', $arr[1]);

// for($i = 0; $i <= 37; $i++) {
//     $arrinside[$i] = str_replace("'", "", $arrinside[$i]);
// }

// echo "<br><br>" ;
// var_dump($arrinside);

// // trash
// echo "<br><br>" ;
// var_dump($arrinside[0]);

// // 時間
// echo "<br><br>" ;
// var_dump($arrinside[1]);

// echo "<br><br>" ;
// $arrinsideTime = explode('<br>', $arrinside[1]);
// echo $arrinsideTime[0];
// echo "    " ;
// echo $arrinsideTime[1];

// // 聯賽
// echo "<br><br>" ;
// echo $arrinside[2];

// // 賽事
// echo "<br><br>" ;
// echo $arrinside[5];
// echo "<br>" ;
// echo $arrinside[6];

// //


// $arrinside = explode(',', $arr[4]);

// for($i = 0; $i <= 37; $i++) {
//     $arrinside[$i] = str_replace("'", "", $arrinside[$i]);
// }

// echo "<br><br>" ;
// var_dump($arrinside);


/**
* 將資料寫進資料庫
*/

$db = new PDO("mysql:host=localhost;dbname=SoccerData", "root", "");
$db->exec("SET CHARACTER SET utf8");

for($i = 1; $i < count($arr); $i++) {

    $arrinside = explode(',', $arr[$i]);

    for($j = 0; $j <= 37; $j++) {
        $arrinside[$j] = str_replace("'", "", $arrinside[$j]);
    }

    // echo "<br><br>" ;
    // var_dump($arrinside);

    // echo "<br><br>" ;
    // var_dump($arrinside[1]);

    // 當下賽事數
    $countTodayRace = count($arr) - 1;

    // 時間
    // echo "<br><br>" ;
    $arrinsideTime = explode('<br>', $arrinside[1]);
    $datetime = $arrinsideTime[0] . " " . $arrinsideTime[1];

    // 賽事
    // echo "<br><br>" ;
    $race = $arrinside[5] . "," . $arrinside[6];



    $sql ="INSERT INTO `SoccerData`.` TodayRace` (
        `tID`,
        `countTodayRace`,
        `leagueRace`,
        `dateTime`,
        `race`,
        `bToteWin_1`,
        `bToteWin_2`,
        `bToteWin_3`,
        `bGetTheBall_0`,
        `bGetTheBall_1`,
        `bGetTheBall_2`,
        `b_ouBigOrSmall_1`,
        `b_ouBigOrSmall_2`,
        `b_numBigOrSmall_1`,
        `b_numBigOrSmall_2`,
        `cSingle`,
        `cDouble`,
        `aToteWin_1`,
        `aToteWin_2`,
        `aToteWin_3`,
        `aGetTheBall_0`,
        `aGetTheBall_1`,
        `aGetTheBall_2`,
        `a_ouBigOrSmall_1`,
        `a_ouBigOrSmall_2`,
        `a_numBigOrSmall_1`,
        `a_numBigOrSmall_2`)
        VALUES (
        NULL,
        :countTodayRace,
        :leagueRace,
        :dateTime,
        :race,
        :bToteWin_1,
        :bToteWin_2,
        :bToteWin_3,
        :bGetTheBall_0,
        :bGetTheBall_1,
        :bGetTheBall_2,
        :b_ouBigOrSmall_1,
        :b_ouBigOrSmall_2,
        :b_numBigOrSmall_1,
        :b_numBigOrSmall_2,
        :cSingle,
        :cDouble,
        :aToteWin_1,
        :aToteWin_2,
        :aToteWin_3,
        :aGetTheBall_0,
        :aGetTheBall_1,
        :aGetTheBall_2,
        :a_ouBigOrSmall_1,
        :a_ouBigOrSmall_2,
        :a_numBigOrSmall_1,
        :a_numBigOrSmall_2);";

    $prepare = $db->prepare($sql);
    $prepare->bindParam(':countTodayRace', $countTodayRace);
    $prepare->bindParam(':leagueRace', $arrinside[2]);
    $prepare->bindParam(':dateTime', $datetime);
    $prepare->bindParam(':race', $race);
    $prepare->bindParam(':bToteWin_1', $arrinside[15]);
    $prepare->bindParam(':bToteWin_2', $arrinside[16]);
    $prepare->bindParam(':bToteWin_3', $arrinside[17]);
    $prepare->bindParam(':bGetTheBall_0', $arrinside[8]);
    $prepare->bindParam(':bGetTheBall_1', $arrinside[9]);
    $prepare->bindParam(':bGetTheBall_2', $arrinside[10]);
    $prepare->bindParam(':b_ouBigOrSmall_1', $arrinside[11]);
    $prepare->bindParam(':b_ouBigOrSmall_2', $arrinside[12]);
    $prepare->bindParam(':b_numBigOrSmall_1', $arrinside[14]);
    $prepare->bindParam(':b_numBigOrSmall_2', $arrinside[13]);
    $prepare->bindParam(':cSingle', $arrinside[20]);
    $prepare->bindParam(':cDouble', $arrinside[21]);
    $prepare->bindParam(':aToteWin_1', $arrinside[31]);
    $prepare->bindParam(':aToteWin_2', $arrinside[32]);
    $prepare->bindParam(':aToteWin_3', $arrinside[33]);
    $prepare->bindParam(':aGetTheBall_0', $arrinside[24]);
    $prepare->bindParam(':aGetTheBall_1', $arrinside[25]);
    $prepare->bindParam(':aGetTheBall_2', $arrinside[26]);
    $prepare->bindParam(':a_ouBigOrSmall_1', $arrinside[27]);
    $prepare->bindParam(':a_ouBigOrSmall_2', $arrinside[28]);
    $prepare->bindParam(':a_numBigOrSmall_1', $arrinside[30]);
    $prepare->bindParam(':a_numBigOrSmall_2', $arrinside[29]);

    $prepare->execute();
}

// for($i = 1; $i < count($arr) ;$i++) {
//     $newarr[$i] = explode(',',$arr[$i]);
//     var_dump($newarr[$i]);
//     // echo $newarr[$i] . "<br>" ;
// }



// $arr = explode('</font>', $content);
// // $num = var_dump($arr);

// for($i = 1; $i < count($arr) ;$i++) {
//     // $arrinside = explode(',', $arr);
//     var_dump($arr[$i]);
//     // echo $arr[$i] ;
//     echo "<br><br>" ;
// }



// echo "<iframe>";
// echo $content;
// echo "</iframe>";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="60;url='ReadSoccerData.php'; charset=UTF-8" />
    </head>
    <body>
        此網頁每60秒會重整一次
    </body>
</html>