<?php

class Migration_Add_produk extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
			],
			'kategori_id' => [
                'type' => 'INT',
                'constraint' => 100
            ],
			'status_id' => [
                'type' => 'INT',
                'constraint' => 100
            ]
        ]);
        $this->dbforge->add_key('id_produk', TRUE);
        $this->dbforge->create_table('produk');
    }

    public function down() {
        $this->dbforge->drop_table('produk');
    }
}

?>
