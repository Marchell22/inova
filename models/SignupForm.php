<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $fullname;
    public $terms;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['fullname', 'required', 'message' => 'Nama lengkap tidak boleh kosong'],
            ['fullname', 'string', 'min' => 2, 'max' => 255],

            ['username', 'trim'],
            ['username', 'required', 'message' => 'Username tidak boleh kosong'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Username ini sudah digunakan.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Email tidak boleh kosong'],
            ['email', 'email', 'message' => 'Email tidak valid.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Email ini sudah digunakan.'],

            ['password', 'required', 'message' => 'Password tidak boleh kosong'],
            ['password', 'string', 'min' => 6, 'message' => 'Password minimal 6 karakter.'],

            ['confirmPassword', 'required', 'message' => 'Konfirmasi password tidak boleh kosong'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Password tidak cocok.'],

            ['terms', 'required', 'requiredValue' => 1, 'message' => 'Anda harus menyetujui syarat dan ketentuan.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->fullname = $this->fullname;
        $user->status = 'user';
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()) {
            // Assign role 'user' to the new user
            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            if ($userRole) {
                $auth->assign($userRole, $user->id);
            }
            return true;
        }
    }
}
