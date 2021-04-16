<?php
/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 7:04 PM
 */

namespace frontend\base;


use common\models\CartItem;
use common\models\User;

/**
 * Class Controller
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package frontend\base
 */
class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        $this->view->params['cartItemCount'] = CartItem::getTotalQuantity(\Yii::$app->user->id);
        $this->view->params['balance'] = User::getBalance(\Yii::$app->user->id);

        return parent::beforeAction($action);
    }
}