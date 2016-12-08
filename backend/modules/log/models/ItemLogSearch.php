<?php
/**
 * Created by PhpStorm.
 * User: talview1
 * Date: 8/12/16
 * Time: 9:28 AM
 */

namespace backend\modules\log\models;

use Yii;
use common\models\Itemlog;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class ItemLogSearch extends Itemlog
{
    public $pageSize  = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['charname', 'tocharname', 'itemname', 'uniqcode', 'event', 'date']
                , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'search' => ['charname', 'tocharname', 'itemname', 'uniqcode', 'event', 'date']
        ];
    }

    public function search($params)
    {
        $query = Itemlog::find()
            ->where('charname IS NOT NULL');
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
            'charname',
            'ip',
            'tocharname',
            'toip',
            'itemname',
            'uniqcode',
            'event',
            'date' => [
                'label' => 'Event Time',
                'attribute' => 'date',
                'format' => 'datetime'
            ],
        ];
    }

    protected function sortObject()
    {
        return [
            'attributes' => [
                'date' => [
                    'asc' => [new Expression('date ASC')],
                    'desc' => [new Expression('date DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Created',
                ]
            ],
            'defaultOrder' => [
                'date' => SORT_DESC
            ]
        ];
    }
}
