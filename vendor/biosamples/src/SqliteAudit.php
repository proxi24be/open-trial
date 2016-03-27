<?php

/**
 * User: bluenight
 * Date: 2/6/16
 * Time: 4:25 PM
 */

namespace Biosamples;

class SqliteAudit extends AuditTableTrigger
{
    /**
     * @param $table_name
     */
    public function addAuditTrigger($table_name)
    {
        $sql = <<<sql

create trigger if not EXISTS  {$table_name}_ins_trg after insert on $table_name
for each row
BEGIN
  insert into audit_table (jn_user, jn_operation, jn_table, jn_pk, jn_data, jn_json_schema_id, created_at)
  values ('sys', 'INS', '$table_name', NEW.id, NEW.data, NEW.json_schema_id, datetime(strftime('%s','now'), 'unixepoch'));
end;

create trigger if not EXISTS  {$table_name}_upd_trg after update on $table_name
for each row
BEGIN
insert into audit_table (jn_user, jn_operation, jn_table, jn_pk, jn_data, jn_json_schema_id, created_at)
values ('sys', 'UPD', '$table_name', NEW.id, NEW.data, NEW.json_schema_id, datetime(strftime('%s','now'), 'unixepoch'));
end;

create trigger if not EXISTS  {$table_name}_del_trg after delete on $table_name
for each row
BEGIN
insert into audit_table (jn_user, jn_operation, jn_table, jn_pk, jn_data, jn_json_schema_id, created_at)
values ('sys', 'DEL', '$table_name', old.id, old.data, old.json_schema_id, datetime(strftime('%s','now'), 'unixepoch'));
end;
sql;
        $this->_execute($sql);
    }

    /**
     * @param $table_name
     */
    public function deleteAuditTrigger($table_name)
    {
        $sql = <<<sql
drop trigger if EXISTS  {$table_name}_ins_trg ;
drop trigger if EXISTS  {$table_name}_upd_trg ;
drop trigger if EXISTS  {$table_name}_del_trg ;
sql;
        $this->_execute($sql);
    }

    /**
     * @param $sql
     * @return mixed
     */
    private function _execute($sql)
    {
        $stmt   = $this->getPdo()->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }
}