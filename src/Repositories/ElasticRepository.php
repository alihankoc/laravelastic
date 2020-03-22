<?php


namespace AlihanKoc\Elastic\Repositories;


use AlihanKoc\Elastic\Contracts\Elastic;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

class ElasticRepository implements Elastic
{
    private $clientBuilder;

    private $client;

    public function __construct(ClientBuilder $clientBuilder){
        $this->clientBuilder = $clientBuilder;
        $this->buildClient();
    }

    public function find($index, $id){
        $params = [
            'index' => $index,
            'id'    => $id
        ];

        return $this->client->get($params);
    }

    public function search($index,$body = null){
        $params = [
            'index' => $index,
            'body'=>$body
        ];

        return $this->client->search($params);
    }

    public function post($index, $id, $body){
        // TODO: Implement post() method.
    }

    public function update($index, $id, $body){
        // TODO: Implement update() method.
    }

    public function delete($index, $id){
        // TODO: Implement delete() method.
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
