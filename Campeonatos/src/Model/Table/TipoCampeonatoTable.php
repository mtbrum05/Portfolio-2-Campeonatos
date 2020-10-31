<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoCampeonato Model
 *
 * @method \App\Model\Entity\TipoCampeonato get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoCampeonato newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoCampeonato[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoCampeonato|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoCampeonato saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoCampeonato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoCampeonato[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoCampeonato findOrCreate($search, callable $callback = null, $options = [])
 */
class TipoCampeonatoTable extends Table
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

        $this->setTable('tipo_campeonato');
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
            ->requirePresence('descricao', 'create')
            ->notEmptyString('descricao');

        $validator
            ->dateTime('data_criacao')
            ->requirePresence('data_criacao', 'create')
            ->notEmptyDateTime('data_criacao');

        return $validator;
    }
}