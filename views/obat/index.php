<?php
/* @var $this yii\web\View */

use app\models\User;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap5\ActiveForm;

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
                    <?= Html::a('Pengguna', ['dashboard/akunpengguna'], ['class' => 'list-group-item list-group-item-action ']) ?>
                    <?= Html::a('Wilayah', ['wilayah/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Obat', ['obat/index'], ['class' => 'list-group-item list-group-item-action active']) ?>
                    <?= Html::a('Pegawai', ['pegawai/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Tindakan', ['tindakan/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Pendaftaran Pasien', ['pendaftaran/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Obat</h5>
                </div>
                <div class="card-body">
                    <p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createObatModal">
                            Tambah Obat
                        </button>
                    </p>

                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kode</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($obat as $i => $d): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= Html::encode($d->nama) ?></td>
                                    <td><?= Html::encode($d->kode) ?></td>
                                    <td><?= Html::encode($d->harga) ?></td>

                                    <td>
                                        <?= Html::button('Edit', [
                                            'class' => 'btn btn-warning btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#editObatModal',
                                            'data-id' => $d->id,
                                            'data-kode' => $d->kode,
                                            'data-nama' => $d->nama,
                                            'data-harga' => $d->harga,
                                        ]) ?>

                                        <?= Html::button('Delete', [
                                            'class' => 'btn btn-danger btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#deleteObatModal',
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
<!-- Modal Tambah Obat -->
<div class="modal fade" id="createObatModal" tabindex="-1" aria-labelledby="createObatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createObatModalLabel">Tambah Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <?php $form = \yii\widgets\ActiveForm::begin([
                    'action' => ['obat/create-obat'],
                    'method' => 'post',
                ]); ?>

                <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'harga')->input('number') ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal Delete Obat -->
<div class="modal fade" id="deleteObatModal" tabindex="-1" aria-labelledby="deleteObatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteObatModalLabel">Konfirmasi Hapus Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin ingin menghapus obat <strong id="namaObatHapus"></strong>?</p>
                <?php \yii\widgets\ActiveForm::begin([
                    'id' => 'form-delete-obat',
                    'action' => ['obat/delete'],
                    'method' => 'post',
                ]); ?>

                <?= \yii\helpers\Html::hiddenInput('id', '', ['id' => 'obatIdHapus']) ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Obat -->
<div class="modal fade" id="editObatModal" tabindex="-1" aria-labelledby="editObatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editObatModalLabel">Edit Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-obat-id">

                <div class="mb-3">
                    <label for="edit-obat-kode" class="form-label">Kode Obat</label>
                    <input type="text" class="form-control" id="edit-obat-kode">
                </div>

                <div class="mb-3">
                    <label for="edit-obat-nama" class="form-label">Nama Obat</label>
                    <input type="text" class="form-control" id="edit-obat-nama">
                </div>

                <div class="mb-3">
                    <label for="edit-obat-harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="edit-obat-harga">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanEditObat">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>


<?php
$this->registerJs(<<<JS
    $('#deleteObatModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var nama = button.data('nama');
        var id = button.data('id');

        $('#namaObatHapus').text(nama);
        $('#obatIdHapus').val(id);

        console.log("ID obat yang akan dihapus:", id);
    });
JS);
?>

<?php
$this->registerJs(<<<JS
    $('#editObatModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const modal = $(this);

        modal.find('#edit-obat-id').val(button.data('id'));
        modal.find('#edit-obat-kode').val(button.data('kode'));
        modal.find('#edit-obat-nama').val(button.data('nama'));
        modal.find('#edit-obat-harga').val(button.data('harga'));
    });

    $('#simpanEditObat').on('click', function () {
        const id = $('#edit-obat-id').val();
        const data = {
            kode: $('#edit-obat-kode').val(),
            nama: $('#edit-obat-nama').val(),
            harga: $('#edit-obat-harga').val(),
        };

        $.ajax({
            url: '/obat/update?id=' + id,
            type: 'POST',
            data: data,
            success: function (response) {
                if (response.success) {
                    alert('Obat berhasil diperbarui!');
                    $('#editObatModal').modal('hide');
                    location.reload();
                } else {
                    alert('Gagal memperbarui obat.');
                    console.log(response.errors);
                }
            },
            error: function () {
                alert('Terjadi kesalahan.');
            }
        });
    });
JS);
?>