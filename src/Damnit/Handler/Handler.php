<?php
/**
 * Damnit - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace Damnit\Handler;
use Damnit\Handler\HandlerInterface;
use Damnit\Exception\Inspector;
use Damnit\Run;

/**
 * Base handler, can be used as a simple text
 * output handler (but really, you probably shouldn't),
 * and extended to create custom handlers.
 *
 * @todo : cleanup interface, namely the exception, run & inspector
 *         portion of it.
 */
class Handler implements HandlerInterface
{
    /**
     * Return constants that can be returned from Handler::handle
     * to message the handler walker.
     */
    const LAST_HANDLER = 0x10;

    /**
     * @var Damnit\Run
     */
    private $run;

    /**
     * @param Damnit\Run $run
     */
    public function setRun(Run $run)
    {
        $this->run = $run;
    }

    /**
     * @return Damnit\Run
     */
    protected function getRun()
    {
        return $this->run;
    }

    /**
     * @param Damnit\Exception\Inspector $inspector
     */
    public function setInspector(Inspector $inspector)
    {
        $this->inspector = $inspector;
    }

    /**
     * @return Damnit\Run
     */
    protected function getInspector()
    {
        return $this->inspector;
    }

    /**
     * @param \Exception
     * @return int|null
     */
    public function handle(\Exception $exception)
    {
        $name    = get_class($exception);
        $message = $exception->getMessage();
        $file    = $exception->getFile();
        $line    = $exception->getLine();
        $trace   = $exception->getTraceAsString();

        print "Uh oh!\n";
        print "{$name}: $message\n";
        print "In {$file}:$line\n";
        print "---\n$trace";
    }
}