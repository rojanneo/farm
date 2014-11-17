<?php

class FamilytobeModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function addNewCombination($buck, $doe)
	{
		$sql = "INSERT INTO `family_to_be`(`family_to_be_doe`, `family_to_be_buck`) VALUES ($doe,$buck)";
		return $this->connection->InsertQuery($sql);
	}
}