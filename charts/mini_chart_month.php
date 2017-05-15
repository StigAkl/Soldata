<?php
include_once ("access/database_functions.php");
include_once ("functions/functions.php");
include_once ("controller/month_chart_controller.php");
?>

<!-- Canvas for å vise grafen -->
<div id="mini_chart_month">
    <canvas id="chart_mini_month" width="80%" height="70%"></canvas>




    <!-- Prosent som skal vises på progress-baren (hvor langt vi har komt i måneden -->
    <?php
    $progress = round(intval(date("d")) / date("t") * 100);
    if($progress > 100)
        $progress = 100;

    ?>

    <!-- Viser progress-baren -->

    <div class="progress_bar">
        <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                 aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress; ?>%">
                <?php echo round($progress) . "%"; ?>
            </div>
        </div>
    </div>
</div>

<script>

    function miniChartMonth() {
        var ctx = document.getElementById("chart_mini_month");

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
                    label: 'Produksjonsdata denne måneden',
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
                    xAxes: [{
                        ticks: {
                            maxTicksLimit: 10
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }

</script>
