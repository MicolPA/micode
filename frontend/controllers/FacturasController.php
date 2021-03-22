<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Facturas;
use frontend\models\FacturasDetalle;
use frontend\models\FacturasSearch;
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
    public function actionVer($id)
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

    /**
     * Creates a new Facturas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegistrar()
    {
        $model = new Facturas();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {

            print_r($post);
            $model->date = date("Y-m-d H:i:s");
            $model->user_id = Yii::$app->user->identity->id;
            $model->save();
            $this->registerInvoiceDetail($post, $model);
            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    function registerInvoiceDetail($post, $model){

        for ($i = 0; $i <= count($post['factura_descripcion']); $i++) {
            
            if (isset($post['factura_descripcion'][$i])) {

                $invoiceDetail = new FacturasDetalle();
                $invoiceDetail->factura_id = $model->id;
                $invoiceDetail->descripcion = $post['factura_descripcion'][$i];
                $invoiceDetail->precio = $post['factura_precio'][$i];
                $invoiceDetail->date = date("Y-m-d H:i:s");
                $invoiceDetail->save(false);
            }
        }   

    }

    /**
     * Updates an existing Facturas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
