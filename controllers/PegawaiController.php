<?php

namespace app\controllers;

use Yii;
use app\models\Obat;
use app\models\Pegawai;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PegawaiController extends Controller
{
    public function actionIndex()
    {
        $pegawai = Pegawai::find()->all();
        $model = new Pegawai();
        return $this->render('index', ["model" => $model, "pegawai" => $pegawai]);
    }
    public function actionCreate()
    {
        $model = new \app\models\Pegawai();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data pegawai berhasil ditambahkan.');
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = Pegawai::findOne($id);
        if (!$model) {
            return $this->asJson(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        $model->load(Yii::$app->request->post(), '');

        if ($model->save()) {
            return $this->asJson(['success' => true]);
        }

        return $this->asJson(['success' => false, 'errors' => $model->errors]);
    }
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = Pegawai::findOne($id);
        if (!$model) {
            return ['success' => false, 'message' => 'Data tidak ditemukan'];
        }

        if ($model->delete()) {
            return ['success' => true];
        }

        return ['success' => false, 'message' => 'Gagal menghapus data'];
    }
}
