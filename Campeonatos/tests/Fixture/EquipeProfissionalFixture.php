<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EquipeProfissionalFixture
 */
class EquipeProfissionalFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'equipe_profissional';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_equipe' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_profissional' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'descricao' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'data_criacao' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'data_inicio' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'data_fim' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ativo' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'equipe_profissional_fk' => ['type' => 'index', 'columns' => ['id_equipe'], 'length' => []],
            'equipe_profissional_fk_1' => ['type' => 'index', 'columns' => ['id_profissional'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'equipe_profissional_fk' => ['type' => 'foreign', 'columns' => ['id_equipe'], 'references' => ['equipe', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'equipe_profissional_fk_1' => ['type' => 'foreign', 'columns' => ['id_profissional'], 'references' => ['profissional', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'id_equipe' => 1,
                'id_profissional' => 1,
                'descricao' => 'Lorem ipsum dolor sit amet',
                'data_criacao' => '2020-11-09 22:18:09',
                'data_inicio' => '2020-11-09 22:18:09',
                'data_fim' => '2020-11-09 22:18:09',
                'ativo' => 1,
            ],
        ];
        parent::init();
    }
}
