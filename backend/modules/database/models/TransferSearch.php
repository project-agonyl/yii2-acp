<?php
/**
 * Created by PhpStorm.
 * User: inferno
 * Date: 20-11-2016
 * Time: 13:32
 */

namespace backend\modules\database\models;

use common\models\Charac0;
use common\models\ConnectOldAccount;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class TransferSearch extends Charac0
{
    public $pageSize = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'current_account', 'old_account']
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
        $query = ConnectOldAccount::find()
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
        $this->load($params, '');
        return $dataProvider;
    }

    public function getColumnMap()
    {
        return [
            'id',
            'current_account',
            'old_account',
            'status' => [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statusString;
                }
            ],
            'updated' => [
                'attribute' => 'updated_at',
                'label' => 'Last Updated',
                'format' => 'datetime'
            ]
        ];
    }

    protected function sortObject()
    {
        return [
            'attributes' => [
                'id' => [
                    'asc' => [new Expression('CAST(id AS int) ASC')],
                    'desc' => [new Expression('CAST(id AS int) DESC')],
                    'default' => SORT_DESC,
                    'label' => 'ID',
                ],
                'status' => [
                    'asc' => [new Expression('CAST(status AS int) ASC')],
                    'desc' => [new Expression('CAST(status AS int) DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Status',
                ],
                'current_account' => [
                    'asc' => [new Expression('current_account ASC')],
                    'desc' => [new Expression('current_account DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Current Account',
                ],
                'old_account' => [
                    'asc' => [new Expression('old_account ASC')],
                    'desc' => [new Expression('old_account DESC')],
                    'default' => SORT_ASC,
                    'label' => 'Old Account',
                ],
                'updated_at' => [
                    'asc' => [new Expression('updated_at ASC')],
                    'desc' => [new Expression('updated_at DESC')],
                    'default' => SORT_DESC,
                    'label' => 'Created',
                ]
            ],
            'defaultOrder' => [
                'updated_at' => SORT_DESC
            ]
        ];
    }
}
