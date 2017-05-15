<?php include_once ("access/database_functions.php");
include_once ("functions/functions.php");
 ?>
<!doctype html>
<html>
<head>
    <title>Soldata.no</title>
    <link rel="icon" type="image/png" href="imgs/icon2.png">
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <script src="js/lib/Chart.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>

        .navbar-default {
            background-color: #F8F8F8;
            border-color: #E7E7E7;
        }

        #tabs{
            margin : 0 auto;
            width: 210px;
            margin-top: 35px;
            margin-bottom: 35px;
        }

        .progress_bar {
            width: 80%;
            margin: 0 auto;
            margin-top: 10px;
        }

        .center {
            text-align: center;
        }

        .lead {
            margin-top: 20px;
            font-size: 1.2em;
        }

        #mini_chart_day, #mini_chart_month, #mini_chart_week {
            display: none;
        }

        .graph {
            margin: 0 auto;
            width: 80%;
            height: 50%;
        }

        .contact-and-map-box {
            width: 33%;
            height: 33%;
        }

        #form-box {
            width: 66%;
            height: 100%;
            float: left;
        }

        .float-right {
            float: right;
        }

        .float-left {
            float: left;
        }

        .clear {
            clear: both;
        }

    </style>
</head>

<body onload="startTime()">

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">SOLDATA</a>

            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="index.php?page=home"><span class="glyphicon glyphicon-home"> Home</span></a></li>
            <li><a href="index.php?page=production"><span class="glyphicon glyphicon-flash">Produksjon</span></a></li>
            <li><a href="index.php?page=about"><span class="glyphicon glyphicon-info-sign"></span> Om oss</a></li>
            <li><a href="index.php?page=contact"><span class="glyphicon glyphicon-earphone"></span> Kontakt oss</a></li>
            <li><a href="index.php?page=downloads"><span class="glyphicon glyphicon-download"></span> Nedlastninger</a></li>
        </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a>
                        <span style="font-size: 1.1em" id="date"></span>
                        <span style="font-size: 1.1em; padding-left: 10px;" id="time"></span>
                    </a>
                </li>
            </ul>
            </div>
    </div>
</nav>


<div class="container">

    <?php
    $page = "pages/home.php";

    if(!$connection) {
        include("error/no_db_connection.php");
        exit();
    }
    else {
        if (isset($_GET['page'])) {
            $site = htmlspecialchars($_GET['page']);
            switch ($site) {
                case "home":
                    $page = "pages/home.php";
                    break;
                case "production":
                    $page = "pages/production.php";
                    break;
                case "downloads":
                    $page = "pages/downloads.php";
                    break;
                case "about":
                    $page = "pages/about.php";
                    break;
                case "contact":
                    $page = "pages/contact.php";
                    break;
                default:
                    $page = "error/page_not_found.php";
            }
        }

        include ($page);
    }
    ?>



</div>

<div class="navbar navbar-fixed-bottom bg-success footer">
    <div class="container" style="align-content: center">
        <div class="row">
            <div class="col-sm-4" style="border: 2px solid blue; text-align: center">
                <p class="text-success lead" style="margin: 0"><span class="glyphicon glyphicon-leaf"></span><br>
                    CO2-utslipp spart<br>
                    <span class="text-muted">123,456 kg</span></p>
            </div>
            <div class="col-sm-4" style="border: 2px solid red; text-align: center">
                <p class="text-success lead" style="margin: 0"><span class="glyphicon glyphicon-lamp"></span><br>
                    Lyspærer forsynt<br>
                    <span class="text-muted">123,456 stk</span></p>
            </div>
            <div class="col-sm-4" style="border: 2px solid green; text-align: center;">
                <p class="text-success lead" style="margin: 0"><span class="glyphicon glyphicon-tree-deciduous"></span><br>
                    Trær plantet<br>
                <span class="text-muted">123,456 stk</span></p>
            </div>
        </div>
    </div>
</div>

<script>

var url = window.location;

console.log(url);
// Will only work if string in href matches with location
$('ul.nav a[href="'+ url +'"]').parent().addClass('active');

// Will also work for relative and absolute hrefs
$('ul.nav a').filter(function() {
    return this.href == url;
}).parent().addClass('active');

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML =
        h + ":" + m + ":" + s;
    setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function getDateAndMonth() {
    let d = new Date();
    let month = new Array();
    month[0] = "Januar";
    month[1] = "Februar";
    month[2] = "Mars";
    month[3] = "April";
    month[4] = "Mai";
    month[5] = "Juni";
    month[6] = "Juli";
    month[7] = "August";
    month[8] = "September";
    month[9] = "Oktober";
    month[10] = "November";
    month[11] = "Desember";
    let mnd = month[d.getMonth()];
    let day = d.getDate();
    return day + ". " + mnd;
}

function dayAndMonth() {
    let span = document.getElementById("date");
    span.innerHTML = getDateAndMonth();
}

$(document).ready(function(){

        $("#mini_chart_month").fadeIn(1000);
        $("#mini_chart_day").fadeIn(1000);
        $("#mini_chart_week").fadeIn(1000);

        miniChartMonth();
        miniChartDays();
        miniChartWeek();
});


dayAndMonth();

</script>
</body>
</html>
