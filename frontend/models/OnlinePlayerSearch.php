<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 10-12-2016
 * Time: 12:48
 */

namespace frontend\models;

use Yii;
use common\models\Charloginlog;
use yii\data\ActiveDataProvider;

class OnlinePlayerSearch extends Charloginlog
{
    public function search($params)
    {
        $query = Charloginlog::find()
            ->where('c_id IS NOT NULL')
            ->orderBy(['datetime' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'c_id',
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
                'attribute' => 'class',
                'label' => 'Type',
                'value' => function ($model) {
                    return $model->typeString;
                }
            ],
            'town' => [
                'attribute' => 'Nation',
                'label' => 'Town',
                'value' => function ($model) {
                    return $model->nationString;
                }
            ],
            'level' => [
                'attribute' => 'lvl',
                'label' => 'Level'
            ],
            'rb' => [
                'attribute' => 'rb',
                'label' => 'Rebirth'
            ]
        ];
    }
}
