<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 21-11-2016
 * Time: 00:28
 */

namespace backend\modules\log\models;

use Yii;
use common\models\ActivityLog;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class ActivityLogSearch extends ActivityLog
{
    public $pageSize  = 10;
    public $isAdmin = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event', 'description', 'data']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['event', 'description', 'data']
        ];
    }

    public function search($params)
    {
        $query = ActivityLog::find()
            ->where([
                'is_visible' => true
            ]);
        if ($this->isAdmin) {
            $query->andWhere(['account' => ArrayHelper::getValue(Yii::$app->params, 'admins', 'a3')]);
        } else {
            $query->andWhere(['NOT', ['account' => ArrayHelper::getValue(Yii::$app->params, 'admins', 'a3')]]);
        }
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
            'account',
            'event' => [
                'attribute' => 'event',
                'label' => 'Event',
                'value' => function ($model) {
                    return ArrayHelper::getValue(ActivityLog::getEventList(), $model->event, ActivityLog::EVENT_UNKNOWN);
                }
            ],
            'description',
            'data',
            'created' => [
                'attribute' => 'created_at',
                'label' => 'Event Time',
                'format' => 'datetime'
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
                    'default' => SORT_DESC,
                    'label' => 'ID',
                ],
                'account' => [
                    'asc' => [new Expression('account ASC')],
                    'desc' => [new Expression('account DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Account',
                ],
                'event' => [
                    'asc' => [new Expression('event ASC')],
                    'desc' => [new Expression('event DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Event',
                ],
                'created_at' => [
                    'asc' => [new Expression('created_at ASC')],
                    'desc' => [new Expression('created_at DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Created',
                ]
            ],
            'defaultOrder' => [
                'created_at' => SORT_DESC,
                'id' => SORT_DESC
            ]
        ];
    }
}
