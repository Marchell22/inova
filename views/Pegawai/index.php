<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Admin Dashboard';
$this->params['breadcrumbs'][] = $this->title;

// Get total users count
$totalUsers = \app\models\User::find()->count();
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
                    <?= Html::a('Pegawai', ['pegawai/index'], ['class' => 'list-group-item list-group-item-action active']) ?>
                    <?= Html::a('Tindakan', ['tindakan/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Pegawai</h5>
                </div>
                <div class="card-body">
                    <p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createPegawaiModal">
                            Tambah Pegawai
                        </button>
                    </p>

                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pegawai as $i => $d): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= Html::encode($d->nip) ?></td>
                                    <td><?= Html::encode($d->nama) ?></td>
                                    <td><?= Html::encode($d->jabatan) ?></td>

                                    <td>
                                        <?= Html::button('Edit', [
                                            'class' => 'btn btn-warning btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#editPegawaiModal',
                                            'data-id' => $d->id,
                                            'data-nama' => $d->nama,
                                            'data-nip' => $d->nip,
                                            'data-jabatan' => $d->jabatan,
                                        ]) ?>

                                        <?= Html::button('Delete', [
                                            'class' => 'btn btn-danger btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#deletePegawaiModal',
                                            'data-id' => $d->id,
                                            'data-nama' => $d->nama,
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
<!-- Modal Tambah Pegawai -->
<div class="modal fade" id="createPegawaiModal" tabindex="-1" aria-labelledby="createPegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createPegawaiModalLabel">Form Tambah Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <?php \yii\widgets\Pjax::begin(['id' => 'pjax-create-pegawai']); ?>
                <?php $form = \yii\widgets\ActiveForm::begin([
                    'action' => ['pegawai/create'],
                    'options' => ['data' => ['pjax' => true]]
                ]); ?>

                <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <?= \yii\helpers\Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
                <?php \yii\widgets\Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Pegawai -->
<div class="modal fade" id="editPegawaiModal" tabindex="-1" aria-labelledby="editPegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editPegawaiModalLabel">Edit Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-pegawai-id">
                <div class="mb-3">
                    <label for="edit-nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="edit-nip">
                </div>
                <div class="mb-3">
                    <label for="edit-nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="edit-nama">
                </div>
                <div class="mb-3">
                    <label for="edit-jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="edit-jabatan">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="savePegawaiChanges">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs(<<<JS
$('#editPegawaiModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    $('#edit-pegawai-id').val(button.data('id'));
    $('#edit-nip').val(button.data('nip'));
    $('#edit-nama').val(button.data('nama'));
    $('#edit-jabatan').val(button.data('jabatan'));
});

$('#savePegawaiChanges').on('click', function () {
    const id = $('#edit-pegawai-id').val();

    $.ajax({
        url: '/pegawai/update?id=' + id,
        type: 'POST',
        data: {
            nip: $('#edit-nip').val(),
            nama: $('#edit-nama').val(),
            jabatan: $('#edit-jabatan').val(),
            _csrf: yii.getCsrfToken()
        },
        success: function (res) {
            alert('Data pegawai berhasil diperbarui!');
            $('#editPegawaiModal').modal('hide');
            location.reload();
        },
        error: function () {
            alert('Terjadi kesalahan saat memperbarui data.');
        }
    });
});
JS);
?>

<!-- Modal Hapus Pegawai -->
<div class="modal fade" id="deletePegawaiModal" tabindex="-1" aria-labelledby="deletePegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deletePegawaiModalLabel">Konfirmasi Hapus Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin ingin menghapus pegawai <strong id="namaPegawaiHapus"></strong>?</p>
                <input type="hidden" id="pegawaiIdHapus">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="hapusPegawaiBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs(<<<JS
$('#deletePegawaiModal').on('show.bs.modal', function (event) {
const button = $(event.relatedTarget);
const id = button.data('id');
const nama = button.data('nama');

$('#pegawaiIdHapus').val(id);
$('#namaPegawaiHapus').text(nama);
});

$('#hapusPegawaiBtn').on('click', function () {
const id = $('#pegawaiIdHapus').val();

$.ajax({
url: '/pegawai/delete?id=' + id,
type: 'POST',
data: {
_csrf: yii.getCsrfToken()
},
success: function (res) {
alert('Pegawai berhasil dihapus.');
$('#deletePegawaiModal').modal('hide');
location.reload();
},
error: function () {
alert('Terjadi kesalahan saat menghapus data.');
}
});
});
JS);
?>