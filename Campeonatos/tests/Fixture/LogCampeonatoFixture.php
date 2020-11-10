<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LogCampeonatoFixture
 */
class LogCampeonatoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'log_campeonato';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_campeonato' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'data_criacao' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'ativo' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'data_inativacao' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'observacao' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'id_equipe_profissional' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'log_campeonato_fk_2' => ['type' => 'index', 'columns' => ['id_campeonato'], 'length' => []],
            'log_campeonato_fk' => ['type' => 'index', 'columns' => ['id_equipe_profissional'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'log_campeonato_fk' => ['type' => 'foreign', 'columns' => ['id_equipe_profissional'], 'references' => ['equipe_profissional', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'log_campeonato_fk_2' => ['type' => 'foreign', 'columns' => ['id_campeonato'], 'references' => ['campeonato', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'id_campeonato' => 1,
                'data_criacao' => '2020-11-09 22:19:12',
                'ativo' => 1,
                'data_inativacao' => '2020-11-09 22:19:12',
                'observacao' => 'Lorem ipsum dolor sit amet',
                'id_equipe_profissional' => 1,
            ],
        ];
        parent::init();
    }
}
