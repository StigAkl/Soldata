<?php
include_once("access/database_functions.php");
include_once("functions/functions.php");
$last_week = get_production_last_week();
$date_to_show = production_today();


//Viser progresjonsbar-animasjonen som default.
$show_progress_bar = true;

//Melding å vise, endres til en spesifikk dato ved endring av graf.
$day = "i dag";

if (isset($_POST['date'])) {
    $date = $_POST['date'];

    $valid_date = validateDate($date);
    if ($valid_date == 1) {
        $date_to_show = production_at_day($date);
        $day = date("j. F", strtotime($date));
        $today = new DateTime(); // This object represents current date/time
        $today->setTime(0, 0, 0); // reset time part, to prevent partial comparison

        $match_date = DateTime::createFromFormat("Y-m-d H:i:s", $date);
        $match_date->setTime(0, 0, 0); // reset time part, to prevent partial comparison

        $diff = $today->diff($match_date);
        $diffDays = (integer)$diff->format("%R%a"); // Extract days count in interval

        //Dersom det er en tidligere dag enn i dag, så vil ikke progress-baren vise.
        //Setter også $day til å skrive ut "i dag"
        if ($diffDays == 0) {
            $show_progress_bar = true;
            $day = "i dag";
        } else {
            $show_progress_bar = false;
        }
    }
}
?>


<div class="panel panel-success">
    <div class="panel-heading"><h4>Produksjonsdata - Dag</h4></div>
    <div class="panel-body">
        Grafen viser produksjon hver time for <?php echo $day; ?>

        <form method="post">
            <div class="form-group">

                <div class="col-xs-2">
                    <label for="date">Velg dato: </label>
                    <select name="date" class="form-control" onchange="this.form.submit()">
                        <option selected disabled>Velg dato</option>
                        <?php
                        $month_start_stamp = strtotime("first day of this month");
                        $today_stamp = strtotime("tomorrow");
                        $begin = new DateTime();
                        $begin->format("Y-m-d H:i:s");
                        $begin->setTimestamp($month_start_stamp);
                        $end = new DateTime();
                        $end->format("Y-m-d H:i:s");
                        $end->setTimestamp($today_stamp);
                        $interval = DateInterval::createFromDateString('1 day');
                        $period = new DatePeriod($begin, $interval, $end);
                        foreach ($period as $dt) {
                            echo "<option class=\"form-control\" value=\"" . $dt->format("Y-m-d H:i:s") . "\">" . $dt->format("jS M") . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </form>

        <?php include("pages/production_tabs.php"); ?>
        <canvas id="day_chart" width="80%" height="30%"></canvas>

        <?php

        if ($show_progress_bar) {
            $progress = round(intval(date("H")) + get_server_hour_delay()) / 24 * 100;
            ?>
            <div class="progress_bar">
                <div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                         aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100"
                         style="width:<?php echo $progress; ?>%">
                        <?php echo round($progress) . "%"; ?>
                    </div>
                </div>
            </div>
            <?php
        } else { ?>

        <div class="progress_bar"
        ">
        <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                100%
            </div>
        </div>
    </div>
</div>

<?php
}

?>

</div>


<script>

    var ctx2 = document.getElementById("day_chart");
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ["05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21"],
            datasets: [{
                label: 'Produksjonsdata hver time.',
                data: [<?php echo
                    $date_to_show["05"] . ", "
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
                    . $date_to_show["21"] . ", ";
                    ?> ],
                backgroundColor: [
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)',
                    'rgba(92, 184, 92, 0.6)'
                ],
                borderColor: [
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)',
                    'rgba(76,174,76,1)'
                    //'rgba(244, 201, 45, 1)'
                ],
                borderWidth: 2
            }]

        }, options: {
            scales: {
                yAxes: [{
                    ticks: {}
                }]
            }
        }
    });
</script>
