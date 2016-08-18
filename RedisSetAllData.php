<?php

ignore_user_abort();
set_time_limit(0);
$interval = 60;

do {

    header("content-type: text/html; charset=utf-8");

    $db = new PDO("mysql:host=localhost;dbname=SoccerData", "root", "");
    $db->exec("SET CHARACTER SET utf8");

    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);

    $sql = "SELECT * FROM  ` TodayRace`  ORDER BY  ` TodayRace`.`tID` ASC " ;
    $prepare = $db->prepare($sql);
    $prepare->execute();
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

    echo "執行此程式會將資料cache至redis<br>";

    if($result == NULL) {
        $redis->set('TodayRace_countTodayRace' , 0);
    }
    else {
        $i = 0 ;
        foreach($result as $list) {

            $redis->set('TodayRace_countTodayRace' , json_encode($list["countTodayRace"]));
            $redis->set('TodayRace_leagueRace_' . $i , json_encode($list["leagueRace"]));
            $redis->set('TodayRace_dateTime_' . $i , json_encode($list["dateTime"]));
            $redis->set('TodayRace_race_' . $i , json_encode($list["race"]));
            $redis->set('TodayRace_bToteWin_1_' . $i , json_encode($list["bToteWin_1"]));
            $redis->set('TodayRace_bToteWin_2_' . $i , json_encode($list["bToteWin_2"]));
            $redis->set('TodayRace_bToteWin_3_' . $i , json_encode($list["bToteWin_3"]));
            $redis->set('TodayRace_bGetTheBall_0_' . $i , json_encode($list["bGetTheBall_0"]));
            $redis->set('TodayRace_bGetTheBall_1_' . $i , json_encode($list["bGetTheBall_1"]));
            $redis->set('TodayRace_bGetTheBall_2_' . $i , json_encode($list["bGetTheBall_2"]));
            $redis->set('TodayRace_b_ouBigOrSmall_1_' . $i , json_encode($list["b_ouBigOrSmall_1"]));
            $redis->set('TodayRace_b_ouBigOrSmall_2_' . $i , json_encode($list["b_ouBigOrSmall_2"]));
            $redis->set('TodayRace_b_numBigOrSmall_1_' . $i , json_encode($list["b_numBigOrSmall_1"]));
            $redis->set('TodayRace_b_numBigOrSmall_2_' . $i , json_encode($list["b_numBigOrSmall_2"]));
            $redis->set('TodayRace_cSingle_' . $i , json_encode($list["cSingle"]));
            $redis->set('TodayRace_cDouble_' . $i , json_encode($list["cDouble"]));
            $redis->set('TodayRace_aToteWin_1_' . $i , json_encode($list["aToteWin_1"]));
            $redis->set('TodayRace_aToteWin_2_' . $i , json_encode($list["aToteWin_2"]));
            $redis->set('TodayRace_aToteWin_3_' . $i , json_encode($list["aToteWin_3"]));
            $redis->set('TodayRace_aGetTheBall_0_' . $i , json_encode($list["aGetTheBall_0"]));
            $redis->set('TodayRace_aGetTheBall_1_' . $i , json_encode($list["aGetTheBall_1"]));
            $redis->set('TodayRace_aGetTheBall_2_' . $i , json_encode($list["aGetTheBall_2"]));
            $redis->set('TodayRace_a_ouBigOrSmall_1_' . $i , json_encode($list["a_ouBigOrSmall_1"]));
            $redis->set('TodayRace_a_ouBigOrSmall_2_' . $i , json_encode($list["a_ouBigOrSmall_2"]));
            $redis->set('TodayRace_a_numBigOrSmall_1_' . $i , json_encode($list["a_numBigOrSmall_1"]));
            $redis->set('TodayRace_a_numBigOrSmall_2_' . $i , json_encode($list["a_numBigOrSmall_2"]));
            $i++;
        }
    }
    sleep($interval);
} while(true);
