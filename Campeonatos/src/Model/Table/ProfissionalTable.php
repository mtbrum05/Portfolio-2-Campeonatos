<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Profissional Model
 *
 * @property \App\Model\Table\EquipeTable&\Cake\ORM\Association\BelongsToMany $Equipe
 *
 * @method \App\Model\Entity\Profissional get($primaryKey, $options = [])
 * @method \App\Model\Entity\Profissional newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Profissional[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Profissional|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Profissional saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Profissional patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Profissional[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Profissional findOrCreate($search, callable $callback = null, $options = [])
 */
class ProfissionalTable extends Table
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

        $this->setTable('profissional');
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
            ->dateTime('data_criacao')
            ->requirePresence('data_criacao', 'create')
            ->notEmptyDateTime('data_criacao');

        $validator
            ->integer('id_profissional')
            ->requirePresence('id_profissional', 'create')
            ->notEmptyString('id_profissional');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        return $validator;
    }

    public function requestAdd($data){
        $retorno = null;

        $retorno['data_criacao'] = date('Y-m-d H:i:s');
        isset($data['descricao']) ? $retorno['descricao'] = $data['descricao'] : null;
        isset($data['nome']) ? $retorno['nome'] = $data['nome'] : null;
        isset($data['id_profissional']) ? $retorno['id_profissional'] = $data['id_profissional'] : null;



        return $retorno;
    }

    public function requestEdit($data, $profissional){
        $retorno = null;

        $retorno['data_criacao'] = date('Y-m-d H:i:s');

        if(isset($data['descricao']) && !is_null($data['descricao'])){
            $retorno['descricao'] = $data['descricao'];
        }else{
            $retorno['descricao'] = $profissional->descricao;
        }

        if(isset($data['nome']) && !is_null($data['nome'])){
            $retorno['nome'] = $data['nome'];
        }else{
            $retorno['nome'] = $profissional->nome;
        }

        if(isset($data['id_profissional']) && !is_null($data['id_profissional'])){
            $retorno['id_profissional'] = $data['id_profissional'];
        }else{
            $retorno['id_profissional'] = $profissional->id_profissional;
        } 
        
        return $retorno;
    }
}
