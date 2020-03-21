<?php


namespace AlihanKoc\Elastic\Contracts;


interface Elastic
{
    public function post($index, $id, $body);

    public function find($index, $id);

    public function get($index);

    public function update($index, $id, $body);

    public function delete($index, $id);

    public function search($index, $query);
}
