<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
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
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '200'
			],
			'description' => [
				'type' => 'TEXT'
			],
			'image' => [
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => true
			],
			'created_by' => [
				'type' => 'INT'
			]			
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('services');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('services');
	}
}
