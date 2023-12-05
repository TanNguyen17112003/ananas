<?php
	class DbConnect {
		private $server = 'localhost:3306';
		private $dbname = 'ltwdb';
		private $user = 'root';
		private $pass = '';

		public function connect() {
			try {
                $conn = new mysqli($this->server, $this->user, $this->pass, $this->dbname);
				return $conn;
			} catch (\Exception $e) {
				echo "Database Error: " . $e->getMessage();
			}
		}
        
	}
?>