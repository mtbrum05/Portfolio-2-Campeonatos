<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EquipeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EquipeTable Test Case
 */
class EquipeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EquipeTable
     */
    public $Equipe;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Equipe',
        'app.Profissional',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Equipe') ? [] : ['className' => EquipeTable::class];
        $this->Equipe = TableRegistry::getTableLocator()->get('Equipe', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Equipe);

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
