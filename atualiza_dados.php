<div class="card" style=" margin: 10px;">
    <h6 class="card-header">Dados</h6>
    <div class="card-body">
        <?php
        include 'db.php';
        $sql = "SELECT * FROM `dados_sensor` ORDER BY registro DESC LIMIT 12";
        $busca = mysqli_query($db, $sql);

        while ($array = mysqli_fetch_array($busca)) {
            $ph = $array['ph'];
            $temperatura = $array['temperatura'];
            $registro = $array['registro'];
            ?>
            pH: <b style="color: white; background-color: <?php if ($temperatura<6 or $temperatura>8.5){echo 'red';}else{echo 'green';}; ?>">
                <?php echo $ph; ?>
            </b> / Temp.: <b style="color: white; background-color: <?php if ($temperatura<26 or $temperatura>32){echo 'red';}else{echo 'green';}; ?>">
                <?php echo $temperatura; ?> ºC
            </b> / Registro:
            <b>
                <?php echo date('d/m/Y h:i:s', strtotime($registro)) ?>
            </b><br>
        <?php } ?>
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
            width: 600,
            height: 500
        };

        var chart = new google.charts.Line(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
</script>
<div class="card" style="width:625px; margin: 10px;">
    <h6 class="card-header">Gráfico</h6>
    <div class="card-body">
        <div id="chart_div" style="width: 600px; height: 500px; margin-top: 10px;"></div>
    </div>
</div>