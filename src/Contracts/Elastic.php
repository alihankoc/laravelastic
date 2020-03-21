<?php


namespace AlihanKoc\Elastic\Contracts;


interface Elastic
{
    public function post($index, $id, $body);

    public function get($index, $id);

    public function update($index, $id, $body);

    public function delete($index, $id);

    public function search($index, $query);
}
