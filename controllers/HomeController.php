<?php
class HomeController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function indexAction()
	{
		$does = 105;
		$bucks = 35;
		for($i = 0; $i<$does;$i++)
			getModel('rabbits')->addNewRabbit('Doe');
		for($i = 0; $i<$bucks;$i++)
			getModel('rabbits')->addNewRabbit('Buck');
	}

	public function testAction()
	{
		getModel('rabbits')->addNewRabbit('Doe');
	}

	public function test1Action()
	{
		getModel('rabbits')->addNewRabbit('Buck');
	}
	public function listAction()
	{
		$families = getModel('family')->getFamilies();
		$data['families'] = $families;
		$this->view->render('family/list.phtml',$data);
	}

	public function familytobeAction()
	{
		
	}

}