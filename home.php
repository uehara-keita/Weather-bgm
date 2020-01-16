<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>WST System</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>

<!--====== 標準時 ====-->
<?php
    //日本標準時に変更
    date_default_timezone_set('Asia/Tokyo');
    ?>

<!--====== 季節 ====-->
<?php
    $month = date('n'); // nは現在の月を1〜12の数字で返す。

    if((3 <= $month) && ($month <= 5)) {
        $season = "spring";
    } elseif((6 <= $month) && ($month <= 8)) {
        $season = "summer";
    } elseif((9 <= $month) && ($month <= 11)) {
        $season = "autumn";
    } elseif((12 == $month) || ($month <= 2)) {
        $season = "winter";
    }
    ?>

<!--====== 時間帯 ====-->
    <?php
    $hour = date('H');//Hは現在の時を0〜24の数値で返す。
    if((0 <= $hour) && ($hour < 4)) {
        $zone = "midnight";
    } elseif((4<= $hour) && ($hour < 6)) {
        $zone = "earlymorning";
    } elseif((6 <= $hour) && ($hour < 10)) {
        $zone = "morning";
    } elseif((10 <= $hour) && ($hour < 16)) {
        $zone = "noon";
    } elseif((17 <= $hour) && ($hour < 19)) {
        $zone = "evening";
    } elseif((19 <= $hour) && ($hour < 24)) {
        $zone = "night";
    }
    ?>

<!--====== ソース ====-->
<main>
    <div class="title">
        <h1>Back Ground Music for You</h1>
        <p>現在の天気・季節・時間にぴったりなBGMをお届けします</p>
    </div>

    <div class="form-search">
        <form method="GET" action="result.php">
            <div class="item-addr">
                <input type="text" name="pref" value="" required="required" placeholder="都道府県">
                <input type="text" name="city" value="" placeholder="市町村">
                <input type="text" name="dist" value="" placeholder="地域(区など)">
            </div>
            <div class="item-submit">
                <input type="submit" value="START">
                <input type="hidden" value=<?php echo $season; ?> name="season">
                <input type="hidden" value=<?php echo $zone; ?> name="zone">
            </div>
        </form>
    </div>
</main>

</body>
</html>