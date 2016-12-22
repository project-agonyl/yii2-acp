<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 23-11-2016
 * Time: 23:05
 */

namespace backend\modules\notification\models;

use Yii;
use common\models\NotificationLog;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class NotificationLogSearch extends NotificationLog
{
    public $pageSize = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subject', 'to_address', 'type'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['id', 'subject', 'to_address', 'type']
        ];
    }

    public function search($params)
    {
        $query = NotificationLog::find()
            ->where('id IS NOT NULL');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id',
            'pagination' => [
                'pageSize' => $this->pageSize,
                'validatePage' => false
            ],
            'sort' => $this->sortObject()
        ]);
        $this->load($params);
        $query->andFilterWhere(['and',
            ['LIKE', 'lower(id)', strtolower($this->id)],
            ['LIKE', 'lower(subject)', strtolower($this->subject)],
            ['LIKE', 'lower(to_address)', strtolower($this->to_address)],
            ['LIKE', 'lower(type)', strtolower($this->type)]
        ]);
        return $dataProvider;
    }

    public function getColumnMap()
    {
        return [
            'id',
            'type' => [
                'attribute' => 'type',
                'label' => 'Type',
                'value' => function ($model) {
                    return ArrayHelper::getValue(NotificationLog::getTypeList(), $model->type);
                }
            ],
            'to_address',
            'subject',
            'created_at' => [
                'attribute' => 'created_at',
                'label' => 'Mailed At'
            ],
            'actions' => [
                'header' => 'Actions',
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{view}'
            ]
        ];
    }

    protected function sortObject()
    {
        return [
            'attributes' => [
                'type' => [
                    'asc' => [new Expression('CAST(type AS int) ASC')],
                    'desc' => [new Expression('CAST(type AS int) DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Type',
                ],
                'id' => [
                    'asc' => [new Expression('id ASC')],
                    'desc' => [new Expression('id DESC')],
                    'default' => SORT_DESC,
                    'label' => 'ID',
                ],
                'created_at' => [
                    'asc' => [new Expression('created_at ASC')],
                    'desc' => [new Expression('created_at DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Mailed At',
                ]
            ],
            'defaultOrder' => [
                'created_at' => SORT_DESC
            ]
        ];
    }
}
