<?php 
	use dosamigos\chartjs\ChartJs;
?>
<canvas id="incomechart" width="100%" height="400"></canvas>
<script>
    setTimeout(function(){
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                xAxes : [ {
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }]
            },
        }
        var chart = new Chart(document.getElementById('incomechart').getContext('2d'), {
            type: 'line',
            data: {
                labels: [<?= implode(',', $meses) ?>],
                datasets: [
                    {
                      label: 'Ingresos',
                      data: [<?= implode(',', $importes['ingresos']['total']) ?>],
                      borderColor: "#48abf7",
                      backgroundColor: 'transparent',
                    },
                    {
                      label: 'Gastos',
                      data: [<?= implode(',', $importes['gastos_produccion']['total']) ?>],
                      borderColor: "#f25961",
                      backgroundColor: 'transparent',
                      // backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),
                    }
                ]
            },

            options: options
        });
    },500)
</script>

<?php try {
 //    echo ChartJs::widget([
 //        'type' => 'line',
 //        'options' => [
 //            'height' => 250,
 //            'width' => 500,
 //            'scales' => [
 //                'xAxes' => [
 //                    'ticks' => [
 //                       'display ' =>  false,
 //                    ],
 //                    'gridLines' => [
 //                       'drawBorder ' =>  false,
 //                       'display ' =>  false,
 //                    ]
 //                ]
 //            ],
 //        ],
 //        'data' => [
 //            'labels' => $meses,
 //            'datasets' => [
 //                [
 //                    'label' => ["Ingresos"],
 //                    'backgroundColor' => "transparent", 
 //                    'borderColor' => "#48abf7",
 //                    'pointBackgroundColor' => "#48abf7",
 //                    'pointBorderColor' => "#fff",
 //                    'pointHoverBackgroundColor' => "#fff",
 //                    'pointHoverBorderColor' => "#42B242",
 //                    'data' => $importes['ingresos']['total'],
 //                ],
 //                [
 //                    'label' => ["Gastos"],
 //                    'backgroundColor' => "transparent",
 //                    'borderColor' => ["#f25961"],
 //                    'pointBackgroundColor' => "#f25961",
 //                    'pointBorderColor' => "#fff",
 //                    'pointHoverBackgroundColor' => "#fff",
 //                    'pointHoverBorderColor' => "purple",
 //                    'data' => $importes['gastos_produccion']['total'],
 //                ],
 //                [
 //                    'label' => ["Ganancias"],
 //                    'backgroundColor' => "transparent",
 //                    'borderColor' => ["#31ce36"],
 //                    'pointBackgroundColor' => "#31ce36",
 //                    'pointBorderColor' => "#fff",
 //                    'pointHoverBackgroundColor' => "#fff",
 //                    'pointHoverBorderColor' => "purple",
 //                    'data' => $importes_ganancias['total'],
 //                ],

 //            ]
 //        ], 'clientOptions' => [

 //        'legend' => [
 //            'display' => true,
 //            'position' => 'top',
 //            'labels' => [
 //                'fontSize' => 14,
 //                'fontWeight' => "bold",
 //                'fontColor' => "#425062",
 //            ]
 //        ],

 //    ],
 //    ]);
	} catch (Exception $e) {
		echo "No pudo cargar el reporte";
	}
?>
