<?php
namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => '密碼不能為空'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['password_repeat', 'required', 'message' => '密碼確認不能為空'],
            ['password_repeat', 'string'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => '兩次輸入的密碼不相符'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'password' => '密碼',
            'password_repeat' => '密碼確認',
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = Yii::$app->user->identity;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save(false);
    }
}
