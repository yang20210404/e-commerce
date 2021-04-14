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
    public $old_password;
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['old_password', 'string'],
            ['password', 'required', 'message' => '新密碼不能為空'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['password_repeat', 'required', 'message' => '新密碼確認不能為空'],
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
            'old_password' => '目前密碼',
            'password' => '新密碼',
            'password_repeat' => '新密碼確認',
        ];
    }

    public function validatePassword()
    {
        return Yii::$app->security->validatePassword(
            $this->old_password ? $this->old_password : '密碼為空',
            Yii::$app->user->identity->password
        );
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
