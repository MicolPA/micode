<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Transacciones;
use frontend\models\Tarjetas;
use frontend\models\Clientes;
use frontend\models\TransaccionesDetalle;
use frontend\models\TransaccionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransaccionesController implements the CRUD actions for Transacciones model.
 */
class TransaccionesController extends Controller
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
                    // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transacciones models.
     * @return mixed
     */
    public function actionIndex($tipo_id=null)
    {
        $cuentas = Tarjetas::find()->all();

        $searchModel = new TransaccionesSearch();
        $searchModel->tipo_id = $tipo_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = $dataProvider->query;
        $countQuery = clone $query;
        $pagination = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $model = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        return $this->render('index', [
            'cuentas' => $cuentas,
            'model' => $model,
            'pagination' => $pagination,
            'name' => 'finanzas',
            'searchModel' => $searchModel,
            'tipo_id' => $tipo_id,
        ]);
    }

    function verificarMonto(){
        $servicios = new \common\models\Servicios();
        $servicios->verificarMonto();
    }


    public function actionCostosProduccion()
    {
        $query = Transacciones::find()->where(['tipo_id' => 3])->orderBy(['fecha_pago' => SORT_DESC, 'tipo_id' => SORT_DESC, 'id' => SORT_DESC]);
        $countQuery = clone $query;
        $pagination = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $model = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        return $this->render('index', [
            'model' => $model,
            'pagination' => $pagination,
            'name' => 'costos de producción'
        ]);
    }

    /**
     * Displays a single Transacciones model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetalle($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transacciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegistrar($cliente=null, $view, $colaborador_id=null)
    {
        // $this->verificarMonto();
        $model = new Transacciones();
        $cuentas = Tarjetas::find()->all();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->colaborador = $post['colaborador_id'] ? 1 : 0;
            $model->date = date("Y-m-d H:i:s");
            $model->user_id = Yii::$app->user->identity->id;
            if (!$model->save()) {
                print_r($model->errors);
                exit;
            }

            $model->registrarDetalleTransaccion($post, $cuentas, $model, $post['colaborador_id']);
            Yii::$app->session->setFlash('success', "Transacción registrada correctamente");
            $this->redirect(["/".$view]);
            // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'cuentas' => $cuentas,
            'colaborador_id' => $colaborador_id,
        ]);
    }

    

    function registrarImporteColaborador($colaborador_id, $amount, $model){
        if ($amount) {
            $amount = str_replace(',', '', $amount);
            $transaccion = new TransaccionesDetalle();
            $transaccion->tarjeta_id = null;
            $transaccion->transaccion_id = $model->id;
            $transaccion->fecha_pago = $model->fecha_pago;
            $transaccion->total = $amount;
            $transaccion->tipo_id = $model->tipo_id;
            $transaccion->colaborador_id = $colaborador_id;
            $transaccion->user_id = Yii::$app->user->identity->id;
            $transaccion->date = date("Y-m-d H:i:s");
            if (!$transaccion->save()) {
                print_r($transaccion->errors);
                exit;
            }
        }
    }

    public function actionEditar($id, $view='/transacciones')
    {
        // $this->verificarMonto();
        $model = $this->findModel($id);
        $cuentas = Tarjetas::find()->all();
        $post = Yii::$app->request->post();

        $colaborador_id = TransaccionesDetalle::find()->where(['transaccion_id' => $id])->andWhere(['>', 'colaborador_id', 1])->one()['colaborador_id'];

        if ($model->load($post) && $model->save()) {
            $model->colaborador = $post['colaborador_id'] ? 1 : 0;
            $model->registrarDetalleTransaccion($post, $cuentas, $model, $post['colaborador_id']);
            Yii::$app->session->setFlash('success', "Transacción actualizada correctamente");
            $this->redirect(["/".$view]);
        }

        return $this->render('update', [
            'model' => $model,
            'view' => $view,
            'cuentas' => $cuentas,
            'colaborador_id' => $colaborador_id,
        ]);
    }

  
    public function actionEditarOld($id, $cliente=null, $tipo, $view)
    {
        $model = $this->findModel($id);
        $cuentas = Tarjetas::find()->all();
        $cliente_info = Clientes::findOne($cliente);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->registrarDetalle($post, $cuentas, $model, $colaborador_id);
            Yii::$app->session->setFlash('success', "Transacción actualizada correctamente");
            return $this->redirect([$view]);
        }

        return $this->render('update', [
            'model' => $model,
            'view' => $view,
            'cuentas' => $cuentas,
            'cliente_info' => $cliente_info,
        ]);
    }

    /**
     * Deletes an existing Transacciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $view){

        $model = $this->findModel($id);
        $detalle_transacciones = TransaccionesDetalle::find()->where(['transaccion_id' => $id])->all();
        foreach ($detalle_transacciones as $d) {
            $cuenta = Tarjetas::findOne($d->tarjeta_id);
            if ($model->tipo_id == 1) {
                $cuenta->dinero_total = $cuenta->dinero_total - $d->total;
            }else{
                $cuenta->dinero_total = $cuenta->dinero_total + $d->total;
            }
            $cuenta->save(false);
        }
        $model->delete();

        Yii::$app->session->setFlash('success', "Transacción eliminada correctamente");
        return $this->redirect([$view]);
    }

    /**
     * Finds the Transacciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transacciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transacciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
