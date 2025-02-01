<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Change_produk_column_type extends CI_Migration {

    public function up() {
        $fields = [
			'kategori_id' => [
				'type' => 'INT',
                'constraint' => 100,
				'null' => TRUE
            ],
			'status_id' => [
				'type' => 'INT',
                'constraint' => 100,
				'null' => TRUE
            ]
        ];
        
        $this->dbforge->modify_column('produk', $fields);
    }

    public function down() {
        $fields = [
			'kategori_id' => [
				'type' => 'INT',
                'constraint' => 100,
				'null' => FALSE
            ],
			'status_id' => [
				'type' => 'INT',
                'constraint' => 100,
				'null' => FALSE
            ]
        ];

        $this->dbforge->modify_column('produk', $fields);
    }
}
