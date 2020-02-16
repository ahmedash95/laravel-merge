<?php

namespace App\Traits;

use App\Process\Output;
use App\Task;

trait taskable
{
    public function logTask($name, Output $output)
    {
        Task::create(
            [
                'script' => $name,
                'output' => $output,
                'exit_code' => $output->getExitCode(),
                'status' => 'done',
            ]
        );
    }
}
