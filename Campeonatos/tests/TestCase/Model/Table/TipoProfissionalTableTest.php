<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoProfissionalTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoProfissionalTable Test Case
 */
class TipoProfissionalTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoProfissionalTable
     */
    public $TipoProfissional;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TipoProfissional',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TipoProfissional') ? [] : ['className' => TipoProfissionalTable::class];
        $this->TipoProfissional = TableRegistry::getTableLocator()->get('TipoProfissional', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoProfissional);

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
