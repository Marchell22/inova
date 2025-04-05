<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Pendaftaran;
use app\models\Pembayaran;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class PembayaranController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'bayar', 'detail'],
                'rules' => [
                    [
                        'actions' => ['index', 'bayar', 'detail'],
                        'allow' => true,
                        'roles' => ['@'], // Hanya user terautentikasi
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'bayar' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Menampilkan daftar tagihan pasien yang perlu dibayar (status divalidasi)
     */
    public function actionIndex()
    {
        $pendaftaran = Pendaftaran::find()
            ->with(['dokter', 'tindakan', 'obat'])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'pendaftaran' => $pendaftaran,
        ]);
    }

    /**
     * Menampilkan detail tagihan
     */
   
}
