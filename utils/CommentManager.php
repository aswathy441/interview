<?php

class CommentManager
{
	private static $instance = null;

	private function __construct()
	{
		require_once(ROOT . '/utils/DB.php');
		require_once(ROOT . '/class/Comment.php');
		require_once(ROOT . '/helpers/Helpers.php');
	}

	public static function getInstance()
	{
		if (null === self::$instance) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}

	public function listComments()
	{
		$result=Helpers ::read('comment');
		$comments = [];
		foreach($result as $row) {
			$n = new Comment();
			$comments[] = $n->setId($row['id'])
			  ->setBody($row['body'])
			  ->setCreatedAt($row['created_at'])
			  ->setNewsId($row['news_id']);
		}

		return $comments;
	}

	public function addCommentForNews($body, $newsId)
	{
		//$db = DB::getInstance();
		$sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES('". $body . "','" . date('Y-m-d') . "','" . $newsId . "')";
		$result=Helpers ::add('$sql');
		//$db->exec($sql);
		return $result;
	}

	public function deleteComment($id)
	{
		//$db = DB::getInstance();
		$table='comment';
		$cmd= Helpers::delete($table,$id);
		//$sql = "DELETE FROM `comment` WHERE `id`=" . $id;
		//return $db->exec($sql);
	}
}