<?php

namespace Alura\SearchCourses;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Search
{

    private ClientInterface $httpClient;
    private Crawler $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {

        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function search(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);
        $html = $response->getBody();

        $this->crawler->addHtmlContent($html);
        $coursesElements = $this->crawler->filter('.card-curso__nome');
        $courses = [];

        foreach ($coursesElements as $coursesElement) {
            $courses[] = $coursesElement->textContent;
        }

        return $courses;
    }
}
