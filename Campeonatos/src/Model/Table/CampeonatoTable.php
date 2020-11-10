<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Campeonato Model
 *
 * @method \App\Model\Entity\Campeonato get($primaryKey, $options = [])
 * @method \App\Model\Entity\Campeonato newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Campeonato[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Campeonato|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Campeonato saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Campeonato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Campeonato[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Campeonato findOrCreate($search, callable $callback = null, $options = [])
 */
class CampeonatoTable extends Table
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

        $this->setTable('campeonato');
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
            ->scalar('nome')
            ->maxLength('nome', 100)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->integer('id_tipo_campeonato')
            ->requirePresence('id_tipo_campeonato', 'create')
            ->notEmptyString('id_tipo_campeonato');

        $validator
            ->dateTime('data_criacao')
            ->requirePresence('data_criacao', 'create')
            ->notEmptyDateTime('data_criacao');

        $validator
            ->dateTime('data_inicio')
            ->requirePresence('data_inicio', 'create')
            ->notEmptyDateTime('data_inicio');

        $validator
            ->dateTime('data_fim')
            ->requirePresence('data_fim', 'create')
            ->notEmptyDateTime('data_fim');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        return $validator;
    }
}
