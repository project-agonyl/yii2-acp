<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 10-12-2016
 * Time: 12:55
 */

namespace frontend\models;

use Yii;
use common\models\Charac0;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class TopCharacterSearch extends Charac0
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'c_sheadera', 'c_sheaderb', 'c_sheaderc', 'c_status', 'rb']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['c_id', 'c_sheadera', 'c_sheaderb', 'c_sheaderc', 'c_status', 'rb']
        ];
    }

    public function search($params)
    {
        $query = Charac0::find()
            ->where([
                'c_status' => Charac0::STATUS_ACTIVE
            ])
            ->andWhere(['not', [
                'c_sheadera' => ['Merlano', 'karthikp', 'a3gm1', 'a3gm2', 'a3gm3', 'a3gm4', 'a3gm5', 'a3gm6', 'a3gm7']
            ]])
            ->orderBy([
                'rb' => SORT_DESC,
                'CAST(c_sheaderc AS int)' => SORT_DESC,
                'd_udate' => SORT_DESC
            ])
            ->limit(50);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => false,
            'sort' => false
        ]);
        $this->load($params, '');
        return $dataProvider;
    }

    public function getColumnMap()
    {
        return [
            'serial' => [
                'class' => '\kartik\grid\SerialColumn'
            ],
            'name' => [
                'attribute' => 'c_id',
                'label' => 'Name'
            ],
            'type' => [
                'attribute' => 'c_sheaderb',
                'label' => 'Type',
                'value' => function ($model) {
                    return $model->typeString;
                }
            ],
            'level' => [
                'attribute' => 'c_sheaderc',
                'label' => 'Level'
            ],
            'rb' => [
                'attribute' => 'rb',
                'label' => 'Rebirth'
            ]
        ];
    }
}
