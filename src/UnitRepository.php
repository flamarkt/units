<?php

namespace Flamarkt\Units;

use Flamarkt\Units\Event\Deleted;
use Flamarkt\Units\Event\Deleting;
use Flamarkt\Units\Event\Saving;
use Flarum\Foundation\DispatchEventsTrait;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class UnitRepository
{
    use DispatchEventsTrait;

    protected $validator;

    public function __construct(Dispatcher $events, UnitValidator $validator)
    {
        $this->events = $events;
        $this->validator = $validator;
    }

    public function query(): Builder
    {
        return Unit::query();
    }

    public function visibleTo(User $actor = null): Builder
    {
        $query = $this->query();

        if ($actor) {
            return $query->whereVisibleTo($actor);
        }

        return $query;
    }

    public function findOrFail($id, User $actor = null): Unit
    {
        return $this->visibleTo($actor)->findOrFail($id);
    }

    public function save(Unit $unit, User $actor, array $data): Unit
    {
        $attributes = Arr::get($data, 'data.attributes');

        $this->validator->assertValid($attributes);

        if (Arr::exists($attributes, 'slug')) {
            $unit->slug = Arr::get($attributes, 'slug');
        }

        if (Arr::exists($attributes, 'preset')) {
            $unit->preset = Arr::get($attributes, 'preset');
        }

        $this->events->dispatch(new Saving($unit, $actor, $data));

        $unit->save();

        $this->dispatchEventsFor($unit, $actor);

        return $unit;
    }

    public function store(User $actor, array $data): Unit
    {
        $actor->assertCan('create', Unit::class);

        return $this->save(new Unit(), $actor, $data);
    }

    public function update(Unit $unit, User $actor, array $data): Unit
    {
        $actor->assertCan('edit', $unit);

        return $this->save($unit, $actor, $data);
    }

    public function delete(Unit $unit, User $actor)
    {
        $actor->assertCan('delete', $unit);

        $this->events->dispatch(new Deleting($unit, $actor));

        $unit->delete();

        $this->events->dispatch(new Deleted($unit, $actor));
    }
}
