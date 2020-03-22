<?php


namespace AlihanKoc\Laravelastic\Repositories;


use AlihanKoc\Laravelastic\Contracts\Elastic;
use Elasticsearch\ClientBuilder;

class ElasticRepository implements Elastic
{
    private $clientBuilder;

    private $client;

    private $params = [];

    public function __construct(ClientBuilder $clientBuilder){
        $this->clientBuilder = $clientBuilder;
        $this->buildClient();
    }

    public function index($index){
        $this->params['index'] = $index;
        return $this;
    }

    public function type($type){
        $this->params['type'] = $type;
        return $this;
    }

    public function id($id){
        $this->params['id'] = $id;
        return $this;
    }

    public function find($id){
        $this->params['id'] = $id;
        return $this->client->get($this->params);
    }

    public function limit($size = null){
        if (is_null($size)) {
            unset($this->params['size']);
        } else {
            $this->params['size'] = $size;
        }
        return $this;
    }

    public function offset($from = null){
        if (is_null($from) || $from === 0) {
            unset($this->params['from']);
        } else {
            $this->params['from'] = $from;
        }
        return $this;
    }

    public function page($pageNumber, $pageSize){
        return $this
        ->offset($pageSize * ($pageNumber - 1))
        ->limit($pageSize);
    }

    public function query(array $query = null){
        if (is_null($query)) {
            unset($this->params['body']['query']);
        } else {
            $this->params['body']['query'] = $query;
        }
        return $this;
    }

    public function body($body = null){
        if (is_null($body)) {
            unset($this->params['body']);
        } else {
            $this->params['body'] = $body;
        }
        return $this;
    }

    public function search(){
        return $this->client->search($this->params);
    }

    public function get(){
        return $this->client->get($this->params);
    }

    public function getBuildedQuery(){
        return $this->params;
    }

    public function delete(){
        if (!empty($this->params['body']['query'])) {
            return $this->client->deleteByQuery($this->params);
        }

        return $this->client->delete($this->params);
    }

    public function create($data){
        $params = $this->params;

        $params['body'] = $data;

        return $this->client->create($params);
    }

    public function update($data){
        $params = $this->params;

        $params['body']['doc'] = $data;

        if (!empty($params['body']['query'])) {
            return $this->client->updateByQuery($params);
        }

        return $this->client->update($params);
    }

    public function updateWithScript($script, $scriptParams = [], $upsert = null){
        $params = $this->params;

        $params['body']['script'] = $script;
        $params['body']['params'] = $scriptParams;

        if ($upsert) {
            $params['body']['upsert'] = $upsert;
        }

        if (!empty($params['body']['query'])) {
            return $this->client->updateByQuery($params);
        }

        return $this->client->update($params);
    }

    private function buildClient(){
        $this->clientBuilder::create();
        $this->clientBuilder->setHosts($this->getHosts());
        $this->client = $this->clientBuilder->build();
    }

    private function getHosts(){
        return [
            [
                'host' => config('elastic.elastic_host'),
                'port' => config('elastic.elastic_port'),
                'scheme' => config('elastic.elastic_scheme'),
                'path' => config('elastic.elastic_path'),
                'user' => config('elastic.elastic_username'),
                'pass' => config('elastic.elastic_password')
            ]
        ];
    }
}
