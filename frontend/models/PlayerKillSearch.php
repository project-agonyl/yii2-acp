<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 10-12-2016
 * Time: 13:35
 */

namespace frontend\models;

use Yii;
use common\models\Playerpkinfo;
use yii\data\ActiveDataProvider;

class PlayerKillSearch extends Playerpkinfo
{
    public function search($params)
    {
        $query = Playerpkinfo::find()
            ->where('id IS NOT NULL')
            ->limit(15)
            ->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => false,
            'sort' => false
        ]);
        $this->load($params, '');
        return $dataProvider;
    }
}
