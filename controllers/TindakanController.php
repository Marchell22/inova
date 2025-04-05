<?php

namespace app\controllers;

use Yii;
use app\models\Tindakan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TindakanController extends Controller
{
    public function actionIndex()
    {
        $tindakan = Tindakan::find()->all();
        $model = new Tindakan();
        return $this->render('index', ['model' => $model, 'tindakan' => $tindakan]);
    }
    public function actionCreate()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model = new Tindakan();
            $model->kode = $request->post('kode');
            $model->nama = $request->post('nama');
            $model->harga = $request->post('harga');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Tindakan berhasil ditambahkan.');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menambahkan tindakan.');
            }
        }

        return $this->redirect(['tindakan/index']);
    }
    public function actionUpdate()
    {
        $request = Yii::$app->request;
        $id = $request->post('id');
        $model = Tindakan::findOne($id);

        if ($model !== null) {
            $model->kode = $request->post('kode');
            $model->nama = $request->post('nama');
            $model->harga = $request->post('harga');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Tindakan berhasil diperbarui.');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal memperbarui tindakan.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Data tidak ditemukan.');
        }

        return $this->redirect(['index']);
    }
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        try {
            $model = Tindakan::findOne($id);
            if ($model && $model->delete()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Gagal menghapus'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
