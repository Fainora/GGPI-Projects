<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Projects;

/**
 * ProjectsSearch represents the model behind the search form of `common\models\Projects`.
 */
class ProjectsSearch extends Projects
{
    public $keywords;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'max_number', 'user_id'], 'integer'],
            [['title', 'description', 'image', 'keywords'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Projects::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'max_number' => $this->max_number,
            'user_id' => $this->user_id,
        ]);

        $query->orFilterWhere(['like', 'title', $this->keywords])
            ->orFilterWhere(['like', 'description', $this->keywords]);

        $dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];

        return $dataProvider;
    }
}
