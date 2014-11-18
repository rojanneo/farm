<?php
class HomeController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		loadHelper('url');
	}

	public function indexAction()
	{
		$this->view->render('home/home.phtml');
	}

	public function initializeAction()
	{
		$does = 105;
		$bucks = 35;
		for($i = 0; $i<$does;$i++)
			getModel('rabbits')->addNewRabbit('Doe');
		for($i = 0; $i<$bucks;$i++)
			getModel('rabbits')->addNewRabbit('Buck');
		redirect('home');
	}

	public function addDoeAction()
	{
		getModel('rabbits')->addNewRabbit('Doe');
		redirect('home');
	}

	public function addBuckAction()
	{
		getModel('rabbits')->addNewRabbit('Buck');
		redirect('home');
	}
	public function listAction()
	{
		$families = getModel('family')->getFamilies();
		$data['families'] = $families;
		$this->view->render('family/list.phtml',$data);
	}

	public function familytobeAction()
	{
		$families = getModel('family')->getFamilies();
		foreach($families as $family)
		{
			$f_id = $family['family_id'];
			$buck = getModel('rabbits')->getBucksByFamilyId($f_id);
			$does = getModel('rabbits')->getDoesByFamilyId($f_id);
			if($buck and $does)
			{
				foreach($does as $rabbit)
				{
					echo $buck[0]['rabbit_code'].', '.$rabbit['rabbit_code'].'<br>';
					getModel('familytobe')->addNewCombination($buck[0]['rabbit_id'], $rabbit['rabbit_id']);

				}
				echo '<hr>';
			}
		}
	}

	public function matingsAction()
	{
		getModel('mating')->clearMatingTable();
		$families = getModel('family')->getFamilies();
		foreach($families as $family)
		{
			$f_id = $family['family_id'];
			$buck = getModel('rabbits')->getBucksByFamilyId($f_id);
			$does = getModel('rabbits')->getDoesByFamilyId($f_id);
			if($buck and $does)
			{
				foreach($does as $rabbit)
				{
					echo $buck[0]['rabbit_code'].', '.$rabbit['rabbit_code'].'<br>';
					getModel('mating')->addNewMatingEntry($rabbit['rabbit_id'],$buck[0]['rabbit_id']);

				}
				echo '<hr>';
			}
		}

	}

	public function matingListAction()
	{
		$data['matings'] = getModel('mating')->getAllMatings();
		$this->view->render('matings/list.phtml',$data);
	}

	public function addLittersAction($mating_id)
	{
		getModel('litter')->addNewLitter($mating_id);
		loadHelper('url');
		redirect('home/matinglist');
	}

	public function litterListAction()
	{
		$data['litters'] = getModel('litter')->getAllLitters();
		$this->view->render('litters/list.phtml',$data);
	}

	public function addToFamilyAction($litter_id)
	{
		$does = getModel('rabbits')->getAllDoes();
		echo '<pre>';
		var_dump($does);
	}

}