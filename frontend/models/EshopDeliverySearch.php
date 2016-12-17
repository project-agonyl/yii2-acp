<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 20-11-2016
 * Time: 13:32
 */

namespace frontend\models;

use common\models\Charac0;
use common\models\EshopOrder;
use kartik\icons\Icon;
use Yii;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\Url;

class EshopDeliverySearch extends Charac0
{
    public $pageSize = 10;
    public $account;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account', 'delivered_to', 'value']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['account', 'delivered_to', 'value']
        ];
    }

    public function search($params)
    {
        $query = EshopOrder::find()
            ->where([
                'account' => $this->account,
                'is_delivered' => true
            ])
            ->orderBy(['updated_at' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => $this->pageSize,
                'validatePage' => false
            ],
            'sort' => false
        ]);
        $this->load($params, '');
        return $dataProvider;
    }
}
