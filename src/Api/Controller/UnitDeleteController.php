<?php

namespace Flamarkt\Units\Api\Controller;

use Flamarkt\Units\UnitRepository;
use Flarum\Api\Controller\AbstractDeleteController;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class UnitDeleteController extends AbstractDeleteController
{
    protected $repository;

    public function __construct(UnitRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function delete(ServerRequestInterface $request)
    {
        $actor = RequestUtil::getActor($request);

        $product = $this->repository->findOrFail(Arr::get($request->getQueryParams(), 'id'), $actor);

        $this->repository->delete($product, $actor);
    }
}
