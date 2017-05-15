<?php include_once("controller/download.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>

<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<div class="panel panel-success" id="graphs">
    <div class="panel-heading"><h4>Nedlastninger <img src="imgs/sun.png" width="25px" height="25px"/></h4></div>
    <div class="panel-body">

        <p class="lead">Nedlastninger</p>





<div class="container">
    <div class="row">
        <div class="col-sm-1"><label>Fra: </label></div>
            <div class='col-sm-2'>
                <input type='text' class="form-control" id='datetimepicker4' />
            </div>

            <div class="col-sm-1"><label>Til: </label></div>
                <div class='col-sm-2'>
                    <input type='text' class="form-control" id='datetimepicker3' />
                </div>
    </div>
</div>

        <script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'DD/MM/YYYY',
                    keepOpen: false,
                });
            });
        </script>

        <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker({
                    format: 'DD/MM/YYYY',
                    keepOpen: false,
                });
            });
        </script>



        <div>
            <fieldset>
                    <legend>Soldata</legend>

                    <label>Energi: </label>
                    <input type="checkbox">
                    <br>
                    <br>
                    <label>Power: </label>
                    <input type="checkbox">
                    <br>

            </fieldset>

        </div>

                <div>
            <fieldset>
                    <legend>Værdata</legend>

                    <label>Temperatur: </label>
                    <input type="checkbox">
                    <br>
                    <br>
                    <label>Luftfuktighet: </label>
                    <input type="checkbox">
                    <br>

            </fieldset>

        </div>
        <br>
        <button type="button" class="btn btn-success">Last ned</button>
        </div>

    <div class="container">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="year" data-toggle="dropdown">Data for
                spesifikt år
                <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <li role="presentation"><a role="year" tabindex="-1" href="download.php?download=year&year=2016">2016</a>
                </li>
                <li role="presentation"><a role="year" tabindex="-1" href="download.php?download=year&year=2017">2017</a>
                </li>
            </ul>
        </div>
    </div>
    </div>