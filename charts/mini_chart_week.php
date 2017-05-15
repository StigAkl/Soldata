<?php include_once("access/database_functions.php");

$last_week = get_production_last_week();
?>

<div id="mini_chart_week">
    <canvas class="chart_mini_week" width="80%" height="70%"></canvas>


    <!-- Prosent som skal vises på progress-baren (hvor langt vi har komt denne uken -->
    <?php

    if(date("w") == 0)
        $day = 7;
    else
        $day = (int)date("w") + 1;

    $progress = round($day / 7 * 100);
    if ($progress > 100)
        $progress = 100;

    ?>

    <!-- Viser progress-baren -->
    <div class="progress_bar">
        <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
                 aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100"
                 style="width:<?php echo $progress; ?>%">
                <?php echo round($progress) . "%"; ?>
            </div>
        </div>
    </div>
</div>

<script>


    function miniChartWeek() {
        var ctx = document.getElementsByClassName("chart_mini_week");
        var myChart3 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Mandag", "Tirsdag", "Onsdag", "Torsdag", "Fredag", "Lørdag", "Søndag"],
                datasets: [{
                    label: 'Produksjon denne uken',
                    data: [<?php echo $last_week["Mon"] / 1000 . "," . $last_week["Tue"] / 1000 . "," . $last_week["Wed"] / 1000 . "," . $last_week["Thu"] / 1000 . "," . $last_week["Fri"] / 1000 . "," . $last_week["Sat"] / 1000 . "," . $last_week["Sun"] / 1000;?> ],
                    backgroundColor: [
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
                        'rgba(76,174,76,1)'
                    ],
                    borderWidth: 2
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