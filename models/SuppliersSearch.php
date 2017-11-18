<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Suppliers;

/**
 * SuppliersSearch represents the model behind the search form about `app\models\Suppliers`.
 */
class SuppliersSearch extends Suppliers{
    
    public function rules(){
        return [
            [['person_id', 'deleted'], 'integer'],
            [['company_name', 'account_number'], 'safe'],
        ];
    }

    public function scenarios(){
        return Model::scenarios();
    }

    public function search($params){
        $query = Suppliers::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'person_id' => $this->person_id,
            'deleted' => $this->deleted,
        ]);
        $query->andFilterWhere(['like', 'company_name', $this->company_name])
              ->andFilterWhere(['like', 'account_number', $this->account_number]);
        return $dataProvider;
    }
    
}
