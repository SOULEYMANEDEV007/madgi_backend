<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     */
    abstract public function getFieldsSearchable(): array;

    /**
     * Configure the Model
     */
    abstract public function model(): string;

    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return Model
     */
    public function makeModel()
    {
        $model = app($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     */
    public function paginate(int $perPage, array $columns = ['*']): LengthAwarePaginator
    {
        $query = $this->allQuery();

        return $query/*->where('status', 1)*/->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     */
    public function allQuery(array $search = [], int $skip = null, int $limit = null): Builder
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria
     */
    public function all(array $search = [], int $skip = null, int $limit = null, array $columns = ['*']): Collection
    {
        $query = $this->allQuery($search, $skip, $limit);

        return $query/*->where('status', 1)*/->get($columns);
    }

    /**
     * Create model record
     */
    public function create(array $input): Model
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    /**
     * Find model record for given id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find(int $id, array $columns = ['*'])
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    /**
     * Update model record for given id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update(array $input, int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function delete(int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }

    public function where(string $columns = 'id', $value)
    {
        $query = $this->allQuery();

        return $query->where($columns, $value);
    }

    public function orderBy(string $columns = 'id', string $direction = 'asc')
    {
        $query = $this->allQuery();

        return $query->orderBy($columns, $direction);
    }

    public function groupBy(string $columns = 'id')
    {
        $query = $this->allQuery();

        return $query->groupBy($columns);
    }

    public function whereLike(string $columns = 'name', $value)
    {
        $query = $this->allQuery();

        return $query->where($columns, 'like', "%$value%")/*->where('status', 1)*/->latest($columns, 'desc');
    }

    public function whereLocalisation($user, $clause = null)
    {
        $query = $this->allQuery();

        if($clause != null)
            return $query->where(function($q) use($user, $clause) {
                $q->where('status', 1)
                ->where($clause[0], 'like', "%$clause[1]%")
                ->where('country_id', $user->country_id)
                ->where('city_id', $user->city_id)
                ->where('cmne_id', $user->cmne_id)
                ->orWhere('ktier_id', $user->ktier_id);
            });
        else
            return $query->where(function($q) use($user) {
                $q->where('status', 1)
                ->where('country_id', $user->country_id)
                ->where('city_id', $user->city_id)
                ->where('cmne_id', $user->cmne_id)
                ->orWhere('ktier_id', $user->ktier_id);
            });
    }

    public function whereMultiple($type, $search = null)
    {
        $query = $this->allQuery();

        $searchTerm = '%'.$search.'%';

        if($type == 2) {
            return $query->where('type', $type)
                ->where(function($q) use ($searchTerm) {
                    $q->where('nom', 'like', $searchTerm)
                    ->orWhere('specialite', 'like', $searchTerm)
                    ->orWhere('type_stage', 'like', $searchTerm)
                    ->orWhere('situation_stage', 'like', $searchTerm)
                    ->orWhere('tel', 'like', $searchTerm)
                    ->orWhere('date_validations', 'like', $searchTerm)
                    ->orWhere('reconduction', 'like', $searchTerm);
                });
        }
        else if($type == 3) {
            return $query->where('type', $type)
                ->where(function($q) use ($searchTerm) {
                    $q->where('nom', 'like', $searchTerm)
                    ->orWhere('specialite', 'like', $searchTerm)
                    ->orWhere('type_stage', 'like', $searchTerm)
                    ->orWhere('situation_convention', 'like', $searchTerm)
                    ->orWhere('date_validations', 'like', $searchTerm)
                    ->orWhere('reconduction', 'like', $searchTerm);
                });
        }
        return;

        return $query->where(function($q) use ($type, $searchTerm) {

        });
    }

    public function latest(string $columns = 'id')
    {
        $query = $this->allQuery();

        return $query/*->where('status', 1)*/->latest($columns, 'desc');
    }

    public function whereIn(string $columns = 'id', $value)
    {
        $query = $this->allQuery();

        return $query->whereIn($columns, $value);
    }

    public function whereNotNull(string $columns = 'id')
    {
        $query = $this->allQuery();

        return $query->whereNotNull($columns);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        if($values == []) $model = $this->model->updateOrCreate($attributes, $attributes);
        else $model = $this->model->updateOrCreate($attributes, $values);

        return $model;
    }

    public function count()
    {
        $query = $this->allQuery();

        return $query->count();
    }
}
