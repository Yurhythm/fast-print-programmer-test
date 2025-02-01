<?php

class Migration extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }

    public function latest() {
        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migration successful!";
        }
    }

    public function version($version) {
        if ($this->migration->version($version) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrated to version $version!";
        }
    }
}

?>
