<?php

class Migration_Add_status extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id_status' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'nama_status' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ]
        ]);
        $this->dbforge->add_key('id_status', TRUE);
        $this->dbforge->create_table('status');
    }

    public function down() {
        $this->dbforge->drop_table('status');
    }
}

?>
