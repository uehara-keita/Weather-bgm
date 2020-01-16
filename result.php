<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>おてんきAPI</title>
    <link rel="stylesheet" type="text/css" href="./css/result.css">

    <!--========== 背景画像の切り替え ==========-->
    #時間帯情報の取得
    <?php $zone = @$_GET['zone']; ?>

    <?php if($zone=="midnight") { ?>
        <link rel="stylesheet" href="./css/midnight.css">
    <?php } else if ($zone=="earlymorning") { ?>
        <link rel="stylesheet" href="./css/earlymorning.css">
    <?php } else if ($zone=="morning") { ?>
        <link rel="stylesheet" href="./css/morning.css">
    <?php } else if ($zone=="noon") { ?>
        <link rel="stylesheet" href="./css/noon.css">
    <?php } else if ($zone=="evening") { ?>
        <link rel="stylesheet" href="./css/evening.css">
    <?php } else{ ?>
        <link rel="stylesheet" href="./css/night.css">
    <?php } ?>

</head>

<!--========== 前ページからのデータ取得 ==========-->
<?php
    #住所情報の取得
    $pref = @$_GET['pref'];
    $city = @$_GET['city'];
    $dist = @$_GET['dist'];
    #住所として統合
    $addr = $pref.$city.$dist;

    #天気情報の取得
    $season = @$_GET['season'];
?>

<!--========== 住所から緯度経度に変換 ==========-->
<?php
    #xmlデータの取得
    $q = $addr;
    #リクエストURL
    $req_g = "http://www.geocoding.jp/api/?q=".$addr;
    $xml= simplexml_load_file($req_g);

    # 緯度経度の抽出
    $lat = (string) $xml->coordinate->lat;
    $lng = (string) $xml->coordinate->lng;
?>

<!--========== 天気情報処理 ==========-->
<?php
    #darkskyのAPIkey
    $key = "XXXXXXXXXXXXXXXXXXXXX"
    #リクエストURL
    $req_d = "https://api.darksky.net/forecast/".$key."/".$lat.",".$lng."?units=si&lang=ja&exclude=alerts,flags";

    //↓格納したURLをjsonに
    $json = file_get_contents($req_d);
    $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
   
    //↓JSONデータを連想配列に
    $arr = json_decode($json,true);

    $currentTemperature = $arr["currently"]["apparentTemperature"];
    $humidity = $arr["currently"]["humidity"];
    $currentWeather = $arr["currently"]["summary"];
    $precipProbability = $arr["currently"]["precipProbability"];
    $windSpeed = $arr["currently"]["windSpeed"];
    $cloudCover = $arr["currently"]["cloudCover"];
   
?>

<!--========== ソース ==========-->
<body>
    /*天気情報の表示*/
    <div class=list-info>
        <ul>
            <li> <span class="addr-info"> <?php echo $addr; ?> </span> </li>
            <li>天気 <?php echo $currentWeather; ?></li>
            <li>気温 <?php echo $currentTemperature; ?>℃</li>
            <li>湿度 <?php echo $humidity*100; ?>％</li>
            <li>降水確率 <?php echo $precipProbability*100; ?>％</li>
            <li>風の強さ <?php echo $windSpeed; ?>m</li>
            <li>雲の割合 <?php echo $cloudCover*100; ?>％</li>
            <li>季節 <?php echo $season; ?></li>
            <li>時間帯 <?php echo $zone; ?></li>
        </ul>
    </div>
    /*戻る*/
    <form method="GET" action="home.php">
        <div class=button-back>
            <input type="submit" value="戻る">
        </div>
    </form>
    /*Youtube動画の表示*/
    <div class=youtube>
        /*YouTube動画の埋め込み*/
        <iframe width="768" height="432" src="<?php id($season,$zone,$currentWeather); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

