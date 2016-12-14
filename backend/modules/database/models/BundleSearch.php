<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 26-11-2016
 * Time: 19:59
 */

namespace backend\modules\database\models;

use Yii;
use common\models\Bundle;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class BundleSearch extends Bundle
{
    public $pageSize = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['id', 'name']
        ];
    }

    public function search($params)
    {
        $query = Bundle::find()
            ->where(['is_deleted' => false]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => $this->pageSize,
                'validatePage' => false
            ],
            'sort' => $this->sortObject()
        ]);
        $this->load($params, '');
        return $dataProvider;
    }

    public function getColumnMap()
    {
        return [
            'id',
            'name',
            'itemCount',
            'actions' => [
                'header' => 'Actions',
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update} {view}'
            ]
        ];
    }

    protected function sortObject()
    {
        return [
            'attributes' => [
                'id' => [
                    'asc' => [new Expression('id ASC')],
                    'desc' => [new Expression('id DESC')],
                    'default' => SORT_ASC,
                    'label' => 'ID',
                ],
                'name' => [
                    'asc' => [new Expression('name ASC')],
                    'desc' => [new Expression('name DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Name',
                ]
            ],
            'defaultOrder' => [
                'id' => SORT_DESC
            ]
        ];
    }
}
