<?php

namespace app\controllers;

use Yii;
use app\models\Obat;
use app\models\Pegawai;
use app\models\Pendaftaran;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PendaftaranController extends Controller
{
    public function actionIndex()
    {
        $pendaftaran = Pendaftaran::find()
            ->with(['dokter'])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        // Inisialisasi model baru untuk form
        $model = new Pendaftaran();

        // Ambil daftar dokter untuk dropdown
        $dokterList = Pegawai::find()
            ->select(['nama'])
            ->indexBy('id')
            ->asArray()
            ->column();

        // Debug - melihat format $dokterList
        // Yii::debug($dokterList, 'dokter list');

        // Render view dengan semua data yang diperlukan
        return $this->render('index', [
            "model" => $model,
            "pendaftaran" => $pendaftaran,
            "dokterList" => $dokterList,
        ]);
    }
    /**
     * Action untuk memperbarui data pendaftaran dari modal
     * @return mixed
     */
    public function actionUpdatependaftaran()
    {
        // Set format response ke JSON
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // Cek apakah request adalah POST
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');

            // Cari model pendaftaran berdasarkan ID
            $model = Pendaftaran::findOne($id);

            if ($model) {
                // Update atribut model
                $model->nama = Yii::$app->request->post('nama');
                $model->keluhan = Yii::$app->request->post('keluhan');
                $model->dokter_id = Yii::$app->request->post('dokter_id');

                // Ubah string kosong menjadi null untuk tindakan_id
                $tindakan_id = Yii::$app->request->post('tindakan_id');
                $model->tindakan_id = $tindakan_id === '' ? null : $tindakan_id;

                $harga = Yii::$app->request->post('harga');
                $model->harga = ($harga === '' || $harga === null) ? 0 : (int)$harga;

                // Ubah string kosong menjadi null untuk obat_id
                $obat_id = Yii::$app->request->post('obat_id');
                $model->obat_id = $obat_id === '' ? null : $obat_id;

                $model->status = Yii::$app->request->post('status');

                // Simpan model
                if ($model->save()) {
                    return [
                        'success' => true,
                        'message' => 'Data pendaftaran berhasil diperbarui.',
                        'data' => $model->attributes
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Gagal memperbarui data: ' . implode(', ', $model->getErrorSummary(true)),
                        'errors' => $model->errors
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Data pendaftaran tidak ditemukan.'
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Invalid request method.'
        ];
    }
}
