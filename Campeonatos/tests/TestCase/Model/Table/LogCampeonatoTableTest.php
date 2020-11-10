<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogCampeonatoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogCampeonatoTable Test Case
 */
class LogCampeonatoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LogCampeonatoTable
     */
    public $LogCampeonato;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LogCampeonato',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LogCampeonato') ? [] : ['className' => LogCampeonatoTable::class];
        $this->LogCampeonato = TableRegistry::getTableLocator()->get('LogCampeonato', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LogCampeonato);

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
