<?php
class homeController extends controller
{
	public function index()
	{
		$this->loadTemplate("home", [
			"banner" => [
				"image" => "https://img.freepik.com/fotos-gratis/piso-vazio-do-predio-moderno_1127-3154.jpg?t=st=1713802805~exp=1713806405~hmac=b2ec6a67bdff3d0251c76975e0c8f592754f26781b11ffe7e112aa154e85e1c5&w=1380",
				"subtitle" => "We build, we craft",
				"title" => "Building Dreams Through Construction",
				"text" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat quisquam, est rem ipsum adipisci voluptatibus mollitia vel, cum corporis et dolore reiciendis soluta molestiae id in quaerat. Temporibus, voluptas vitae?",
				"button_primary" => [
					"link" => "#",
					"label" => "Get Started",
				],
				"button_secondary" => [
					"link" => "#",
					"label" => "See Portfolio",
				],
			],
		]);
	}
}
