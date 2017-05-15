<div class="panel panel-success" id="graphs">
    <div class="panel-heading"><h4>Velkommen til Soldata! <img src="imgs/sun.png" width="25px" height="25px"/></h4></div>
    <div class="panel-body">

        <p class="lead">Liten oversikt over produksjonsdata for i dag, denne uken og denne måneden:</p>

        <h6>Sist oppdatert: <?php echo last_update();?> </h6> <br>
   
        <div class="row">
            <div class="col-sm-4"><?php include ("charts/mini_chart_days.php"); ?></div>
            <div class="col-sm-4"><?php include("charts/mini_chart_week.php"); ?></div>
            <div class="col-sm-4"><?php include("charts/mini_chart_month.php"); ?></div>
        </div>
    </div>
</div>

