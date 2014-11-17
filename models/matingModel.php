<?php

class MatingModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function addNewMatingEntry($doe, $buck)
	{
		$sql = "INSERT INTO `matings`(`mating_doe_id`, `mating_buck_id`) VALUES ($doe,$buck)";
		return $this->connection->InsertQuery($sql);
	}

	public function clearMatingTable()
	{
		$sql = "DELETE FROM matings";
		return $this->connection->DeleteQuery($sql);
	}

	public function getAllMatings()
	{
		$sql = "SELECT * FROM matings order by mating_buck_id";
		return $this->connection->Query($sql);
	}
}