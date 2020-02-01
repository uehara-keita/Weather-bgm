<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>W-BGM System</title>
    <link rel="stylesheet" type="text/css" href="./css/sample.css">
</head>

<body>

<!--====== 標準時 ====-->
<?php
    //日本標準時に変更
    date_default_timezone_set('Asia/Tokyo');
    ?>

<!--====== ソース ====-->
<main>
    <div class="title">
        <h1>Back Ground Music for You (動作確認)</h1>
        <p>現在の天気情報とあなたに最適なBGMをお届けします</p>
    </div>

    <div class="form-search">
        <form method="GET" action="sample_result.php">
            <div class="item-addr">
                <input type="text" name="pref" value="" required="required" placeholder="都道府県">
                <input type="text" name="city" value="" placeholder="市町村">
                <input type="text" name="dist" value="" placeholder="地域(区など)">
            </div>
            <ul class="item-weather set">
                <li>晴れ<input type ="radio" name="weather" value="晴れ"></li>
                <li>雨<input type ="radio" name="weather" value="雨"></li>
            </ul>
            <ul class="item-season set" > 
                <li>春<input type ="radio" name="season" value="spring"></li>
                <li>夏<input type ="radio" name="season" value="summer"></li>
                <li>秋<input type ="radio" name="season" value="autumn"></li>
                <li>冬<input type ="radio" name="season" value="winter"></li>
            </ul>
            <ul class="item-zone set"> 
                <li>深夜<input type ="radio" name="zone" value="midnight"></li>
                <li>早朝<input type ="radio" name="zone" value="earlymorning"></li>
                <li>朝<input type ="radio" name="zone" value="morning"></li>
                <li>昼<input type ="radio" name="zone" value="noon"></li>
                <li>夕方<input type ="radio" name="zone" value="evening"></li>
                <li>夜<input type ="radio" name="zone" value="night"></li>
            </ul>
            <div class="item-submit">
                <input type="submit" value="START">
            </div>
        </form>
    </div>
</main>

</body>
</html>