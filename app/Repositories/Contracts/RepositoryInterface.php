<?php 
namespace App\Repositories\Contracts;

interface RepositoryInterface {

    public function all($columns = array('*'));
	
	public function create(array $data);
 
    public function update(array $data, $id);
 
    public function delete($id);
 
    public function find($id, $columns = array('*'));
 
    public function findBy($field, $value, $columns = array('*'));

    public function findWhere($where, $columns = array('*'));

    public function with($relations);

}
