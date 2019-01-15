<?php


use Phinx\Migration\AbstractMigration;

class CreateTableNoticias extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $table = $this->table('noticias');
        $table->addColumn('titulo', 'string', ['limit'=>100])
              ->addColumn('iduser', 'integer', ['null' => true])
              ->addColumn('contenido','text')
              ->addColumn('created_at','date')
              ->addColumn('update_at','date')
              ->addColumn('soft_delete','boolean')
              ->addColumn('vista','integer')
              ->addForeignKey('iduser', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
              ->create();

    }

    
}
