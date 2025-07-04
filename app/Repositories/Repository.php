<?php

namespace App\Repositories;

use App\Http\interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected $model;
    public function __construct(Model $model){
        $this->model = $model;
    }
    public function all()
    {
        // TODO: Implement all() method.
        return $this->model->paginate(PAGINATION_COUNT);
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
        $record = $this->find($id);
        if(!$record){
            return false;
        }

        $record->update($data);
        return true;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
        return $this->model->findOrFail($id);
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
