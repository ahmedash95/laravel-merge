<?php


namespace App\Api;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class Api implements GitHubAPI
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getPullRequestInfo($repo, $prId): array
    {
        $uri = sprintf('/repos/%s/pulls/%d', $repo, $prId);
        $response = $this->client->request('GET', $uri);

        return $response->toArray();
    }
}
