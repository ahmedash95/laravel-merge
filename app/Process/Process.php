<?php


namespace App\Process;

use Symfony\Component\Process\Process as SymfonyProcess;

class Process
{
    public function command(string $command) {
        return SymfonyProcess::fromShellCommandline($command);
    }
}
