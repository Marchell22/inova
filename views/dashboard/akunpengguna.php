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
                    <?= Html::a('Pengguna', ['dashboard/akunpengguna'], ['class' => 'list-group-item list-group-item-action active']) ?>
                    <?= Html::a('Pengaturan', ['setting/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Laporan', ['report/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Database', ['db/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Keamanan', ['security/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Akun Pengguna</h5>
                </div>
                <div class="card-body">
                    <p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
                            Tambah Pengguna
                        </button>
                    </p>

                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Fullname</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $i => $user): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= Html::encode($user->username) ?></td>
                                    <td><?= Html::encode($user->email) ?></td>
                                    <td><?= Html::encode($user->fullname) ?></td>
                                    <td><?= Html::encode($user->status) ?></td>
                                    <td>
                                        <?= Html::button('Edit', [
                                            'class' => 'btn btn-warning btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#editUserModal',
                                            'data-id' => $user->id,
                                            'data-username' => $user->username,
                                            'data-email' => $user->email,
                                            'data-fullname' => $user->fullname,
                                            'data-status' => $user->status,
                                        ]) ?>


                                        <?= Html::button('Delete', [
                                            'class' => 'btn btn-danger btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#deleteUserModal',
                                            'data-id' => $user->id,
                                            'data-username' => $user->username,
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


<?php $form = ActiveForm::begin([
    'action' => ['dashboard/create'],
    'method' => 'post',
]); ?>
<!-- Modal Create Data -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createUserModalLabel">Form Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'status')->dropDownList(['admin' => 'Admin', 'user' => 'User'], ['prompt' => 'Pilih Role']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<!-- Modal Edit Data -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editUserModalLabel">Form Edit Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <!-- Form edit tanpa POST -->
                <input type="hidden" id="edit-id" value="<?= $user->id ?>">
                <div class="mb-3">
                    <label for="edit-username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="edit-username">
                </div>
                <div class="mb-3">
                    <label for="edit-email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="edit-email">
                </div>
                <div class="mb-3">
                    <label for="edit-fullname" class="form-label">Fullname</label>
                    <input type="text" class="form-control" id="edit-fullname">
                </div>
                <div class="mb-3">
                    <label for="edit-password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" class="form-control" id="edit-password">
                </div>
                <div class="mb-3">
                    <label for="edit-status" class="form-label">Status</label>
                    <select class="form-select" id="edit-status">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveUserChanges">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Delete Data -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= Html::beginForm(['dashboard/delete'], 'post') ?>
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteUserModalLabel">Konfirmasi Hapus Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin ingin menghapus pengguna <strong id="delete-username-label"></strong>?</p>
                <?= Html::hiddenInput('id', '', ['id' => 'idUserHapus']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>


<?php
$this->registerJs(<<<JS
    $('#editUserModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // Tombol yang men-trigger modal
    const modal = $(this);
    const id = button.data('id'); // <= ini penting agar "id" terdefinisi

    console.log("ID dari data-id:", id);
  
    // Ambil data dari atribut data-*
    modal.find('#edit-username').val(button.data('username'));
    modal.find('#edit-email').val(button.data('email'));
    modal.find('#edit-fullname').val(button.data('fullname'));
    modal.find('#edit-status').val(button.data('status'));
    modal.find('#edit-password').val(''); // Kosongkan password
     console.log("ID yang akan dikirim ke controller:", id); // <== INI DIA

    $('#saveUserChanges').on('click', function () {
         const id = button.data('id');

        $.ajax({
            url: '/dashboard/update?id=' + id,
            method: 'POST',
            data: {
                username: $('#edit-username').val(),
                email: $('#edit-email').val(),
                fullname: $('#edit-fullname').val(),
                password: $('#edit-password').val(),
                status: $('#edit-status').val()
            },
            success: function (response) {
                if (response.success) {
                    alert('Data pengguna berhasil diperbarui.');
                    $('#editUserModal').modal('hide');
                    location.reload(); // Atau kamu bisa update datanya secara dinamis
                } else {
                    alert('Gagal memperbarui pengguna.');
                    console.log(response.errors);
                }
            },
            error: function () {
                alert('Terjadi kesalahan saat mengirim data ke server.');
            }
        });
    });
});
JS);
?>
<?php
$this->registerJs(<<<JS
    var deleteUserModal = document.getElementById('deleteUserModal');
    deleteUserModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-id');
        var userName = button.getAttribute('data-nama');

        document.getElementById('idUserHapus').value = userId;
        document.getElementById('delete-username-label').textContent = userName;

        console.log('ID yang akan dihapus:', userId); // debug
    });
JS);
?>