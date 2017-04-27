<?php
include_once ("access/database_functions.php");
include_once ("functions/functions.php");

$last_week = get_production_last_week();
$date_to_show = production_today();

$day = "i dag";
if(isset($_POST['date'])) {
    $date = $_POST['date'];

    $valid_date = validateDate($date);

    if($valid_date == 1) {
        $date_to_show = production_at_day($date);
        $day = date("j. F",strtotime($date));
    }
}
 ?>
<!doctype html>
<html>
<head>
    <title>Example Domain</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />   

    <script src="js/lib/Chart.js"></script>
</head>

<body>
<div>
<canvas id="myChart" width="800" height="500" style="display:none"></canvas>-


    <form method="post">
    <select name="date" onchange="this.form.submit()">
        <option selected disabled>Velg dato</option>
        <?php

        $month_start_stamp = strtotime("first day of this month");
        $today_stamp = strtotime("today");

        $begin = new DateTime();
        $begin->format("Y-m-d H:i:s");
        $begin->setTimestamp($month_start_stamp);

        $end = new DateTime();
        $end->format("Y-m-d H:i:s");
        $end->setTimestamp($today_stamp);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        foreach ($period as $dt) {
            echo "<option value=\"" . $dt->format("Y-m-d H:i:s") . "\">" . $dt->format("jS M")."</option>";
        }
        ?>
    </select>
    </form>

    <p>Viser produksjon for <?php echo $day; ?></p>
    <canvas id="myChart2" width="800" height="600"></canvas>

<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturdag", "Sunday"],
        datasets: [{
            label: 'Production data this week :)',
            data: [<?php echo $last_week["Mon"] . "," . $last_week["Tue"] . "," . $last_week["Wed"] . "," . $last_week["Thu"] . "," . $last_week["Fri"];?> ],
            backgroundColor: [
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)'
            ],
            borderColor: [
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
       responsive: false
    }
});


var ctx2 = document.getElementById("myChart2");
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"],
        datasets: [{
            label: 'Production data this week :)',
            data: [<?php echo


                $date_to_show["00"] . ", "
                . $date_to_show["01"] . ", "
                . $date_to_show["02"] . ", "
                . $date_to_show["03"] . ", "
                . $date_to_show["04"] . ", "
                . $date_to_show["05"] . ", "
                . $date_to_show["06"] . ", "
                . $date_to_show["07"] . ", "
                . $date_to_show["08"] . ", "
                . $date_to_show["09"] . ", "
                . $date_to_show["10"] . ", "
                . $date_to_show["11"] . ", "
                . $date_to_show["12"] . ", "
                . $date_to_show["13"] . ", "
                . $date_to_show["14"] . ", "
                . $date_to_show["15"] . ", "
                . $date_to_show["16"] . ", "
                . $date_to_show["17"] . ", "
                . $date_to_show["18"] . ", "
                . $date_to_show["19"] . ", "
                . $date_to_show["20"] . ", "
                . $date_to_show["21"] . ", "
                . $date_to_show["22"] . ", "
                . $date_to_show["23"] . ", ";


                ?> ],
            backgroundColor: [
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)',
                'rgba(48, 110, 125, 0.4)'
            ],
            borderColor: [
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)',
                'rgba(22,63,69,1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: false
    }
});
</script>
</div>
</body>
</html>
