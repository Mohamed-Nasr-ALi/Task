<?php
namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Model as ModelAlias;

interface TaskInterface{
    public function all();
    /**
     * @param array $attributes
     * @return ModelAlias
     */
    public function create(array $attributes);
    /**
     * @param $id
     * @return ModelAlias
     */
    public function show($id);
    public function update(array $data, $id);
    public function delete($id);
}
