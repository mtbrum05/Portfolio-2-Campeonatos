<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfissionalTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfissionalTable Test Case
 */
class ProfissionalTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfissionalTable
     */
    public $Profissional;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Profissional',
        'app.Equipe',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Profissional') ? [] : ['className' => ProfissionalTable::class];
        $this->Profissional = TableRegistry::getTableLocator()->get('Profissional', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Profissional);

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
