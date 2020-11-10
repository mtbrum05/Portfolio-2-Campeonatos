<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LogCampeonato Model
 *
 * @method \App\Model\Entity\LogCampeonato get($primaryKey, $options = [])
 * @method \App\Model\Entity\LogCampeonato newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LogCampeonato[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LogCampeonato|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LogCampeonato saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LogCampeonato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LogCampeonato[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LogCampeonato findOrCreate($search, callable $callback = null, $options = [])
 */
class LogCampeonatoTable extends Table
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

        $this->setTable('log_campeonato');
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
            ->integer('id_campeonato')
            ->requirePresence('id_campeonato', 'create')
            ->notEmptyString('id_campeonato');

        $validator
            ->dateTime('data_criacao')
            ->requirePresence('data_criacao', 'create')
            ->notEmptyDateTime('data_criacao');

        $validator
            ->boolean('ativo')
            ->requirePresence('ativo', 'create')
            ->notEmptyString('ativo');

        $validator
            ->dateTime('data_inativacao')
            ->allowEmptyDateTime('data_inativacao');

        $validator
            ->scalar('observacao')
            ->maxLength('observacao', 200)
            ->allowEmptyString('observacao');

        $validator
            ->integer('id_equipe_profissional')
            ->requirePresence('id_equipe_profissional', 'create')
            ->notEmptyString('id_equipe_profissional');

        return $validator;
    }
}
