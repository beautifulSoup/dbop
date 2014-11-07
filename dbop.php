<?php 
/* @author: Tang Likang
 * @copyright: You can use it free.
 * 
 */

include("db.config.php");
class mydb{
	private $dbname;
	private $dbuser;
	private $dbpassword;
	private $dbhost;
	private $dbh;
	private $charset;
	private $result;
	private $error;
	
	/* Init the object, the construct function;
	 * @param null
	 * @return null
	 */
	public function __construct(){
		$this->dbname = DB;
		$this->dbuser = USER;
		$this->dbpassword = PASSWORD;
		$this->dbhost= HOST;
		$this->charset= CHARSET;
		if($this->connect()){
			mysql_set_charset($this->charset, $this->dbh);
		}
	}
	/* Function: destruct the object;
	 * Description: the destruct function;
	 * You don't need to call it. It will be called when the script exit;
	 * 
	 */
	public function __destruct(){
		mysql_close($this->dbh);
	}
	
	private function connect(){
		$this->dbh = mysql_connect( $this->dbhost, $this->dbuser, $this->dbpassword);
		if(!$this->dbh){
			die("Error: Database connect error!".mysql_error());
		}
		else{
			return true;
		}
	}
	

	/* the old select function
	 * @param string the select sql
	 * @return if success, it return a result array. Else, it returns false, and you can call getError to get the error inf; 
	 */
	public function query($sql){
		if(!$this->dbh){
			return false;
		}
		mysql_select_db($this->dbname, $this->dbh);
		$query= mysql_query($sql, $this->dbh);
		if(!$query){
			$this->error = mysql_error();
			return false;
		}
		$return_array= array();
		while(($new = mysql_fetch_array($query))!=false){
			$return_array[]=$new;
		}
		$this->result = $return_array;
		return $return_array;
	}

	function select($sql){
		if(!$this->dbh){
			return false;
		}
		mysql_select_db($this->dbname, $this->dbh);
		$query= mysql_query($sql, $this->dbh);
		if(!$query){
			$this->error = mysql_error();
			return false;
		}
		$return_array= array();
		while(($new = mysql_fetch_array($query))!=false){
			$return_array[]=$new;
		}
		$this->result = $return_array;
		return $return_array;
	}
	
	/* @param string the sql string
	 * @return the result: if success, return true; if fail, return false; You can call getError to get the error inf;
	 */
	function insert($sql){
		if(!$this->dbh){
			return false;
		}
		mysql_select_db($this->dbname, $this->dbh);
		$query= mysql_query($sql, $this->dbh);
		if(!$query){
			$this->error = mysql_error();
		}
		return $query;
	}
	
	/* @param string the sql string
	 * @return the result: if success, return true; if fail, return false; You can call getError to get the error inf;
	*/
	function update($sql){
		if(!$this->dbh){
			return false;
		}
		mysql_select_db($this->dbname, $this->dbh);
		$query= mysql_query($sql, $this->dbh);
		if(!$query){
			$this->error = mysql_error();
		}
		return $query;
	}
	
	/* @param string the sql string
	 * @return the result: if success, return true; if fail, return false; You can call getError to get the error inf;
	*/
	function delete($sql){
		if(!$this->dbh){
			return false;
		}
		mysql_select_db($this->dbname, $this->dbh);
		$query= mysql_query($sql, $this->dbh);
		if(!$query){
			$this->error = mysql_error();
		}
		return $query;
	}
	

	
	/* @return the error last time operate the database
	 *
	*/
	public function getError(){
		return $this->error;
	}
	
	/* @return the result set last time;
	 * 
	 */
	public function getResult(){
		return $this->result;
	}
	
	
}

?>