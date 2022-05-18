<div class="card">
    <div class="card-header">
        <div class="card-title">
            <?= $name ?>
            <span class="float-right w-100 h6 mt-2">
                <i class="fas fa-circle text-warning mr-1"></i> Pendiente de pago
                <i class="fas fa-circle text-success mr-1 ml-2"></i> Pagado
                <i class="fas fa-circle text-danger mr-1 ml-2"></i> Gastos
            </span> 
        </div>
    </div>
    <div class="card-body">
        <ol class="activity-feed">
            <?php foreach ($model as $pago): ?>
                <?php 
                    // $class = $pago->tipo_id == 1 ? "success" : 'danger';
                    if ($pago->pagada == 0) {
                        $class = 'warning';
                    }elseif($pago->tipo_id == 1){
                        $class = 'success';
                    }else{
                        $class = 'danger';
                    }
                ?>
                <li class="feed-item feed-item-<?= $class ?>">
                    <div class="col-md-12">
                        <time class="date" datetime="9-24"><?= $pago->fecha_pago ?></time>
                        <?php 

                            if ($pago->tipo_id == 3 or !isset($pago->cliente->empresa)) {
                                $text = "<span class='font-weight-bold'>".$pago->tipo->nombre.":</span>";
                                $text2 = $pago->concepto;
                            }else{
                                $text = "<a href='/frontend/web/clientes/perfil?id=$pago->cliente_id' class='font-weight-bold'>". $pago->cliente->empresa . "</a>: " . $pago->tipo->nombre;
                                $text2 = isset($pago->servicioExtra) ? $pago->servicioExtra->nombre : '';
                            }

                         ?>
                        <?php if ($pago->factura_id): ?>
                            <span class="text"><?= $text ?> por concepto de <a href="/frontend/web/facturas/editar?id=<?= $pago->factura_id ?>&view=/transacciones&tipo=<?= $pago->tipo_id ?>&cliente=<?= $pago->cliente_id ?>"><?= $pago->concepto ?></a> <a href="/frontend/web/facturas/editar?id=<?= $pago->factura_id ?>&w_client=1" class="float-right badge-pill badge-<?= $class ?>">RD$<?= number_format($pago->total,2) ?></a> </span>
                        <?php else: ?>
                            <span class="text"><?= $text ?> por concepto de <a href="/frontend/web/transacciones/editar?id=<?= $pago->id ?>&view=/transacciones&tipo=<?= $pago->tipo_id ?>&cliente=<?= $pago->cliente_id ?>"><?= $text2 ?></a> <a href="/frontend/web/transacciones/editar?id=<?= $pago->id ?>" class="float-right badge-pill badge-<?= $class ?>">RD$<?= number_format($pago->total,2) ?></a> </span>
                        <?php endif ?>
                        <?php if ($pago->concepto): ?>
                                            <a class='text-warning' href="#" data-toggle="tooltip" data-placement="top" title="<?= $pago->concepto ?>">
                                              <i class="ml-2 fas fa-comment-dots"></i>
                                            </a>
                                        <?php endif ?>
                    </div>
                </li>   
            <?php endforeach ?>
            <?php if (count($model) < 1): ?>
                <p class="mb-0">
                    No se han registrado importes.
                </p>
            <?php endif ?>
        </ol>
    </div>
    <div class="col-md-12" style="text-align: right;">
        <div class="">
            <?php 
            // display pagination
            if ($pagination) {
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pagination,
                    'options' => [
                        'class' => 'pagination pg-primary float-left',

                    ],
                    'linkOptions' => ['class' => 'page-link'],
                    'prevPageLabel' => false,
                    'nextPageLabel' => false,

                ]);
            }
            ?>
        </div>

    </div>
</div>
