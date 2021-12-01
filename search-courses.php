<?php

require 'vendor/autoload.php';

use Alura\SearchCourses\Search;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$search = new Search($client, $crawler);
$courses = $search->search('cursos-online-programacao/php');

foreach ($courses as $course) {
    echo $course . PHP_EOL;
}
