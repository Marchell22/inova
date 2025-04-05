<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tindakan".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property float $harga
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Tindakan extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tindakan';
    }

    public function rules()
    {
        return [
            [['kode', 'nama', 'harga'], 'required'],
            [['harga'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['kode'], 'string', 'max' => 20],
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode Tindakan',
            'nama' => 'Nama Tindakan',
            'harga' => 'Harga',
            'created_at' => 'Dibuat Pada',
            'updated_at' => 'Diperbarui Pada',
        ];
    }
}
