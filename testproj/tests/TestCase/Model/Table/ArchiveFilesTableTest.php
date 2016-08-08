<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArchiveFilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArchiveFilesTable Test Case
 */
class ArchiveFilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArchiveFilesTable
     */
    public $ArchiveFiles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.archive_files',
        'app.users',
        'app.files',
        'app.submissions',
        'app.assignments',
        'app.sections',
        'app.courses',
        'app.semesters',
        'app.students',
        'app.teams'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ArchiveFiles') ? [] : ['className' => 'App\Model\Table\ArchiveFilesTable'];
        $this->ArchiveFiles = TableRegistry::get('ArchiveFiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArchiveFiles);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
