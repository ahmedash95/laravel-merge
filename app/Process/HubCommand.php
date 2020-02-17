<?php

namespace App\Process;


use Symfony\Component\Filesystem\Filesystem;

class HubCommand implements GitHubInterface
{
    /**
     * @var Process $process
     */
    private $process;

    /**
     * @var string $path
     */
    private $path;

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Process $process, Filesystem $filesystem, $path = '/tmp')
    {
        $this->process = $process;
        $this->path = $path;
        $this->filesystem = $filesystem;
    }


    /**
     * @param string $repo
     * @return Output
     * @throws \Exception
     */
    public function clone(string $repo): Output
    {
        $directoryName = $this->getRepoName($repo);
        $path = $this->getAbsolutePath($directoryName);

        if ($this->ensureItDoesNotExist($path)) {
            throw new \Exception('Repository already cloned: '.$path);
        }

        $command = $this->process->command('hub clone '.$repo.' '.$path);
        $command->run($output = new Output($command));

        return $output;
    }

    /**
     * @param string $repo
     * @return Output
     * @throws \Exception
     */
    public function pull(string $repo)
    {
        $directoryName = $this->getRepoName($repo);
        $path = $this->getAbsolutePath($directoryName);

        if (!$this->ensureItDoesNotExist($path)) {
            throw new \Exception('Repository not found: '.$path);
        }

        $command = $this->process->command(sprintf('cd %s && hub pull', $path));
        $command->run($output = new Output($command));
        return $output;
    }

    /**
     * @param string $repo
     * @param int $limit
     * @return Output
     * @throws \Exception
     */
    public function getMergedPr(string $repo, int $limit = 50)
    {
        $directoryName = $this->getRepoName($repo);
        $path = $this->getAbsolutePath($directoryName);

        if (!$this->ensureItDoesNotExist($path)) {
            throw new \Exception('Repository not found: '.$path);
        }

        $command = $this->process->command(sprintf('cd %s && hub pr list -L %d --state merged', $path, $limit));
        $command->run($output = new Output($command));

        return $output;
    }

    private function getAbsolutePath(string $repo)
    {
        return rtrim($this->path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.ltrim($repo, DIRECTORY_SEPARATOR);
    }

    private function ensureItDoesNotExist(string $path)
    {
        return $this->filesystem->exists($path);
    }

    private function getRepoName(string $repo)
    {
        return explode('/', $repo)[1];
    }
}
