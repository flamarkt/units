<?php

namespace Flamarkt\Units\Api\Controller;

use Flamarkt\Units\Api\Serializer\UnitSerializer;
use Flamarkt\Units\UnitRepository;
use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Http\RequestUtil;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class UnitStoreController extends AbstractCreateController
{
    public $serializer = UnitSerializer::class;

    protected $repository;

    public function __construct(UnitRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function data(ServerRequestInterface $request, Document $document)
    {
        return $this->repository->store(RequestUtil::getActor($request), $request->getParsedBody());
    }
}
