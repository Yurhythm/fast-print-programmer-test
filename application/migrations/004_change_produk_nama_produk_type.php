<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Change_produk_nama_produk_type extends CI_Migration {

    public function up() {
        $fields = [
            'nama_produk' => [
                'type' => 'TEXT',
            ],
        ];
        
        $this->dbforge->modify_column('produk', $fields);
    }

    public function down() {
        $fields = [
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
        ];

        $this->dbforge->modify_column('produk', $fields);
    }
}
