<?php
class FamilyModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getFamilies()
	{
		$sql = "SELECT * FROM family ORDER BY family_id";
		return $this->connection->Query($sql);
	}
}