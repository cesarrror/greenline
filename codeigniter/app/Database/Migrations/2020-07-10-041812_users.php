<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
			'first_name' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'last_name' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '200'
			],
			'nickname' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'passsword' => [
				'type' => 'VARCHAR',
				'constraint' => '240'
			],
			'avatar' => [
				'type' => 'VARCHAR',
				'constraint' => '240'
			],
			'role_id' => [
				'type' => 'INT'
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
