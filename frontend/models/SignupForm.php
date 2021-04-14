<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => '用戶名不能為空'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '該用戶名已被使用'],
            ['username', 'string', 'min' => 1, 'max' => 255],

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
            'username' => '用戶名',
            'password' => '密碼',
            'password_repeat' => '密碼確認',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->created_at = time();
        $user->updated_at = time();

        if ($user->save()){
            return true;
        }

        \Yii::error("註冊錯誤： ".VarDumper::dumpAsString($user->errors));
        return false;
    }
}
