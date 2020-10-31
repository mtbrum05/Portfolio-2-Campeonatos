<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoCampeonatoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoCampeonatoTable Test Case
 */
class TipoCampeonatoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoCampeonatoTable
     */
    public $TipoCampeonato;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TipoCampeonato',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TipoCampeonato') ? [] : ['className' => TipoCampeonatoTable::class];
        $this->TipoCampeonato = TableRegistry::getTableLocator()->get('TipoCampeonato', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoCampeonato);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
