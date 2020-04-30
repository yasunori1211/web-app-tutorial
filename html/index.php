<?php

define('FILENAME', './message.txt');

date_default_timezone_set('Asia/Tokyo');

$now_date =null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();

if( !empty($_POST['btn_submit']) ) {
    if($file_handle = fopen(FILENAME, "a")){

        $now_date = date("Y-m-d H:i:s");

        $data = "'".$_POST['view_name']."','".$_POST[ 'message' ]."','".$now_date."'\n";

        fwrite($file_handle, $data);
            
        fclose($file_handle);
        // var_dump($_POST);
    }
}

if($file_handle = fopen(FILENAME, 'r')){
    while($data = fgets($file_handle)){

        $split_data = preg_split('/\'/', $data);

        $message = array(
            'view_name' => $split_data[1],
            'message' => $split_data[3],
            'post_date' => $split_data[5]
        );
        array_unshift($message_array, $message);
    }

    fclose($file_handle);
}
?>
<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <link rel='stylesheet' href='./style.css'>
        <title>Music App Tutorial</title>
    </head>
    <body>
        <div class="player">
            <audio class="song" src="sounds/ocean_sunset.mp3" loop></audio>
            <div class="player-timer">
                <svg class="player-timer-circle player-timer-track-circle" width="220" height="220" viewBox="0 0 220 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="110" cy="110" r="108.5" stroke="white" stroke-width="3"/>
                </svg>
                <svg class="player-timer-circle player-timer-moving-circle" width="220" height="220" viewBox="0 0 220 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="110" cy="110" r="108.5" stroke="#B7B7B7" stroke-width="3"/>
                </svg>
                <img src="svg/play.svg" alt="" class="player-timer-btn"/>
                <h3 class="timeDisplay">0:00</h3>
            </div>
        </div>
        <div class="selection">
            <span class="selection-bar"></span>
            <div class="title">
                <p class="title-headline">南国のせせらぎ ~フィジー~</p>
                <p class="title-description">
                    海辺の音, Sound of Sea
                </p>
            </div>
            <div class="soundList">
                <div class="soundList-item" data-sound="sounds/morning_forest.mp3" data-image="img/road.jpg" data-time="120" >
                    <img src="img/road.jpg" alt="" class="soundList-image" />
                    <div class="soundList-text">
                        <span class="soundList-title">爽やかな鳥の声 ~山中湖~</span>
                        <span class="soundList-description">Morning birds, Lake Yamanaka</span>
                    </div>
                </div>
                <div class="soundList-item" data-sound="sounds/ocean_sunset.mp3" data-image="img/ocean.jpg" data-time="60" >
                    <img src="img/ocean.jpg" alt="" class="soundList-image" />
                    <div class="soundList-text">
                        <span class="soundList-title">南国のせせらぎ ~フィジー~</span>
                        <span class="soundList-description">海辺の音, Sound of Sea</span>
                    </div>
                </div>
                <div class="soundList-item" data-sound="sounds/night_forest.mp3" data-image="img/night-forest.jpg" data-time="180" >
                    <img src="img/night-forest.jpg" alt="" class="soundList-image" />
                    <div class="soundList-text">
                        <span class="soundList-title">夜の森 ~群馬県沼田~</span>
                        <span class="soundList-description">Sounds of insects, Star in the forest</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment">
            <h1> ひとこと掲示板</h1>
            <form method="post">
                <div>
                    <label for="view_name">表示名</label>
                    <input id="view_name" type="text" name="view_name" value="">
                </div>
                <div>
                    <label for="message">一言メッセージ</label>
                    <textarea id="message" name="message"></textarea>
                </div>
                <input type="submit" name="btn_submit" value="書き込む">
            </form>
            <hr>
            <section>
                <?php if(!empty($message_array)): ?>
                <?php foreach($message_array as $value): ?>
                <article>
                    <div class="info">
                        <h2><?php echo $value['view_name']; ?></h2>
                        <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
                    </div>
                    <p><?php echo $value['message']; ?></p>
                </article>
                <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </div>
        <script src='./app.js'></script>
    </body>
</html>

