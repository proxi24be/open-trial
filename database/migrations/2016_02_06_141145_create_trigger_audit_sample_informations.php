<?php

use Biosamples\SqliteAudit;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerAuditSampleInformations extends Migration
{
    /**
     * @var mixed
     */
    private $_sqlite_audit;

    public function __construct()
    {
        $this->_sqlite_audit = new SqliteAudit(Schema::getConnection()->getPdo());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->_sqlite_audit->deleteAuditTrigger("sample_informations");
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->_sqlite_audit->addAuditTrigger("sample_informations");
    }
}
