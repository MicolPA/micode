<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Facturas;
use frontend\models\FacturasDetalle;
use frontend\models\FacturasSearch;
use frontend\models\Transacciones;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * FacturasController implements the CRUD actions for Facturas model.
 */
class FacturasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Facturas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FacturasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Facturas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionVerOld($id)
    {
        $model = $this->findModel($id);
        $detalle = FacturasDetalle::find()->where(['factura_id' => $model->id])->all();
        $content = $this->renderPartial('invoice_template',['model' => $model, 'detalles' => $detalle]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => [150.8, 228.6],
            'marginTop' => 0,
            'marginLeft' => 0,
            'marginRight' => 0,
            'marginBottom' => 0,
            // 'format' => Pdf::FORMAT_LETTER,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Sysgel Reporte'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>[false],
                'SetFooter'=>[false],
                'SetWatermarkText' => ['DRAFT'],
                'SetWatermarkImage' => ['/frontend/web/images/figuras.png'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
    public function actionVer($id)
    {
        $model = $this->findModel($id);
        $detalle = FacturasDetalle::find()->where(['factura_id' => $model->id])->all();
        $content = $this->renderPartial('invoice_template-white',['model' => $model, 'detalles' => $detalle]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            // 'format' => Pdf::FORMAT_A4, 
            'format' => [220.8, 258.6],  
            'marginTop' => 0,
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginBottom' => 10,
            // 'format' => Pdf::FORMAT_LETTER,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Sysgel Reporte'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>[false],
                'SetFooter'=>[false],
                'SetWatermarkText' => ['DRAFT'],
                'SetWatermarkImage' => ['/frontend/web/images/figuras.png'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    /**
     * Creates a new Facturas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegistrar($cliente_id=null, $w_client=1, $type=0)
    {
        $model = new Facturas();
        $model->cotizacion = $type;
        $post = Yii::$app->request->post();
                // $this->countFacturas('limite_cotizaciones');
        
        if ($model->load($post)) {
            $config = \frontend\models\Configuracion::findOne(1);

            // print_r($post);
            $model->pagada = isset($model->pagada[0]) ? $model->pagada[0] : 0;
            $model->status_id = $model->pagada ? 1 : 2;
            // $model->date = date("Y-m-d H:i:s");
            $model->user_id = Yii::$app->user->identity->id;
            $model->active = 1;

            if ($model->impuestos) {$model->impuestos = $config['impuestos'];}

            if (!$model->save()) {
                Yii::$app->session->setFlash('fail', "Ha ocurrido un error, intente más tarde nuevamente.");
            }

            // $servicios = new \common\models\Servicios();
            // $field_name = $model->cotizacion == 1 ? 'cotizaciones_total' : 'facturas_total';
            // $servicios->countFieldConfig($field_name);
            $model->factura_code = $this->getCode($model, $config);
            $model->fecha_registro = date("Y-m-d H:i:s");
            $model->save();
            $this->registerInvoiceDetail($post, $model);
            
            // if ($model->status_id == 1) {
                $transaccion = new Transacciones();
                $transaccion->saveTransaccion($model, $model->status_id == 3 ? 2 : 1);
                // $model->registrarTransaccion($model->id);
            // }
            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('create', [
            'w_client' => $w_client,
            'cliente_id' => $cliente_id,
            'type' => $type,
            'model' => $model,
        ]);
    }


    function getCode($model, $config){

        $count = Facturas::find()->where(['cotizacion' => $model->cotizacion, 'active' => 1])->count();
        $count = $count + 1;
        
        if ($model->cotizacion) {
            $count = $config['codigo_cotizacion']."000$count";
        }else{
            $count = $config['codigo_factura']."000$count";
        }

        return $count;
    }

    function registerInvoiceDetail($post, $model){

        for ($i = -1; $i <= count($post['factura_descripcion']); $i++) {
            
            if (isset($post['factura_descripcion'][$i])) {

                if ($post['factura_descripcion'][$i]) {
                    $invoiceDetail = new FacturasDetalle();
                    $invoiceDetail->factura_id = $model->id;
                    $invoiceDetail->descripcion = $post['factura_descripcion'][$i];
                    $invoiceDetail->precio = str_replace(',', '', $post['factura_precio'][$i]);
                    $invoiceDetail->cantidad = isset($post['factura_cantidad'][$i]) ? $post['factura_cantidad'][$i] : null;
                    $cantidad = $invoiceDetail->cantidad ? $invoiceDetail->cantidad : 1;
                    $invoiceDetail->total = $invoiceDetail->precio * $cantidad;
                    $invoiceDetail->date = date("Y-m-d H:i:s");
                    $invoiceDetail->save(false);
                }
            }
        }   

    }

    function actionMarkAsPaid($id){

        $model = Facturas::findOne($id);
        if ($model) {
            $model->pagada = 1;
            $model->fecha_pagada = date("Y-m-d");
            $model->save();
        }
        Yii::$app->session->setFlash('success', "Sello de pago colocado correctamente");
        return $this->redirect(['index']);
    }

    

    function actionConvertirFactura($id){

        $cotizacion = Facturas::findOne($id);
        $config = \frontend\models\Configuracion::findOne(1);
        if ($cotizacion) {

            // $servicios = new \common\models\Servicios();
            // $servicios->countFieldConfig( 'facturas_total');

            $cotizacion->cotizacion = 0;
            $cotizacion->date = date("Y-m-d H:i:s");
            $cotizacion->factura_code = $this->getCode($cotizacion, $config);
            $cotizacion->save();
            $transaccion = new Transacciones();
            $transaccion->saveTransaccion($cotizacion);

            // $model = new Facturas();
            // $model->cliente_id = $cotizacion->cliente_id;
            // $model->cliente_nombre = $cotizacion->cliente_nombre;
            // $model->asunto = $cotizacion->asunto;
            // $model->total = $cotizacion->total;
            // $model->user_id = $cotizacion->user_id;
            // $model->date = $cotizacion->date;
            // $model->cotizacion = 0;
            // $model->moneda = $cotizacion->moneda;
            // $model->pagada = $cotizacion->pagada;
            // $model->fecha_pagada = $cotizacion->fecha_pagada;
            // $model->comprobante = $cotizacion->comprobante;
            // $model->nota = $cotizacion->nota;
            // $model->impuestos = $cotizacion->impuestos;
            // $model->factura_code = $this->getCode($model, $config);
            // if ($model->save()) {
            //     $servicios = new \common\models\Servicios();
            //     $servicios->countFieldConfig( 'facturas_total');
            //     $this->getInvoiceDetail($cotizacion->id, $model->id);
            // }
            Yii::$app->session->setFlash('success', "Cambio realizado correctamente");
        }
        return $this->redirect(Yii::$app->request->referrer); 
    }

    /**
     * Updates an existing Facturas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditar($id, $w_client=1)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        $detalles = FacturasDetalle::find()->where(['factura_id' => $id])->all();
        if ($model->load($post)) {
            $model->pagada = isset($model->pagada[0]) ? $model->pagada[0] : 0;
            $model->status_id = $model->pagada ? 1 : $model->status_id;
            $model->cotizacion = $model->pagada ? 0 : $model->cotizacion;
            $model->save();
            $this->deleteRegisterInvoiceDetail($detalles);
            $this->registerInvoiceDetail($post, $model);

            // if ($model->status_id == 1) {
                // $transaccion = new Transacciones();
                // $transaccion->saveTransaccion($model);
                // $model->registrarTransaccion($model->id);
            // }
            $transaccion = new Transacciones();
            $transaccion->saveTransaccion($model, $model->status_id == 3 ? 2 : 1);
            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'detalles' => $detalles,
            'w_client' => $w_client,
            'type' => $model->cotizacion
        ]);
    }

    function deleteRegisterInvoiceDetail($detalles){

        foreach($detalles as $d){
            $d->delete();
        }

    }

    /**
     * Deletes an existing Facturas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Facturas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Facturas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Facturas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
