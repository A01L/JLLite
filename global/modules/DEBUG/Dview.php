<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error notice | DEBUG</title>
</head>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap');

body {
    font-family: 'Montserrat', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #3067D4;
    color: #2b2b2bfff;
}

.main {
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.title__err {
    font-weight: 900;
    font-size: 70px;
}

.subtitle__err {
    font-size: 20px;
    max-width: 90%;
    text-align: center;
    padding: 7px;
}

.return {
    text-decoration: none;
    color: #2b2b2bfff;
    margin-top: 40px;
    padding: 20px;
    background-color: #78a5fd;
    border-radius: 30px;

    transition: .1s ease;
}

.return:hover {
    background-color: #0aa1f1;
}
.orange{
    background-color: orange;
    padding: 5px;
    border-radius: 5px;
}
.red{
    background-color: red;
    margin-left: 5px;
    padding: 5px;
    border-radius: 5px;
}
.purple{
    background-color: purple;
    margin-left: 5px;
    padding: 5px;
    border-radius: 5px;
}
.syst{
    border: 3px dotted white;
    margin-left: 5px;
    padding: 2px;
    border-radius: 5px;
}
.msg{
    background-color: #2b2b2b;
    padding: 3px;
    border-radius: 5px;
    color: #3067D4;
}
</style>

<?php
if($errno == 1){
    $type = 'FATAL';
    $color = 'red';
}
elseif($errno == 8){
    $type = 'NOTICE';
    $color = 'orange';
}
else{
    $type = 'UNKOWN';
    $color = 'purple';
}
?>

<body>
    <div class="main">
        
<a target="_blank" href="https://github.com/A01L/JetLine" style="text-decoration: none; color: #2b2b2b; position: absolute; top: 10px; left: 2%;"><h2><svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;" viewBox="0 0 66.52 61.6725" width="40px"><defs><style>.cls-1{fill:#2b2b2b;}</style></defs><g id="Слой_2" data-name="Слой 2"><path class="cls-1" d="M82.3545,39.288a21.9924,21.9924,0,0,1-5.34,14.41c0,.01-.02.03-.03.05a.2189.2189,0,0,1-.04.05l-2.26,2.25a17.12,17.12,0,0,1-1.57,1.24,5.5685,5.5685,0,0,1-.96,1.28l-14.99,15-3.49,3.49a5.95,5.95,0,0,1-10.16-4.21,5.91,5.91,0,0,1,1.74-4.21l3.49-3.49,7.86-7.86.03-.03a2.0651,2.0651,0,0,0-2.93-2.91l-.02.02-4.29,4.29-3.77,3.77a5.9539,5.9539,0,0,1-8.42-8.42l3.73-3.72a.01.01,0,0,1-.01-.01l6.18-6.18a2.0642,2.0642,0,0,0,0-2.91l-.19-.19a2.0642,2.0642,0,0,0-2.91,0l-4.97,4.97-13.05,13.05a5.9539,5.9539,0,0,1-8.42-8.42l4.12-4.12,14.37-14.37,7.6-7.59,1.7-1.71.03-.03a22.1727,22.1727,0,0,1,36.97,16.51Z" transform="translate(-15.8345 -17.1179)"/></g></svg> &nbsp; Jet Line v0.7</h2></a>
        <div class="title__err">DEBUG</div>
        <div class="subtitle__err"><?php echo "<span class='".$color."'>".$type."</span> <span class='syst'>Conflict in :</span> <span class='orange'>".$errfile."</span><span class='red'>Line: ".$errline."</span>"; ?></div>
        <div class="subtitle__err"><?php echo "<span class='msg'>".$errstr."</span>"; ?></div>

        <div class="subtitle__err" style="border: 3px solid white; padding: 10px 15px 5px 15px; border-radius: 50px; margin-top: 30px;">
            <a target="_blank" href="https://www.google.com/search?q=<?=urlencode($errstr)?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="50px" height="50px"><g fill="#2b2b2bfff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M25.99609,48c-12.68359,0 -23.00391,-10.31641 -23.00391,-23c0,-12.68359 10.32031,-23 23.00391,-23c5.74609,0 11.24609,2.12891 15.49219,5.99609l0.77344,0.70703l-7.58594,7.58594l-0.70312,-0.60156c-2.22656,-1.90625 -5.05859,-2.95703 -7.97656,-2.95703c-6.76562,0 -12.27344,5.50391 -12.27344,12.26953c0,6.76563 5.50781,12.26953 12.27344,12.26953c4.87891,0 8.73438,-2.49219 10.55078,-6.73828h-11.55078v-10.35547l22.55078,0.03125l0.16797,0.79297c1.17578,5.58203 0.23438,13.79297 -4.53125,19.66797c-3.94531,4.86328 -9.72656,7.33203 -17.1875,7.33203z"></path></g></g></svg></a>
            <a target="_blank" href="https://yandex.kz/search/?text=<?=urlencode($errstr)?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="50px" height="50px"><g fill="#2b2b2bfff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M4.009,23.496c0,-11.312 9.183,-20.495 20.496,-20.495c11.313,0 20.496,9.183 20.496,20.495c0,11.312 -9.183,20.495 -20.496,20.495c-11.313,0 -20.496,-9.183 -20.496,-20.495zM26,35.507v-10.382l8.549,-8.559c0.585,-0.587 0.585,-1.537 0,-2.121c-0.587,-0.585 -1.537,-0.585 -2.121,0l-7.931,7.939l-7.931,-7.939c-0.585,-0.585 -1.535,-0.585 -2.121,0c-0.585,0.585 -0.585,1.535 0,2.121l8.555,8.563v10.377c0,0.828 0.672,1.5 1.5,1.5c0.827,0.001 1.5,-0.671 1.5,-1.499z"></path></g></g></svg></a>
        </div>
    </div>
</body>
</html>