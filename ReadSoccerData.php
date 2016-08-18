<?php

ignore_user_abort();
set_time_limit(0);
$interval = 60;

do {

    header("content-type: text/html; charset=utf-8");
    //網站
    // 主網頁
    $url1 = 'http://www.228365365.com/sports.php';
    // 子網頁 今日賽事(頁框)
    $url2 = 'http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&delay=&league_id=';
    // 早場 測試用
    // $url2 = 'http://www.228365365.com/app/member/FT_future/body_var.php?uid=test00&rtype=r&langx=zh-cn&g_date=ALL&mtype=3&league_id=';

    // 初始化
    $ch = curl_init();

    // 設置請求選項
    curl_setopt($ch, CURLOPT_URL,$url1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__). '/cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER,0);

    // 執行一個cURL並且獲取相關回復
    $content = curl_exec($ch);

    // 設置請求選項
    curl_setopt($ch, CURLOPT_URL,$url2);
    curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER,0);

    // 執行一個cURL並且獲取相關回復
    $content = curl_exec($ch);

    // 關閉cURL
    curl_close($ch);

    // --------------------------------------------------------------------------------

    $arr = explode('parent.GameFT', $content);

    // echo "<br><br>" ;
    // var_dump($arrinside);

    /**
    * 將資料寫進資料庫
    */

    $db = new PDO("mysql:host=localhost;dbname=SoccerData", "root", "");
    $db->exec("SET CHARACTER SET utf8");

    $sql ="DELETE FROM `SoccerData`.` TodayRace`";
    $prepare = $db->prepare($sql);
    $prepare->execute();

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

    sleep($interval);
} while(true);
