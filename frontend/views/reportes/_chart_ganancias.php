<?php 
	use dosamigos\chartjs\ChartJs;
	// print_r($importes['ingresos']);
    // $importes['ingresos'] = $importes['ingresos'] < 1 ? 1 : $importes['ingresos'];
    // $importes['ganancias'] = $importes['ganancias'] < 1 ? 1 : $importes['ganancias'];


    $mult_ingresos = $importes['ingresos'] < 1 ? 1 : $importes['ingresos'];
    $mult_ganancias = $importes['ganancias'] < 1 ? 1 : $importes['ganancias'];
    $mult_gastos = $importes['gastos'] < 1 ? 1 : $importes['gastos'];
    $ganancias_percent = ($mult_ganancias * 100) / $mult_ingresos;
    $gastos_percent = ($mult_gastos * 100) / $mult_ingresos;
    
    if ($importes['ingresos'] == 0) {
        $ingresos_percent = 0;
    }else{
        $ingresos_percent = 100 - $ganancias_percent;
    }

    if ($importes['ganancias'] < 1) {
        $ganancias_percent = 0;
    }

?>
<?php try {
    echo ChartJs::widget([
        'type' => 'pie',
        'options' => [
            'height' => 250,
            'width' => 500,
        ],
        'data' => [
            'labels' => ['GASTOS', 'GANANCIAS'],
            'datasets' => [
                [
                    'data' => [$importes['gastos'], $importes['ingresos']],
                    'label' => ["GASTOS", 'GANANCIAS'],
                    'backgroundColor' => [
                        '#dc3545',
                        '#00725e',
                ],
                    'borderColor' =>  [
                            '#fff',
                            '#fff',
                    ],
                ],
            ]
        ], 'clientOptions' => [
        'legend' => [
            'display' => FALSE,
            'position' => 'top',
            'labels' => [
                'fontSize' => 14,
                'fontWeight' => "bold",
                'fontColor' => "#425062",
            ]
        ],

    ],
    ]);
	} catch (Exception $e) {
		//echo "No pudo cargar el reporte";
	}
?>

<div class="text-center">
    <i class="fa fa-circle mr-1 font-14" style="color:#dc3545;background:#dc3545"></i>
    <span class="mr-2 font-weight-bold font-14">GASTOS: <?= number_format($importes['gastos']) ?> (<?= number_format($gastos_percent, 2) ?>%)</span>
    <br>
    <i class="fa fa-circle mr-1 font-14" style="color:#00725e;background:#00725e"></i>
    <span class="mr-1 font-weight-bold font-14">GANANCIAS: <?= number_format($importes['ganancias']) ?> (<?= number_format($ganancias_percent, 2) ?>%)</span>
</div>