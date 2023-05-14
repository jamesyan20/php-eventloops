<?php
class Loop {

	public function __construct(
		protected array $stack = []
	)
	{}

	public function next(mixed $value = null)
	{
		return Fiber::suspend($value);
	}

	public function run()
	{
		while($this->stack != [])
		{ 
			foreach($this->stack as $id=>$fiber)
			{
				$this->call($id,$fiber);	
			}
		}
	}

	public function defer(callable $callable): void
	{
		$this->stack[] = new Fiber($callable);
	}

	protected function call(int $id,\Fiber $fiber)
	{
		if($fiber->isStarted() === false) $fiber->start($id);
		if($fiber->isTerminated() === false) $fiber->resume();

		unset($this->stack[$id]);
		return $fiber->getReturn();
	}

}

