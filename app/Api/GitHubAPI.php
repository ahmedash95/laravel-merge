<?php

namespace App\Api;


interface GitHubAPI
{
    /**
     * @param string $repo
     * @param int $prId
     * @return array
     */
    public function getPullRequestInfo(string $repo,int $prId): array;
}
