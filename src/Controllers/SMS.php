<?php
namespace HamZone\AuthPhone\Controllers;

use HamZone\AuthPhone\Common\AliSMS;

use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Http\RequestUtil;

use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

use Illuminate\Support\Arr;

class SMSController extends AbstractCreateController
{
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertRegistered();

        $data = $request->getParsedBody();
        app('log')->info( $data );
        AliSMS::send("","");
    }
}