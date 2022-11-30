<?php
namespace HamZone\AuthPhone\Controllers;

use HamZone\AuthPhone\Common\AliSMS;

use Flarum\Http\RequestUtil;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;


class SMSSendController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertRegistered();
        if($actor->phone){
            return new JsonResponse( ["status"=>false, "msg" => "already bind"] );
        }
        return new JsonResponse( AliSMS::send( $request->getParsedBody(), $actor->id) );
    }
}