<?php

class Migration_Add_kategori extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id_kategori' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'nama_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ]
        ]);
        $this->dbforge->add_key('id_kategori', TRUE);
        $this->dbforge->create_table('kategori');
    }

    public function down() {
        $this->dbforge->drop_table('kategori');
    }
}

?>
