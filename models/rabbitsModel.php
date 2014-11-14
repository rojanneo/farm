<?php 
class RabbitsModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function addNewRabbit($type)
	{
		$date = date('Y-m-d');
		$ratio = ceil(79/35);
		if($type == 'Doe')
		{
			$sql = "SELECT family_id FROM `family` Where family_doe_count < 3 LIMIT 1";
			$result = $this->connection->Query($sql);
			if($result) {
				$count_sql = "SELECT COUNT(*) from rabbits";
				$count = $this->connection->Query($count_sql)[0]['COUNT(*)'];
				$family = $result[0]['family_id'];
				$sql = "INSERT INTO `rabbits`(`rabbit_type`, `rabbit_litter_id`, `rabbit_family`, `rabbit_code`) VALUES ('$type',0,$family,'rabbit_".++$count."')";
				$this->connection->InsertQuery($sql);
				$doe_count = "SELECT family_doe_count FROM family WHERE family_id = $family";
				$doe_count = $this->connection->Query($doe_count)[0]['family_doe_count'];
				$update_sql = "UPDATE family SET family_doe_count = ".++$doe_count." WHERE family_id = $family";
				$this->connection->UpdateQuery($update_sql) or die(mysql_error());
				//echo mysql_error();
			}
			else
			{
				$family_count = "SELECT COUNT(*) from family";
				$family_count = $this->connection->Query($family_count)[0]['COUNT(*)'];
				$create_family = "INSERT INTO `family`(`family_code`, `family_created_date`) VALUES ('family_".++$family_count."','".$date."')";
				$this->connection->InsertQuery($create_family);
				$family = $this->connection->GetInsertID();
				$count_sql = "SELECT COUNT(*) from rabbits";
				$count = $this->connection->Query($count_sql)[0]['COUNT(*)'];
				$sql = "INSERT INTO `rabbits`(`rabbit_type`, `rabbit_litter_id`, `rabbit_family`, `rabbit_code`) VALUES ('$type',0,$family,'rabbit_".++$count."')";
				$this->connection->InsertQuery($sql);
				$doe_count = "SELECT family_doe_count FROM family WHERE family_id = $family";
				$doe_count = $this->connection->Query($doe_count)[0]['family_doe_count'];
				$update_sql = "UPDATE family SET family_doe_count = ".++$doe_count." WHERE family_id = $family";
				$this->connection->UpdateQuery($update_sql) or die(mysql_error());
				//echo mysql_error();
			}
		}
		else if($type == 'Buck')
		{
			$sql = "SELECT family_id FROM `family` Where family_buck_count < 1 LIMIT 1";
			$family = $this->connection->Query($sql);
			if($family)
			{ 
				$family = $family[0]['family_id'];
				$count_sql = "SELECT COUNT(*) from rabbits";
				$count = $this->connection->Query($count_sql)[0]['COUNT(*)'];
				$sql = "INSERT INTO `rabbits`(`rabbit_type`, `rabbit_litter_id`, `rabbit_family`, `rabbit_code`) VALUES ('$type',0,$family,'rabbit_".++$count."')";
				$this->connection->InsertQuery($sql);
				$buck_count = "SELECT family_buck_count FROM family WHERE family_id = $family";
				$buck_count = $this->connection->Query($buck_count)[0]['family_buck_count'];
				$update_sql = "UPDATE family SET family_buck_count = ".++$buck_count." WHERE family_id = $family";
				$this->connection->UpdateQuery($update_sql) or die(mysql_error());
			}
			else
			{
				$family_count = "SELECT COUNT(*) from family";
				$family_count = $this->connection->Query($family_count)[0]['COUNT(*)'];
				$create_family = "INSERT INTO `family`(`family_code`, `family_created_date`) VALUES ('family_".++$family_count."','".$date."')";
				$this->connection->InsertQuery($create_family);
				$family = $this->connection->GetInsertID();
				$count_sql = "SELECT COUNT(*) from rabbits";
				$count = $this->connection->Query($count_sql)[0]['COUNT(*)'];
				$sql = "INSERT INTO `rabbits`(`rabbit_type`, `rabbit_litter_id`, `rabbit_family`, `rabbit_code`) VALUES ('$type',0,$family,'rabbit_".++$count."')";
				$this->connection->InsertQuery($sql);
				$buck_count = "SELECT family_buck_count FROM family WHERE family_id = $family";
				$buck_count = $this->connection->Query($buck_count)[0]['family_buck_count'];
				$update_sql = "UPDATE family SET family_buck_count = ".++$buck_count." WHERE family_id = $family";
				$this->connection->UpdateQuery($update_sql) or die(mysql_error());
			}

		}
		
	}

	public function addInitialDoes()
	{
		$does = 79;
		$dummy_does =$does;
		$bucks = 35;
		$family_count = 0;
		$date = date('Y-m-d');
		$rabbit_count = 0;
		$current_family_id = 0;
		for($i = 0; $i<$does; $i++)
		{
			if($i%3 == 0)
			{
				$sql = "INSERT INTO `family`(`family_code`, `family_created_date`) VALUES ('family_".$family_count++."','".$date."')";
				echo $sql.'<br>';
				$this->connection->InsertQuery($sql);
				$current_family_id++;
				$dummy_does -= 3;
			echo '<hr>';
			}
			$sql = "INSERT INTO `rabbits`(`rabbit_type`, `rabbit_litter_id`, `rabbit_family`, `rabbit_code`) VALUES ('Doe',0,$current_family_id,'rabbit_".$rabbit_count++."')";
			$this->connection->InsertQuery($sql);
			echo $sql.'<br>';
		}
		echo '<hr>';
		// if($dummy_does < 0)
		// {
		// 		$sql = "INSERT INTO `family`(`family_code`, `family_created_date`) VALUES ('family_".$family_count++."','".$date."')";
		// 		echo $sql;
		// 		$dummy_does++;
		// }
	}

	public function addInitialBucks()
	{
		//$bucks = 
	}
}