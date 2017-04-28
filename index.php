<?php include_once ("access/database_functions.php");

$last_week = get_production_last_week();
 ?>
<!doctype html>
<html>
<head>
    <title>Soldata.no</title>
    <link rel="icon" type="image/png" href="imgs/icon.png">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <script src="js/lib/Chart.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>

        .graph {
            margin: 0 auto;
            width: 50%;
            height: 50%;
            min-width: 400px;
            min-height: 350px;
        }


    </style>
</head>

<body>
<div id="container">
<div id="header">
<ul>
    <li id="img_li"><a href="http://thenewworldproject.com/soldata/index.html"><img src="imgs/home.png" id="home"></a></li>
    <li><a href="#nyheter">Nyheter</a></li>
    <li><a href="#kontakt">Kontakt Oss</a></li>
    <li><a href="#omoss">Om Oss</a></li>
    <li><a href="#download">Nedlastinger</a></li>
</ul>

</div>
<div id="content">

<div id="tabs">
  <div class="btn-group">
    <button type="button" class="btn btn-success">Dag</button>
    <button type="button" class="btn btn-success">Uke</button>
    <button type="button" class="btn btn-success">Måned</button>
    <button type="button" class="btn btn-success">År</button>
  </div>
</div>

    <div class="graph">
        <canvas class="chart" width="800" height="400"></canvas>
    </div>
<script>
var ctx = document.getElementsByClassName("chart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [{
            label: 'kW produced this week',
            data: [<?php echo $last_week["Mon"]/1000 . "," . $last_week["Tue"]/1000 . "," . $last_week["Wed"]/1000 . "," . $last_week["Thu"]/1000 . "," . $last_week["Fri"]/1000;?> ],
            backgroundColor: [
                'rgba(92, 184, 92, 0.6)',
                'rgba(92, 184, 92, 0.6)',
                'rgba(92, 184, 92, 0.6)',
                'rgba(92, 184, 92, 0.6)',
                'rgba(92, 184, 92, 0.6)',
                'rgba(92, 184, 92, 0.6)',
                //'rgba(133, 183, 62, 0.6)'
            ],
            borderColor: [
                'rgba(76,174,76,1)',
                'rgba(76,174,76,1)',
                'rgba(76,174,76,1)',
                'rgba(76,174,76,1)',
                'rgba(76,174,76,1)',
                'rgba(76,174,76,1)',
                //'rgba(244, 201, 45, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
       responsive: true
    }
});
</script>

</div>
<div id="information">
    <div class="infobox" id="introduction">
    	<div class="displaybox">
    		<p class="info-heading">Generell informasjon</p>
            <p class="info_text">Anlegget på Marineholmen ble installert i juli 2016. Siden den gang har det produsert
            over 300 MW. Anlegget bidro med å sikre nest beste BREEAM-kategori på bygget.</p>
    	</div>
    </div>
    <div class="infobox" id="production_now">
    	<div class="displaybox">
    		<p class="info-heading">Produksjon</p>
            <p class="info_text" id="info_prod">
                Hittil i dag (kW): 1676 <br>
                Hittil i dag (kJ): 748 <br>
                Hittil i år (MW): 43 <br>
                Hittil i år (MJ): 28
            </p>
    	</div>
    </div>
    <div class="infobox" id="environmental_savings">
    	<div class="displaybox">
    		<p class="info-heading">Vær informasjon</p>
            <p class="info_text" id="info_inline">
                <img src="imgs/partly_cloudy.png" align="left" id="weather_icon"/>
                Det er sol og delvis skyet over Bergen for øyeblikket <br>
                (sist oppdatert 17:00). <br>
                Klikk <a class="link" href="https://www.yr.no/place/Norway/Hordaland/Bergen/Bergen/"> her</a> for mer informasjon.
            </p>
    	</div>
    </div>
</div>
    <!---<div class="clear"></div>-->
    <div id="footer">
        <div class="infobox">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/SolarEdge_logo.svg/320px-SolarEdge_logo.svg.png"/>
            <p>SolarEgde er produsent av solcellepanelene. Soldata.no bruker SolarEdge sitt API for å hente ut data fra solcellepanelene</p>
        </div>

        <div class="infobox">
        </div>

        <div class="infobox">
        </div>

    </div>
</div>
</body>
</html>
