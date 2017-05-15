<?php
include_once ("access/database_functions.php");
include_once ("functions/functions.php");
$last_week = get_production_last_week();
$date_to_show = production_today();
$yesterday = production_at_day(date("Y-m-d H:i:s", strtotime("yesterday")));


//Melding å vise, endres til en spesifikk dato ved endring av graf.
?>



<div id="mini_chart_day">
    <canvas id="chart_mini_day" width="80%" height="70%"></canvas>
    <?php


        $progress = round(intval(date("H")) + get_server_hour_delay()) / 24*100;
        if($progress > 100)
            $progress = 100;

        ?>
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

    function miniChartDays() {
        var ctx2 = document.getElementById("chart_mini_day");
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ["05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21"],
                datasets: [{
                    label: 'Produkson i dag',
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
                },
                    {
                        label: 'Produksjonsdata i går',
                        data: [<?php echo
                            $yesterday["05"] . ", "
                            . $yesterday["06"] . ", "
                            . $yesterday["07"] . ", "
                            . $yesterday["08"] . ", "
                            . $yesterday["09"] . ", "
                            . $yesterday["10"] . ", "
                            . $yesterday["11"] . ", "
                            . $yesterday["12"] . ", "
                            . $yesterday["13"] . ", "
                            . $yesterday["14"] . ", "
                            . $yesterday["15"] . ", "
                            . $yesterday["16"] . ", "
                            . $yesterday["17"] . ", "
                            . $yesterday["18"] . ", "
                            . $yesterday["19"] . ", "
                            . $yesterday["20"] . ", "
                            . $yesterday["21"] . ", ";
                            ?> ],
                        backgroundColor: [
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)',
                            'rgba(176, 124, 98, 0.6)'
                        ],
                        borderColor: [
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)',
                            'rgba(133,60,23,1)'
                            //'rgba(244, 201, 45, 1)'
                        ],
                        borderWidth: 2
                    }

                ],




            }, options: {
                animation: {
                    duration: 1000
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            maxTicksLimit: 10
                        }
                    }]
                }
            }
        });
    }
</script>
