<?php


namespace AlihanKoc\Laravelastic\Contracts;


interface Elastic
{
    public function index($index);

    public function id($id);

    public function find($id);

    public function type($type);

    public function limit($limit);

    public function offset($offset);

    public function body($body);

    public function get();

    public function getBuildedQuery();

    public function delete();

    public function create($data);

    public function update($data);

    public function updateWithScript($script, $scriptParams, $upsert);

    public function page($pagenumber, $pagesize);

    public function query();

    public function search();

}
