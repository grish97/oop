<?php

namespace app\Controllers;

use Core\BaseController;

Class HomeController extends BaseController {
	
	public function index() {
		echo view("home.index");
	}


	public function test() {
		ini_set("max_execution_time", 3000);
		$url = "https://www.list.am/category/23";
		$client = new \Goutte\Client();
		$res = $client->request("GET", $url);

		$announcements = [];

		$items = $res->filter(".dl table .action");
		var_dump($res->getStatusCode());exit;
		$items->each(function($item) use (&$announcements) {    
			$imageTag = $item->filter("td:first-child a img");
			$image = $imageTag->count() ? $imageTag->attr("src") : null;
			$title = $item->filter("td:last-child .t a")->text();
			$priceTag = $item->filter("td:last-child .p");
			$price = $priceTag->count() ? $priceTag->text() : null;
			$linkTag = $item->filter("td:last-child .t a");
			$link = $priceTag->count() ? $priceTag->text() : null;
			$announcements[] = [
				"image" => $image,
				"title" => $title,
				"price" => $price,
				"link"  => $link
			];
		});

	}
}