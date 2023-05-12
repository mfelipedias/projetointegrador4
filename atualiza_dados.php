<div class="row">
    <div class="col-md">
        <div class="card" style="margin: 10px; height: 100%">
            <h6 class="card-header">Ultima leitura</h6>
            <div class="card-body text-center">

                <div class="row" style="width:100%; height:100%">
                    <div class="col align-self-center">
                        <?php
                        include 'db.php';
                        $sql = "SELECT * FROM `dados_sensor` ORDER BY registro DESC LIMIT 1";
                        $busca = mysqli_query($db, $sql);

                        while ($array = mysqli_fetch_array($busca)) {
                            $ph = $array['ph'];
                            $temperatura = $array['temperatura'];
                            $registro = $array['registro'];
                            ?>
                            <span style="font-size:3vw">pH</span> <b class="text-primary" style="font-size:8vw">
                                <?php echo $ph; ?>
                            </b><br><span style="font-size:3vw">Temp.</span> <b style="font-size:5vw">
                                <?php echo $temperatura; ?> ºC
                            </b>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center text-muted">
                    <?php echo date('d/m/Y h:i:s', strtotime($registro)) ?>
                <?php } ?>

            </div>
        </div>
    </div>

    <div class="col-md">
        <div class="card" style="margin: 10px; height: 100%">
            <h6 class="card-header">Registros recentes</h6>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-sm">
                        <?php
                        include 'db.php';
                        $sql = "SELECT * FROM `dados_sensor` ORDER BY registro DESC LIMIT 12";
                        $busca = mysqli_query($db, $sql);

                        while ($array = mysqli_fetch_array($busca)) {
                            $ph = $array['ph'];
                            $temperatura = $array['temperatura'];
                            $registro = $array['registro'];
                            ?>
                            pH: <b style="color: white; background-color: <?php if ($ph < 6 or $ph > 8.5) {
                                echo 'red';
                            } else {
                                echo 'green';
                            }
                            ; ?>">
                                <?php echo $ph; ?>
                            </b> / Temp.: <b style="color: white; background-color: <?php if ($temperatura < 26 or $temperatura > 32) {
                                echo 'red';
                            } else {
                                echo 'green';
                            }
                            ; ?>">
                                <?php echo $temperatura; ?> ºC
                            </b><br>
                            <p class="text-muted" style="font-size:12px">Registro:
                                <?php echo date('d/m/Y h:i:s', strtotime($registro)) ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center text-muted">
            <a href="#">Ver mais antigos...</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.charts.load('current', { 'packages': ['line'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn({ type: 'date', label: 'Day' });
        data.addColumn('number', 'pH');
        data.addColumn('number', '°C');

        data.addRows([
            <?php
            include 'db.php';
            $sql = "SELECT * FROM `dados_sensor` ORDER BY registro DESC LIMIT 12";
            $busca = mysqli_query($db, $sql);

            while ($array = mysqli_fetch_array($busca)) {
                $ph = $array['ph'];
                $temperatura = $array['temperatura'];
                $registro = $array['registro'];
                ?>
                [new Date(<?php echo date('Y', strtotime($registro)); ?>, <?php echo date('m', strtotime($registro)); ?>, <?php echo date('d', strtotime($registro)); ?>, <?php echo date('h', strtotime($registro)); ?>, <?php echo date('i', strtotime($registro)); ?>, <?php echo date('s', strtotime($registro)); ?>), <?php echo $ph; ?>, <?php echo $temperatura; ?>],
            <?php } ?>
        ]);

        var options = {
            chart: {
                title: 'Leituras de pH e Temperatura',
                subtitle: 'Ultimas 12 leituras'
            },

        };

        var chart = new google.charts.Line(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>
<div class="row" style="height: 10px">
    <div class="col-md">
    </div>
</div>
<div class="row">
    <div class="col-md">
        <div class="card" style="margin: 10px;">
            <h6 class="card-header">Gráfico</h6>
            <div class="card-body">
                <div id="chart_div" style="width: 100%; height: 500px; margin-top: 10px;"></div>
            </div>
        </div>
    </div>
</div>