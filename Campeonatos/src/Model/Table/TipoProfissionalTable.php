<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoProfissional Model
 *
 * @method \App\Model\Entity\TipoProfissional get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoProfissional newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoProfissional[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoProfissional|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoProfissional saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoProfissional patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoProfissional[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoProfissional findOrCreate($search, callable $callback = null, $options = [])
 */
class TipoProfissionalTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tipo_profissional');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 100)
            ->requirePresence('descricao', 'create', 'A descrição do tipo de profissional não pode ser vazia.')
            ->notEmptyString('descricao', 'A descrição do tipo de profissional não pode ser vazia.');

        $validator
            ->dateTime('data_criacao')
            ->requirePresence('data_criacao', 'create')
            ->notEmptyDateTime('data_criacao');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['descricao'], 'descrição já existente.'));

        return $rules;
    }


    public function requestAdd($data){
        $retorno = null;

        $retorno['data_criacao'] = date('Y-m-d H:i:s');
        isset($data['descricao']) ? $retorno['descricao'] = $data['descricao'] : null;

        return $retorno;
    }

    public function requestEdit($data, $tipoProfissional){
        $retorno = null;

        $retorno['data_criacao'] = date('Y-m-d H:i:s');

        if(isset($data['descricao']) && !is_null($data['descricao'])){
            $retorno['descricao'] = $data['descricao'];
        }else{
            $retorno['descricao'] = $tipoProfissional->descricao;
        } 
        return $retorno;
    }
}
