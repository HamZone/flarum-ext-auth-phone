<?php
namespace HamZone\AuthPhone\Controllers;

use HamZone\AuthPhone\Common\Unlink;

use Flarum\Http\RequestUtil;
// use HamZone\AuthPhone\PhoneHistory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Tobscure\JsonApi\Document;
use Flarum\Api\Controller\AbstractCreateController;

class SMSUnlinkController extends AbstractCreateController
{
    protected $phoneHistory;

    // public function __construct(PhoneHistory $phoneHistory)
    // {
    //     $this->phoneHistory = $phoneHistory;
    // }

    public function data(ServerRequestInterface $request, Document $document)
    {
        
        $actor = RequestUtil::getActor($request);
        $actor->assertRegistered();
        
        // app('log')->info( $actor->phoneHistory()->where('user_id', $actor->id)->exists() );

        // return new JsonResponse( Unlink::unlink($actor->id) );

        // $actor = $request->getAttribute('actor');
        // $actorLoginProviders = $actor->phoneHistory()->where('provider', 'wechat')->first();

        
        // app('log')->info( "test ".$this->phoneHistory->newQuery()->orderBy('user_id')->get() );
        app('log')->info( app('flarum.config.debug') );
        
        return [];
    }
}