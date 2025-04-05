<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "wilayah".
 *
 * @property int $id
 * @property string $nama
 * @property string $kode
 * @property string $created_at
 * @property string $updated_at
 */
class Wilayah extends ActiveRecord
{
    public static function tableName()
    {
        return 'wilayah';
    }

    public function rules()
    {
        return [
            [['nama', 'kode'], 'required'],
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'string', 'max' => 20],
            [['kode'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama Wilayah',
            'kode' => 'Kode Wilayah',
            'created_at' => 'Dibuat Pada',
            'updated_at' => 'Diperbarui Pada',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
