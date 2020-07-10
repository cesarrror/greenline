<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'role' => [
				'type' => 'INT',
				'constraint' => 2,
			],
			'description' => [
				'type' => 'TEXT'
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('roles');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('roles');
	}
}
