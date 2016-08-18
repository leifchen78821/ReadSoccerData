<?php
	$redis = new Redis();
	$redis->connect('127.0.0.1', 6379);
	$redis->set("foo", "bar");
	echo $redis->get("foo");


 // header("content-type: text/html; charset=utf-8");
 //   //網站
 //   // 主網頁
 //   $url1 = 'http://www.228365365.com/sports.php';
 //   // 子網頁 今日賽事(頁框)
 //   $url2 = 'http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&delay=&league_id=';
 //   // 早場 測試用
 //   // $url2 = 'http://www.228365365.com/app/member/FT_future/body_var.php?uid=test00&rtype=r&langx=zh-cn&g_date=ALL&mtype=3&league_id=';

 //   // 初始化
 //   $ch = curl_init();

 //   // 設置請求選項
 //   curl_setopt($ch, CURLOPT_URL,$url1);
 //   curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__). '/cookie.txt');
 //   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
 //   curl_setopt($ch, CURLOPT_HEADER,0);

 //   // 執行一個cURL並且獲取相關回復
 //   $content = curl_exec($ch);

 //   // 設置請求選項
 //   curl_setopt($ch, CURLOPT_URL,$url2);
 //   curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/cookie.txt');
 //   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
 //   curl_setopt($ch, CURLOPT_HEADER,0);

 //   // 執行一個cURL並且獲取相關回復
 //   $content = curl_exec($ch);

 //   // 關閉cURL
 //   curl_close($ch);

 //   // --------------------------------------------------------------------------------

 //   $arr = explode('parent.GameFT', $content);

 //   // echo "<br><br>" ;
 //   // var_dump($arr);

 //   for($i = 1; $i < count($arr); $i++) {

 //       $arrinside = explode(',', $arr[$i]);

 //       for($j = 0; $j <= 37; $j++) {
 //           $arrinside[$j] = str_replace("'", "", $arrinside[$j]);
 //       }

 //       echo "<br><br>" ;
 //       var_dump($arrinside);
 //   }
?>