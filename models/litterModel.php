<?php 
class LitterModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function addNewLitter($mating_id)
	{
		$sql = "SELECT * FROM matings WHERE mating_id = $mating_id";
		$mating = $this->connection->Query($sql);
		$buck = $mating[0]['mating_buck_id'];
		$sql = "SELECT rabbit_family FROM rabbits WHERE rabbit_id = $buck";
		$family_id = $this->connection->Query($sql)[0]['rabbit_family'];
		$count_sql = "SELECT COUNT(*) from litters";
		$litter_count = $this->connection->Query($count_sql)[0]['COUNT(*)'];
		$litter_count++;
		$date = date('Y-m-d');
		$sql = "INSERT INTO `litters`(`litter_code`, `litter_dob`, `litter_does`, `litter_bucks`, `litter_family`, `mating_id`) 
		VALUES ('litter_$litter_count','$date',0,0,$family_id,$mating_id)";
		$this->connection->Query($sql);
	}

	public function getAllLitters()
	{
		$sql = "SELECT * FROM litters";
		return $this->connection->Query($sql);
	}
}