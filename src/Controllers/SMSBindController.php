<?php
namespace HamZone\AuthPhone\Controllers;

use HamZone\AuthPhone\Common\Blind;

use Flarum\Http\RequestUtil;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;


class SMSBindController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertRegistered();
        return new JsonResponse( Blind::smsAuth($actor, $request->getParsedBody()) );
    }
}