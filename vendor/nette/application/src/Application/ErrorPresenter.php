<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

namespace NetteModule;

use Nette;
use Nette\Application;
use Tracy\Debugger;


/**
 * Default Error Presenter.
 *
 * @author     David Grudl
 */
class ErrorPresenter extends Nette\Object implements Application\IPresenter
{

	/**
	 * @return Application\IResponse
	 */
	public function run(Application\Request $request)
	{
		$e = $request->parameters['exception'];
		if ($e instanceof Application\BadRequestException) {
			$code = $e->getCode();
		} else {
			$code = 500;
			Debugger::log($e, Debugger::EXCEPTION);
		}
		ob_start();
		require __DIR__ . '/templates/error.phtml';
		return new Application\Responses\TextResponse(ob_get_clean());
	}

}
