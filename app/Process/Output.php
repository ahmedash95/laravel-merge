<?php


namespace App\Process;


use Symfony\Component\Process\Process as SymfonyProcess;

class Output
{
    /**
     * @var string
     */
    public $output;

    /**
     * @var SymfonyProcess
     */
    private $command;

    public function __construct(SymfonyProcess $process)
    {
        $this->command = $process;
    }

    public function __invoke($type, $buffer)
    {
        $this->output .= $buffer;
    }

    public function __toString()
    {
        return $this->output;
    }

    public function __call($name, $arguments)
    {
        return $this->command->$name(...$arguments);
    }
}
