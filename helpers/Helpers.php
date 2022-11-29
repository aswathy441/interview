<?php

class Helpers
{
	private function __construct()
	{
	require_once(ROOT . '/utils/DB.php');	
	}

	public static function add($query)
	{
		$db = DB::getInstance();
		$db->exec($sql);
		return $db->lastInsertId($query);
	}

	public static function read($table)
	{
		$db = DB::getInstance();
		$rows=$db->select('SELECT * FROM '.' '.$table);
		return $rows;
	}
	public function deleteComment($id)
	{
		$db = DB::getInstance();
		$sql = "DELETE FROM '".$table."' WHERE `id`=" . $id;
		return $db->exec($sql);
	}
}