<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.3.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Error\Middleware;

use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\InstanceConfigTrait;
use Cake\Error\ErrorHandler;
use Cake\Error\ExceptionTrap;
use Cake\Error\Renderer\WebExceptionRenderer;
use Cake\Http\Exception\RedirectException;
use Cake\Http\Response;
use InvalidArgumentException;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

/**
 * Error handling middleware.
 *
 * Traps exceptions and converts them into HTML or content-type appropriate
 * error pages using the CakePHP ExceptionRenderer.
 */
class ErrorHandlerMiddleware implements MiddlewareInterface
{
    use InstanceConfigTrait;

    /**
     * Default configuration values.
     *
     * Ignored if contructor is passed an ExceptionTrap instance.
     *
     * Configuration keys and values are shared with `ExceptionTrap`.
     * This class will pass its configuration onto the ExceptionTrap
     * class if you are using the array style constructor.
     *
     * @var array<string, mixed>
     * @see \Cake\Error\ExceptionTrap
     */
    protected $_defaultConfig = [
        'exceptionRenderer' => WebExceptionRenderer::class,
    ];

    /**
     * Error handler instance.
     *
     * @var \Cake\Error\ErrorHandler|null
     */
    protected $errorHandler = null;

    /**
     * ExceptionTrap instance
     *
     * @var \Cake\Error\ExceptionTrap|null
     */
    protected $exceptionTrap = null;

    /**
     * Constructor
     *
     * @param \Cake\Error\ErrorHandler|\Cake\Error\ExceptionTrap|array $errorHandler The error handler instance
     *  or config array.
     * @throws \InvalidArgumentException
     */
    public function __construct($errorHandler = [])
    {
        if (func_num_args() > 1) {
            deprecationWarning(
                'The signature of ErrorHandlerMiddleware::__construct() has changed. '
                . 'Pass the config array as 1st argument instead.'
            );

            $errorHandler = func_get_arg(1);
        }

        if (PHP_VERSION_ID >= 70400 && Configure::read('debug')) {
            ini_set('zend.exception_ignore_args', '0');
        }

        if (is_array($errorHandler)) {
            $this->setConfig($errorHandler);

            return;
        }
        if ($errorHandler instanceof ErrorHandler) {
            deprecationWarning(
                'Using an `ErrorHandler` is deprecated. You should migate to the `ExceptionTrap` sub-system instead.'
            );
            $this->errorHandler = $errorHandler;

            return;
        }
        if ($errorHandler instanceof ExceptionTrap) {
            $this->exceptionTrap = $errorHandler;

            return;
        }
        throw new InvalidArgumentException(sprintf(
            '$errorHandler argument must be a config array or ExceptionTrap instance. Got `%s` instead.',
            getTypeName($errorHandler)
        ));
    }

    /**
     * Wrap the remaining middleware with error handling.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The request handler.
     * @return \Psr\Http\Message\ResponseInterface A response
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (RedirectException $exception) {
            return $this->handleRedirect($exception);
        } catch (Throwable $exception) {
            return $this->handleException($exception, $request);
        }
    }

    /**
     * Handle an exception and generate an error response
     *
     * @param \Throwable $exception The exception to handle.
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    public function handleException(Throwable $exception, ServerRequestInterface $request): ResponseInterface
    {
        if ($this->errorHandler === null) {
            $handler = $this->getExceptionTrap();
            $handler->logException($exception, $request);

            $renderer = $handler->renderer($exception, $request);
        } else {
            $handler = $this->getErrorHandler();
            $handler->logException($exception, $request);

            $renderer = $handler->getRenderer($exception, $request);
        }

        try {
            /** @var \Psr\Http\Message\ResponseInterface|string $response */
            $response = $renderer->render();
            if (is_string($response)) {
                return new Response(['body' => $response, 'status' => 500]);
            }

            return $response;
        } catch (Throwable $internalException) {
            $handler->logException($internalException, $request);

            return $this->handleInternalError();
        }
    }

    /**
     * Convert a redirect exception into a response.
     *
     * @param \Cake\Http\Exception\RedirectException $exception The exception to handle
     * @return \Psr\Http\Message\ResponseInterface Response created from the redirect.
     */
    public function handleRedirect(RedirectException $exception): ResponseInterface
    {
        return new RedirectResponse(
            $exception->getMessage(),
            $exception->getCode(),
            $exception->getHeaders()
        );
    }

    /**
     * Handle internal errors.
     *
     * @return \Psr\Http\Message\ResponseInterface A response
     */
    protected function handleInternalError(): ResponseInterface
    {
        return new Response([
            'body' => 'An Internal Server Error Occurred',
            'status' => 500,
        ]);
    }

    /**
     * Get a error handler instance
     *
     * @return \Cake\Error\ErrorHandler The error handler.
     */
    protected function getErrorHandler(): ErrorHandler
    {
        if ($this->errorHandler === null) {
            /** @var class-string<\Cake\Error\ErrorHandler> $className */
            $className = App::className('ErrorHandler', 'Error');
            $this->errorHandler = new $className($this->getConfig());
        }

        return $this->errorHandler;
    }

    /**
     * Get a exception trap instance
     *
     * @return \Cake\Error\ExceptionTrap The exception trap.
     */
    protected function getExceptionTrap(): ExceptionTrap
    {
        if ($this->exceptionTrap === null) {
            /** @var class-string<\Cake\Error\ExceptionTrap> $className */
            $className = App::className('ExceptionTrap', 'Error');
            $this->exceptionTrap = new $className($this->getConfig());
        }

        return $this->exceptionTrap;
    }
}
