<?php  
	/**
	* 
	*/
	class pagination
	{
		private $host = "localhost";
		private $user = "root";
		private $pass = "akumakan2";
		private $db = "paging";
		private $dbh;
		function __construct()
		{
			try {
				$this->dbh = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);
				$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			} catch (PDOException $e) {
				echo "Koneksi Bermasalah " . $e->getMessage();
			}
		}

		function getTableData($table,$page=1,$limit=3)
		{
			$this->startRow = ($page-1)*$limit;
			$this->sql = "SELECT * FROM $table LIMIT $this->startRow,$limit";
			$this->q = $this->dbh->query($this->sql);
			while ($this->r = $this->q->fetch(PDO::FETCH_ASSOC)) {
				$this->data[] = $this->r;
			}
			return $this->data;
		}

		function showPagination($table,$limit=3)
		{
			$this->sql = "SELECT COUNT(*) AS total FROM $table";
			$this->q = $this->dbh->query($this->sql);
			$this->queryResult = $this->q->fetch(PDO::FETCH_ASSOC);
			$this->totalRow = $this->queryResult['total'];

			$this->totalPage = ceil($this->totalRow/$limit);
			$page = 1;
			$this->pageTotal = $page + 1;
			while ($page <= $this->totalPage) {
				echo "
					      <div class='ui pagination menu'>
					        <a href='?page=".$page."&perPage=".$limit."' class='item'>$page</a>
					      </div>
				";
						  /*<a href='?page=".$this->pageTotal."&perPage=".$limit."' class='icon item'>
				         	<i class='right chevron icon'></i>
			        	  </a>*/ 
				if ($page <= $this->totalPage) {

					$page++;
					$this->pageTotal  = $page + 1;
				}
			}
		}
	}
?>