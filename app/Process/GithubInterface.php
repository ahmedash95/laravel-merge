<?php

namespace App\Process;

interface GitHubInterface
{

    /**
     * clone repository to path
     * @param string $repo
     */
    public function clone(string $repo);

    /**
     * pull repository to path
     * @param string $repo
     */
    public function pull(string $repo);

    /**
     * list merged pull requests
     * @param string $repo
     * @param int $limit
     */
    public function getMergedPr(string $repo, int $limit = 50);

}
