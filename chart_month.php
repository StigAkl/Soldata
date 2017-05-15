<?php
include_once("access/database_functions.php");
include_once("functions/functions.php");
include_once("controller/month_chart_controller.php");
?>


<div class="panel panel-success">
    <div class="panel-heading"><h4>Produksjonsdata - Måned</h4></div>

    <div class="panel-body"
    <p>Viser produksjon for <?php echo $month; ?></p>


    <form method="post">

        <div class="form-group">

            <div class="col-xs-2">
                <label for="date">Velg måned: </label>
                <select class="form-control" name="month" onchange="this.form.submit()">
                    <option selected disabled>Velg mnd</option>

                    <?php
                    //Første måned vi har data fra
                    $month_start_stamp = strtotime("2016-08-01 00:00:00");
                    $today_stamp = strtotime("today");

                    //Gjør timestampen om til DateTime()-objekt slik at vi kan loope igjennom hver måned
                    $begin = new DateTime();
                    $begin->format("Y-m-d H:i:s");
                    $begin->setTimestamp($month_start_stamp);

                    $end = new DateTime();
                    $end->format("Y-m-d H:i:s");
                    $end->setTimestamp($today_stamp);

                    //Vi vil loope igjennom hver måned
                    $interval = DateInterval::createFromDateString('1 month');
                    $period = new DatePeriod($begin, $interval, $end);


                    //Prints out the select options: Jan, Feb, Mar...
                    foreach ($period as $dt) {
                        echo "<option value=\"" . $dt->format("Y-m-d H:i:s") . "\">" . $dt->format("F") . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </form>

    <?php include("pages/production_tabs.php"); ?>

    <div class="graph">
        <canvas id="month_chart" width="80%" height="30%"></canvas>
    </div>

</div>
<script>
    var ctx = document.getElementById("month_chart");

    let data_values = [];
    let labels = [];
    <?php
    $num_days = count($month_to_show) / 2;
    $i = 0;
    while ($i < $num_days) {
        print("data_values.push(" . $month_to_show[$i] . ")\n ");
        print("labels.push(" . ($i + 1) . ")\n");
        $i++;
    }

    ?>

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Production data this week :)',
                data: data_values,
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
                borderWidth: 2,
                responsiveAnimationDuration: 1000
            }]

        }, options: {
            animation: {
                duration: 2000
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

</script>
</body>
</html>