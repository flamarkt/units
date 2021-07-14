<?php

namespace Flamarkt\Units\Api\Controller;

use Flamarkt\Units\Api\Serializer\UnitSerializer;
use Flamarkt\Units\UnitFilterer;
use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use Flarum\Http\UrlGenerator;
use Flarum\Query\QueryCriteria;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class UnitIndexController extends AbstractListController
{
    public $serializer = UnitSerializer::class;

    public $sortFields = [
        'slug',
    ];

    public $sort = [
        'slug' => 'asc',
    ];

    protected $filterer;
    protected $url;

    public function __construct(UnitFilterer $filterer, UrlGenerator $url)
    {
        $this->filterer = $filterer;
        $this->url = $url;
    }

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $filters = $this->extractFilter($request);
        $sort = $this->extractSort($request);

        $limit = $this->extractLimit($request);
        $offset = $this->extractOffset($request);
        $include = $this->extractInclude($request);

        $criteria = new QueryCriteria($actor, $filters, $sort);
        $results = $this->filterer->filter($criteria, $limit, $offset);

        $document->addPaginationLinks(
            $this->url->to('api')->route('flamarkt.units.index'),
            $request->getQueryParams(),
            $offset,
            $limit,
            $results->areMoreResults() ? null : 0
        );

        $this->loadRelations($results->getResults(), $include);

        return $results->getResults();
    }
}
