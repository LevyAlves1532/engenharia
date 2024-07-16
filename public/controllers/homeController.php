<?php
class homeController extends controller
{
	public function index()
	{
		// $projects = new Projects();
		$feedbacks = new Feedbacks();

		$all_feedbacks = $feedbacks->getTwo();
		// $all_projects = $projects->getThree();

		$this->loadTemplate('home', [
			'banner' => [
				'image' => BASE . 'assets/images/banner_home.webp',
				'subtitle' => 'Soluções de Engenharia Inovadoras e Sustentáveis',
				'title' => 'Construindo o Futuro com Excelência',
				'text' => 'Transformamos ideias em realidade com precisão e dedicação. Com uma abordagem sustentável e inovadora, oferecemos serviços de engenharia que atendem às necessidades do presente sem comprometer as gerações futuras. Seja para projetos residenciais, comerciais ou industriais, estamos comprometidos em entregar resultados de alta qualidade que superam as expectativas.',
				'button_primary' => [
					'link' => BASE . 'contato',
					'label' => 'Entre em Contato',
				],
				'button_secondary' => [
					'link' => BASE . 'portfolio',
					'label' => 'Veja nosso Portfolio',
				],
			],
			// 'projects' => $all_projects,
			'feedbacks' => $all_feedbacks,
		]);
	}
}
