<?php 
	use dosamigos\chartjs\ChartJs;
	// print_r($importes['ingresos']);
?>

<?php try {
    echo ChartJs::widget([
        'type' => 'line',
        'options' => [
            'height' => 250,
            'width' => 500,
        ],
        'data' => [
            'labels' => $meses,
            'datasets' => [
                [
                    'label' => ["Ingresos"],
                    'backgroundColor' => "transparent",
                    'borderColor' => "#48abf7",
                    'pointBackgroundColor' => "#48abf7",
                    'pointBorderColor' => "#fff",
                    'pointHoverBackgroundColor' => "#fff",
                    'pointHoverBorderColor' => "#42B242",
                    'data' => $importes['ingresos']['total'],
                ],
                [
                    'label' => ["Gastos Producción"],
                    'backgroundColor' => "transparent",
                    'borderColor' => ["#f25961"],
                    'pointBackgroundColor' => "#f25961",
                    'pointBorderColor' => "#fff",
                    'pointHoverBackgroundColor' => "#fff",
                    'pointHoverBorderColor' => "purple",
                    'data' => $importes['gastos_produccion']['total'],
                ],
                [
                    'label' => ["Gastos Operativos"],
                    'backgroundColor' => "transparent",
                    'borderColor' => ["#ffad46"],
                    'pointBackgroundColor' => "#ffad46",
                    'pointBorderColor' => "#fff",
                    'pointHoverBackgroundColor' => "#fff",
                    'pointHoverBorderColor' => "#03295e",
                    'data' => $importes['gastos_operativos']['total'],
                ],
                [
                    'label' => ["Ganancias"],
                    'backgroundColor' => "transparent",
                    'borderColor' => ["#31ce36"],
                    'pointBackgroundColor' => "#31ce36",
                    'pointBorderColor' => "#fff",
                    'pointHoverBackgroundColor' => "#fff",
                    'pointHoverBorderColor' => "purple",
                    'data' => $importes_ganancias['total'],
                ],

            ]
        ], 'clientOptions' => [
        'legend' => [
            'display' => true,
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