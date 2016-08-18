<?php
header("content-type: text/html; charset=utf-8");

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$count = json_decode($redis->get("TodayRace_countTodayRace"));

echo "<table border = '1' width = '100%' style = 'text-align:center'>";
echo "<tr>";
echo "  <tr>";
echo "      <td colspan = '9' width = '100%'>聯賽</td>";
echo "  </tr>";
echo "  <tr>";
echo "      <td width = '10%'>時間</td>";
echo "      <td width = '20%'>賽事</td>";
echo "      <td width = '10%'>獨贏</td>";
echo "      <td width = '10%'>全場-讓球</td>";
echo "      <td width = '10%'>全場-大小</td>";
echo "      <td width = '10%'>單雙</td>";
echo "      <td width = '10%'>獨贏</td>";
echo "      <td width = '10%'>全場-讓球</td>";
echo "      <td width = '10%'>全場-大小</td>";
echo "  </tr>";

// echo "  <tr>";
// echo "      <td rowspan = '3' width = '10%'></td>";
// echo "      <td rowspan = '3' width = '20%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "  </tr>";
// echo "  <tr>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td width = '10%'></td>";
// echo "  </tr>";
// echo "  <tr>";
// echo "      <td width = '10%'></td>";
// echo "      <td colspan = '3' width = '30%'></td>";
// echo "      <td width = '10%'></td>";
// echo "      <td colspan = '2' width = '20%'></td>";
// echo "  </tr>";
// echo "</tr>";

if($count == 0) {
    echo "  <tr>";
    echo "      <td colspan = '9' width = '100%'>" . 目前沒有比賽 . "</td>";
    echo "  </tr>";
}
else {
    for($i = 0 ;$i < $count; $i++) {

        $time = explode(' ', json_decode($redis->get("TodayRace_dateTime_" . $i)));
        $team = explode(',', json_decode($redis->get("TodayRace_race_" . $i)));

        echo "  <tr>";
        echo "      <td colspan = '9' width = '100%'>" . json_decode($redis->get("TodayRace_leagueRace_" . $i)) . "</td>";
        echo "  </tr>";
        echo "  <tr>";
        echo "      <td rowspan = '3' width = '10%'>" . $time[0] . "<br>" . $time[1] . "</td>";
        echo "      <td rowspan = '3' width = '20%'>" . $team[0] . "<br>" . $team[1] . "</td>";
        echo "      <td width = '10%'>" . json_decode($redis->get("TodayRace_bToteWin_1_" . $i)) . "</td>";
        echo "      <td width = '10%' style = 'text-align:right'>" . json_decode($redis->get("TodayRace_bGetTheBall_0_" . $i)) . "　　" . json_decode($redis->get("TodayRace_bGetTheBall_1_" . $i)) . "</td>";
        echo "      <td width = '10%' style = 'text-align:right'>" . json_decode($redis->get("TodayRace_b_ouBigOrSmall_1_" . $i)) . "　　" . json_decode($redis->get("TodayRace_b_numBigOrSmall_1_" . $i)) . "</td>";
        echo "      <td width = '10%'>單　" . json_decode($redis->get("TodayRace_cSingle_" . $i)) . "</td>";
        echo "      <td width = '10%'>" . json_decode($redis->get("TodayRace_aToteWin_1_" . $i)) . "</td>";
        echo "      <td width = '10%' style = 'text-align:right'>" . json_decode($redis->get("TodayRace_aGetTheBall_0_" . $i)) . "　　" . json_decode($redis->get("TodayRace_aGetTheBall_1_" . $i)) . "</td>";
        echo "      <td width = '10%' style = 'text-align:right'>" . json_decode($redis->get("TodayRace_a_ouBigOrSmall_1_" . $i)) . "　　" . json_decode($redis->get("TodayRace_a_numBigOrSmall_1_" . $i)) . "</td>";
        echo "  </tr>";
        echo "  <tr>";
        echo "      <td width = '10%'>" . json_decode($redis->get("TodayRace_bToteWin_2_" . $i)) . "</td>";
        echo "      <td width = '10%' style = 'text-align:right'>" . json_decode($redis->get("TodayRace_bGetTheBall_2_" . $i)) . "</td>";
        echo "      <td width = '10%' style = 'text-align:right'>" . json_decode($redis->get("TodayRace_b_ouBigOrSmall_2_" . $i)) . "　　" . json_decode($redis->get("TodayRace_b_numBigOrSmall_2_" . $i)) . "</td>";
        echo "      <td width = '10%'>雙　" . json_decode($redis->get("TodayRace_cDouble_" . $i)) . "</td>";
        echo "      <td width = '10%'>" . json_decode($redis->get("TodayRace_aToteWin_2_" . $i)) . "</td>";
        echo "      <td width = '10%' style = 'text-align:right'>" . json_decode($redis->get("TodayRace_aGetTheBall_2_" . $i)) . "</td>";
        echo "      <td width = '10%' style = 'text-align:right'>" . json_decode($redis->get("TodayRace_a_ouBigOrSmall_2_" . $i)) . "　　" . json_decode($redis->get("TodayRace_a_numBigOrSmall_2_" . $i)) . "</td>";
        echo "  </tr>";
        echo "  <tr>";
        echo "      <td width = '10%'>" . json_decode($redis->get("TodayRace_bToteWin_3_" . $i)) . "</td>";
        echo "      <td colspan = '3' width = '30%'></td>";
        echo "      <td width = '10%'>" . json_decode($redis->get("TodayRace_aToteWin_3_" . $i)) . "</td>";
        echo "      <td colspan = '2' width = '20%'></td>";
        echo "  </tr>";
    }
    echo "</tr>";
}