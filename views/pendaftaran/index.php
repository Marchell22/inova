<?php
/* @var $this yii\web\View */

use app\models\Pegawai;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = 'Admin Dashboard';
$this->params['breadcrumbs'][] = $this->title;

// Get total users count
$totalUsers = \app\models\User::find()->count();
$dokterList = ArrayHelper::map(Pegawai::find()->all(), 'id', 'nama');
?>
<div class="dashboard-admin">
    <div class="jumbotron text-center bg-transparent mt-4">
        <h1 class="display-4">Admin Dashboard</h1>
        <p class="lead">Selamat datang di panel admin, <?= Html::encode(Yii::$app->user->identity->fullname ?: Yii::$app->user->identity->username) ?>!</p>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Admin Menu</h5>
                </div>
                <div class="list-group list-group-flush">
                    <?= Html::a('Dashboard', ['dashboard/admin'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Pengguna', ['dashboard/akunpengguna'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Wilayah', ['wilayah/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Obat', ['obat/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Pegawai', ['pegawai/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Tindakan', ['tindakan/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Pendaftaran Pasien', ['pendaftaran/index'], ['class' => 'list-group-item list-group-item-action active']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Pendaftaran</h5>
                </div>
                <div class="card-body">


                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Keluhan</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendaftaran as $index => $p): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= Html::encode($p->nama) ?></td>
                                    <td><?= Html::encode($p->keluhan) ?></td>
                                    <td><?= Html::encode($p->dokter->nama ?? '-') ?></td>
                                    <td><?= Html::encode($p->status) ?></td>
                                    <td><?= Yii::$app->formatter->asDatetime($p->created_at) ?></td>
                                    <td>
                                        <?= Html::button('Validasi', [
                                            'class' => 'btn btn-warning btn-sm btn-edit-pendaftaran',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#editPendaftaranModal',
                                            'data-id' => $p->id,
                                            'data-nama' => $p->nama,
                                            'data-keluhan' => $p->keluhan,
                                            'data-dokter' => $p->dokter_id,
                                            'data-status' => $p->status,
                                        ]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPendaftaranModal" tabindex="-1" aria-labelledby="editPendaftaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin([
                'id' => 'form-edit-pendaftaran',
                'action' => Url::to(['pendaftaran/updatependaftaran']), // sesuaikan dengan controller
                'method' => 'post'
            ]); ?>

            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">Edit Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <?= Html::hiddenInput('id', '', ['id' => 'edit-id']) ?>
                <div class="mb-3">
                    <?= Html::label('Nama') ?>
                    <?= Html::textInput('nama', '', ['class' => 'form-control', 'id' => 'edit-nama']) ?>
                </div>
                <div class="mb-3">
                    <?= Html::label('Keluhan') ?>
                    <?= Html::textarea('keluhan', '', ['class' => 'form-control', 'id' => 'edit-keluhan', 'rows' => 3]) ?>
                </div>
                <div class="mb-3">
                    <?= Html::label('Pegawai') ?>
                    <?= Html::dropDownList('dokter_id', null, $dokterList, ['class' => 'form-control', 'id' => 'edit-dokter']) ?>
                </div>
                <!-- Tambahkan kolom Tindakan -->
                <div class="mb-3">
                    <?= Html::label('Tindakan') ?>
                    <?= Html::dropDownList(
                        'tindakan_id',
                        '',
                        ArrayHelper::map(\app\models\Tindakan::find()->all(), 'id', 'nama'),
                        ['class' => 'form-control', 'id' => 'edit-tindakan', 'prompt' => 'Pilih Tindakan']
                    ) ?>
                </div>

                <!-- Tambahkan kolom Obat -->
                <div class="mb-3">
                    <?= Html::label('Obat') ?>
                    <?= Html::dropDownList(
                        'obat_id',
                        '',
                        ArrayHelper::map(\app\models\Obat::find()->all(), 'id', 'nama'),
                        ['class' => 'form-control', 'id' => 'edit-obat', 'prompt' => 'Pilih Obat']
                    ) ?>
                </div>
                <div class="mb-3">
                    <?= Html::label('Harga') ?>
                    <?= Html::textInput('harga', '', [
                        'class' => 'form-control',
                        'id' => 'edit-harga',
                        'type' => 'number',
                        'step' => '0.01',
                        'min' => '0'
                    ]) ?>
                </div>
                <div class="mb-3">
                    <?= Html::label('Status') ?>
                    <?= Html::dropDownList(
                        'status',
                        '',
                        [
                            'Menunggu' => 'Menunggu',
                            'Divalidasi' => 'Divalidasi',
                            'Ditolak' => 'Ditolak'
                        ],
                        ['class' => 'form-control', 'id' => 'edit-status']
                    ) ?>
                </div>
            </div>

            <div class="modal-footer">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
$this->registerJs(<<<JS
// Mendeteksi klik pada tombol dengan class btn-edit-pendaftaran
$(document).on('click', '[data-bs-target="#editPendaftaranModal"]', function () {
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var keluhan = $(this).data('keluhan');
    var dokter = $(this).data('dokter');
    var tindakan = $(this).data('tindakan');
    var obat = $(this).data('obat');
    var harga = $(this).data('harga');
    var status = $(this).data('status');
    
    // Debugging - periksa nilai yang diterima
    console.log('Modal ditampilkan dengan nilai:');
    console.log('ID:', id);
    console.log('Nama:', nama);
    console.log('Keluhan:', keluhan);
    console.log('Dokter ID:', dokter);
    console.log('Tindakan ID:', tindakan);
    console.log('Obat ID:', obat);
    console.log('Harga:', harga);
    console.log('Status:', status);
    
    // Isi nilai ke form
    $('#edit-id').val(id);
    $('#edit-nama').val(nama);
    $('#edit-keluhan').val(keluhan);
    $('#edit-dokter').val(dokter);
    $('#edit-tindakan').val(tindakan);
    $('#edit-obat').val(obat);
    $('#edit-harga').val(harga);
    $('#edit-status').val(status);
});

// Tampilkan modal setelah data dimuat
$('#editPendaftaranModal').on('shown.bs.modal', function () {
    console.log('Modal ditampilkan dengan nilai terakhir:');
    console.log('ID:', $('#edit-id').val());
    console.log('Nama:', $('#edit-nama').val());
    console.log('Keluhan:', $('#edit-keluhan').val());
    console.log('Dokter:', $('#edit-dokter').val());
    console.log('Tindakan:', $('#edit-tindakan').val());
    console.log('Obat:', $('#edit-obat').val());
    console.log('Harga:', $('#edit-harga').val());
    console.log('Status:', $('#edit-status').val());
});
$('#form-edit-pendaftaran').on('submit', function(e) {
    e.preventDefault();
    
    // Ambil data form
    var formData = $(this).serialize();
    
    // Tampilkan loading indicator (opsional)
    // $('.modal-content').addClass('loading');
    
    // Kirim data via AJAX
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Tampilkan pesan sukses
                alert(response.message);
                
                // Tutup modal
                $('#editPendaftaranModal').modal('hide');
                
                // Reload halaman untuk melihat perubahan
                // Alternatif: Update baris tabel tanpa reload
                location.reload();
            } else {
                // Tampilkan pesan error
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            // Tangani error
            alert('Terjadi kesalahan: ' + error);
        },
        complete: function() {
            // Sembunyikan loading indicator (opsional)
            // $('.modal-content').removeClass('loading');
        }
    });
});
JS);
?>