<?php

namespace App\Repositories;


interface RepositoryInterface
{
    public function all($columns = array('*'));

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function find($id, $columns = array('*'));

}