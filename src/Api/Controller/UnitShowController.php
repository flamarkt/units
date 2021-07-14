<?php

namespace Flamarkt\Units\Api\Controller;

use Flamarkt\Units\Api\Serializer\UnitSerializer;
use Flamarkt\Units\UnitRepository;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class UnitShowController extends AbstractShowController
{
    public $serializer = UnitSerializer::class;

    protected $repository;

    public function __construct(UnitRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function data(ServerRequestInterface $request, Document $document)
    {
        return $this->repository->findOrFail(Arr::get($request->getQueryParams(), 'id'), RequestUtil::getActor($request));
    }
}
