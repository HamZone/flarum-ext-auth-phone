<?php

namespace HamZone\AuthPhone\Middlewares;

use Flarum\Foundation\ErrorHandling\ExceptionHandler\IlluminateValidationExceptionHandler;
use Flarum\Foundation\ErrorHandling\JsonApiFormatter;
use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Flarum\Http\RequestUtil;
use Flarum\Api\JsonApiResponse;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Exception\Handler\ResponseBag;

class DiscussionMiddleware implements MiddlewareInterface
{
   
    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        $path = $request->getUri()->getPath();
        if ( ( stristr($path, 'discussions') ||  stristr($path, 'posts')) && $request->getMethod() === 'POST') {
            try {
                $actor = RequestUtil::getActor($request);
                if(!$actor->phone){
                    $error = new ResponseBag('422', [
                        [
                            'status' => '422',
                            'code' => 'validation_error',
                            'source' => [
                                'pointer' => '/api/discussions',
                            ],
                            'detail' => 'Yikes! You need to verify your mobile number.',
                        ],
                    ]);
                    $document = new Document();
                    $document->setErrors($error->getErrors());
                  
                    return new JsonApiResponse($document, $error->getStatus());
                }

            } catch (ValidationException $exception) {
              
                $handler = resolve(IlluminateValidationExceptionHandler::class);
               
                $error = $handler->handle($exception);

                return (new JsonApiFormatter())->format($error, $request);
            }
        }

        return $handler->handle($request);
    }
}
