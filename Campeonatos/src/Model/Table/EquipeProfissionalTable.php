<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EquipeProfissional Model
 *
 * @method \App\Model\Entity\EquipeProfissional get($primaryKey, $options = [])
 * @method \App\Model\Entity\EquipeProfissional newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EquipeProfissional[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EquipeProfissional|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EquipeProfissional saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EquipeProfissional patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EquipeProfissional[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EquipeProfissional findOrCreate($search, callable $callback = null, $options = [])
 */
class EquipeProfissionalTable extends Table
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

        $this->setTable('equipe_profissional');
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
            ->integer('id_equipe')
            ->requirePresence('id_equipe', 'create')
            ->notEmptyString('id_equipe');

        $validator
            ->integer('id_profissional')
            ->requirePresence('id_profissional', 'create')
            ->notEmptyString('id_profissional');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 200)
            ->allowEmptyString('descricao');

        $validator
            ->dateTime('data_criacao')
            ->requirePresence('data_criacao', 'create')
            ->notEmptyDateTime('data_criacao');

        $validator
            ->dateTime('data_inicio')
            ->allowEmptyDateTime('data_inicio');

        $validator
            ->dateTime('data_fim')
            ->allowEmptyDateTime('data_fim');

        $validator
            ->boolean('ativo')
            ->requirePresence('ativo', 'create')
            ->notEmptyString('ativo');

        return $validator;
    }

    public function requestAdd($data){
        $retorno = null;

        $retorno['data_criacao'] = date('Y-m-d H:i:s');
        isset($data['data_inicio']) ? $retorno['data_inicio'] = $data['data_inicio'] : null;
        isset($data['id_equipe']) ? $retorno['id_equipe'] = $data['id_equipe'] : null;
        isset($data['id_profissional']) ? $retorno['id_profissional'] = $data['id_profissional'] : null;
        isset($data['descricao']) ? $retorno['descricao'] = $data['descricao'] : null;
        isset($data['ativo']) ? $retorno['ativo'] = $data['ativo'] : null;



        return $retorno;
    }

    public function requestEdit($data, $equipeProfissional){
        $retorno = null;

        if(isset($data['descricao']) && !is_null($data['descricao'])){
            $retorno['descricao'] = $data['descricao'];
        }else{
            $retorno['descricao'] = $equipeProfissional->descricao;
        }

        if(isset($data['data_inicio']) && !is_null($data['data_inicio'])){
            $retorno['data_inicio'] = $data['data_inicio'];
        }else{
            $retorno['data_inicio'] = $equipeProfissional->data_inicio;
        }

        if(isset($data['data_fim']) && !is_null($data['data_fim'])){
            $retorno['data_fim'] = $data['data_fim'];
        }else{
            $retorno['data_fim'] = $equipeProfissional->data_fim;
        }

        if(isset($data['id_profissional']) && !is_null($data['id_profissional'])){
            $retorno['id_profissional'] = $data['id_profissional'];
        }else{
            $retorno['id_profissional'] = $equipeProfissional->id_profissional;
        }

        if(isset($data['id_equipe']) && !is_null($data['id_equipe'])){
            $retorno['id_equipe'] = $data['id_equipe'];
        }else{
            $retorno['id_equipe'] = $equipeProfissional->id_equipe;
        }

        if(isset($data['ativo']) && !is_null($data['ativo'])){
            $retorno['ativo'] = $data['ativo'];
        }else{
            $retorno['ativo'] = $equipeProfissional->ativo;
        }
        
        return $retorno;
    }
}
