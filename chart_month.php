<?php
include_once ("access/database_functions.php");
include_once ("functions/functions.php");
include_once ("controller/month_chart_controller.php");
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
    <canvas id="myChart" width="800" height="500" style="display:none"></canvas>
    <form method="post">
        <select name="month" onchange="this.form.submit()">
            <option selected disabled>Velg dato</option>

            <?php
            //Første måned vi har data fra
            $month_start_stamp = strtotime("2017-01-01 00:00:00");
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
                echo "<option value=\"" . $dt->format("Y-m-d H:i:s") . "\">" . $dt->format("F")."</option>";
            }
            ?>
        </select>
    </form>

    <p>Viser produksjon for <?php echo $month; ?></p>
    <canvas id="myChart2" width="600" height="600"></canvas>


</div>
    <script>
        var ctx = document.getElementById("myChart2");

        let data_values = [];
        let labels = [];
        <?php
            $num_days = count($month_to_show)/2;
            $i = 0;
            while($i < $num_days) {
                print("data_values.push(".$month_to_show[$i].")\n ");
                print("labels.push(".($i+1).")\n");
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
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
                            'rgba(48, 110, 125, 0.4)',
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
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
                            'rgba(22,63,69,1)',
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
</body>
</html>