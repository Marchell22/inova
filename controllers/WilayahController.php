<?php

namespace app\controllers;

use Yii;
use app\models\Wilayah;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

class WilayahController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $wilayah = Wilayah::find()->all();
        return $this->render('index', ['wilayah' => $wilayah]);
    }



    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Wilayah();

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return ['success' => true];
        }

        return [
            'success' => false,
            'errors' => $model->getErrors(),
        ];
    }


    public function actionUpdate($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = Wilayah::findOne($id);

        if (!$model) {
            return ['success' => false, 'message' => 'Data wilayah tidak ditemukan.'];
        }

        $model->kode = Yii::$app->request->post('kode');
        $model->nama = Yii::$app->request->post('nama');

        if ($model->save()) {
            return ['success' => true];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = Wilayah::findOne($id);

        if (!$model) {
            return ['success' => false, 'message' => 'Data tidak ditemukan.'];
        }

        if ($model->delete()) {
            return ['success' => true];
        } else {
            return ['success' => false, 'message' => 'Gagal menghapus data.'];
        }
    }


    // protected function findModel($id)
    // {
    //     if (($model = Wilayah::findOne($id)) !== null) {
    //         return $model;
    //     }

    //     throw new NotFoundHttpException('Data tidak ditemukan.');
    // }
}