<!--========== Youtube動画の切り替え ==========-->
<?php
    function id($s,$z,$w){

        #共通BGM
        $morn = array(
            "https://www.youtube.com/embed/eCNU9rqO2C4",
            "https://www.youtube.com/embed/ZeWOWjh8eZI",
            "https://www.youtube.com/embed/cPzzTVSqdjk",
        );
        $noon = array(
            "https://www.youtube.com/embed/YwRQlyL7f1s",
            "https://www.youtube.com/embed/m8tJzWLyvlE",
            "https://www.youtube.com/embed/fY_3cf1zlI0",
            

        );
        $evening = array(
            "https://www.youtube.com/embed/2DoCEM_A4zA",
            "https://www.youtube.com/embed/gzOJivYwZDA",
            "https://www.youtube.com/embed/d9Wtjaq8dYA",

        );
        $night = array(
            "https://www.youtube.com/embed/gMUWQJtNMNQ",
            "https://www.youtube.com/embed/bwXtEMEWEAk",
            "https://www.youtube.com/embed/Tq0IQq5Fjj8",

        );

        # rain
        $rain = "/雨/";
        if(preg_match($rain, $w)){

            if($z=="earlymorning"||$z=="morning"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/mJxfJpMUA2g",
                );
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="noon"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/QY8knxU1E38",
                );
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="evening"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/inD9VRCELxo",
                );
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            else{
                $bgm_rand = array(
                    "https://www.youtube.com/embed/_GQ9e2kgrlY",
                );
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
        }
        #spring
        elseif($s=="spring"){

            if($z=="earlymorning"||$z=="morning"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/Kn5zQpYVvsE",
                );
                $bgm_rand = array_merge($bgm_rand, $morn);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="noon"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/ohbQUplBr-g",
                );
                $bgm_rand = array_merge($bgm_rand, $noon);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="evening"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/uENs--mlvsI",
                );
                $bgm_rand = array_merge($bgm_rand, $evening);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            else{
                $bgm_rand = array(
                    "https://www.youtube.com/embed/fiV-6UXEq8g",
                );
                $bgm_rand = array_merge($bgm_rand, $night);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
        }
        #summer
        elseif($s=="summer"){

            if($z=="earlymorning"||$z=="morning"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/Z_sxQPiqPug",
                    "https://www.youtube.com/embed/uWjh3dZQVxQ",
                );
                
                $bgm_rand = array_merge($bgm_rand, $morn);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="noon"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/dlZ8qPd65m4",
                );
                $bgm_rand = array_merge($bgm_rand, $noon);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="evening"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/kkZZWdBU0kI",
                );
                $bgm_rand = array_merge($bgm_rand, $evening);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            else{
                $bgm_rand = array(
                    "https://www.youtube.com/embed/H5M_RS-1t0k",
                    "https://www.youtube.com/embed/LANsZpYG2GM",
                );
                $bgm_rand = array_merge($bgm_rand, $night);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
        }
        #autumn
        elseif($s=="autumn"){

            if($z=="earlymorning"||$z=="morning"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/JvUa5dgOVn4",
                );
                $bgm_rand = array_merge($bgm_rand, $morn);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="noon"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/L1Cx9Rn6swQ",
                );
                $bgm_rand = array_merge($bgm_rand, $noon);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="evening"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/ZRMcAt8OLPE",
                );
                $bgm_rand = array_merge($bgm_rand, $evening);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            else{
                $bgm_rand = array(
                    "https://www.youtube.com/embed/fQzjqT8zH8U",
                );
                $bgm_rand = array_merge($bgm_rand, $night);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
        }
        #winter
        else{

            if($z=="earlymorning"||$z=="morning"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/R2ixTcmg7tA",
                );
                $bgm_rand = array_merge($bgm_rand, $morn);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="noon"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/e79Ccevvxzk",
                    "https://www.youtube.com/embed/lqnDB28eXvw",
                );
                $bgm_rand = array_merge($bgm_rand, $noon);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
            elseif($z=="evening"){
                $bgm_rand = array(
                    "https://www.youtube.com/embed/gzOJivYwZDA",
                );
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                $bgm_rand = array_merge($bgm_rand, $evening);
                echo $bgm_rand;
            }
            else{
                $bgm_rand = array(
                    "https://www.youtube.com/embed/nYByRtOO9BU",
                );
                $bgm_rand = array_merge($bgm_rand, $night);
                $bgm_rand = $bgm_rand[random_int(0, count($bgm_rand)-1)];
                echo $bgm_rand;
            }
        }
    }

?>
</body>
</html>