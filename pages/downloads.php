<?php include_once("controller/download.php"); ?>
<script type="text/javascript" src="lib/selectize/dist/js/standalone/selectize.min.js"></script>
<link rel="stylesheet" type="text/css" href="lib/selectize/dist/css/selectize.css" />
<div class="panel panel-success" id="graphs">
    <div class="panel-heading"><h4>Nedlastninger <img src="imgs/sun.png" width="25px" height="25px"/></h4></div>
    <div class="panel-body">

        <p class="lead">Nedlastninger</p>


        <div class="container">
                <script>
                        var options=["1","2","3","4"];
                </script>
                <script>
                    $(function() {
                        $('.day').selectize(options);
                    });
                </script>


    <div class="container">
        <div class="row">
            <div class='col-sm-6'>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker();
                });
            </script>
        </div>
    </div>

                <label>Fra: </label>
                &nbsp
                <select class="day" data-placeholder="Jævlig bra Andrè!">
                </select>
                <select>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                </select>

                <select>
                        <option>2015</option>
                        <option>2016</option>
                        <option>2017</option>
                        <option>2018</option>
                </select>
                &nbsp
                &nbsp
                &nbsp

                <label>Til: </label>
                &nbsp
                <select>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>
                </select>
                <select>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                </select>

                <select>
                        <option>2015</option>
                        <option>2016</option>
                        <option>2017</option>
                        <option>2018</option>
                </select>
        </div>



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