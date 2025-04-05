<?php
/* @var $this yii\web\View */

use app\models\Pegawai;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Dashboard User';
$this->params['breadcrumbs'][] = $this->title;
$dokterList = ArrayHelper::map(Pegawai::find()->all(), 'id', 'nama');
?>
<div class="dashboard-index">
    <div class="jumbotron text-center bg-transparent mt-5">
        <h1 class="display-4">Dashboard</h1>
        <p class="lead">Selamat datang di panel user dashboard.<?= Html::encode(Yii::$app->user->identity->fullname ?: Yii::$app->user->identity->username) ?></p>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">User Menu</h5>
                </div>
                <div class="list-group list-group-flush">
                    <?= Html::a('Dashboard', ['dashboard/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Pembayaran', ['pembayaran/index'], ['class' => 'list-group-item list-group-item-action active']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Transaksi</h5>
                </div>
                <div class="card-body">
                    <p>
                        Daftar tagihan pasien dengan status "Divalidasi" yang memerlukan pembayaran.
                    </p>
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Keluhan</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Tindakan</th>
                                <th>Obat</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pendaftaran as $p):
                                // Filter hanya menampilkan yang status Divalidasi
                                if ($p->status === 'Divalidasi'):
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= Html::encode($p->nama) ?></td>
                                        <td><?= Html::encode($p->keluhan) ?></td>
                                        <td><?= Html::encode($p->dokter->nama ?? '-') ?></td>
                                        <td><?= Html::encode($p->status) ?></td>
                                        <td><?= Html::encode($p->created_at) ?></td>
                                        <td><?= Html::encode($p->tindakan->nama ?? '-') ?></td>
                                        <td><?= Html::encode($p->obat->nama ?? '-') ?></td>
                                        <td><?= Html::encode($p->harga) ?></td>
                                    </tr>
                            <?php
                                endif;
                            endforeach;
                            ?>

                            <?php if ($no === 1): // Jika tidak ada data 
                            ?>
                                <tr>
                                    <td colspan="10" class="text-center">Tidak ada tagihan yang perlu dibayar</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>