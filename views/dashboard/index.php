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
                    <?= Html::a('Dashboard', ['dashboard/index'], ['class' => 'list-group-item list-group-item-action active']) ?>
                    <?= Html::a('Pembayaran', ['pembayaran/index'], ['class' => 'list-group-item list-group-item-action ']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createPendaftaranModal">
                            Tambah Pendaftaran
                        </button>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pendaftaranList)): ?>
                                <?php foreach ($pendaftaranList as $index => $p): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= Html::encode($p->nama) ?></td>
                                        <td><?= Html::encode($p->keluhan) ?></td>
                                        <td><?= Html::encode($p->dokter->nama ?? '-') ?></td>
                                        <td><?= Html::encode($p->status) ?></td>
                                        <td><?= Yii::$app->formatter->asDatetime($p->created_at) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada pendaftaran.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createPendaftaranModal" tabindex="-1" aria-labelledby="createPendaftaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <?php
            $form = ActiveForm::begin([
                'id' => 'pendaftaran-form',
                'action' => Url::to(['dashboard/creatependaftaran']),
                'enableAjaxValidation' => false, // jika kamu tidak pakai ajax validation
                'method' => 'post',
                'options' => ['enctype' => 'multipart/form-data'],
            ]);
            ?>

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createPendaftaranModalLabel">Form Pendaftaran Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup" type="button"></button>
            </div>

            <div class="modal-body">
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'keluhan')->textarea(['rows' => 3]) ?>
                <?= $form->field($model, 'dokter_id')->dropDownList($dokterList, ['prompt' => 'Pilih Dokter']) ?>
            </div>

            <div class="modal-footer">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary', 'id' => 'submitPendaftaranBtn']) ?>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>