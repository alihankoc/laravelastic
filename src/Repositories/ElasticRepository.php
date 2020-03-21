<?php


namespace AlihanKoc\Elastic\Repositories;


use AlihanKoc\Elastic\Contracts\Elastic;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

class ElasticRepository implements Elastic
{
    protected $clientBuilder;

    protected $client;

    public function __construct(ClientBuilder $clientBuilder)
    {
        $this->clientBuilder = $clientBuilder;
        $this->buildClient();
    }

    public function find($index, $id)
    {
        $params = [
            'index' => $index,
            'id'    => $id
        ];
        return $this->client->get($params);
    }

    public function get($index)
    {
        $params = [
            'index' => $index
        ];
        return $this->client->get($params);
    }

    public function post($index, $id, $body)
    {
        // TODO: Implement post() method.
    }

    public function update($index, $id, $body)
    {
        // TODO: Implement update() method.
    }

    public function delete($index, $id)
    {
        // TODO: Implement delete() method.
    }

    public function search($index, $query)
    {
        // TODO: Implement search() method.
    }

    protected function buildClient(){

        $hosts = [
            [
                'host' => config('elastic.elastic_host'),
                'port' => config('elastic.elastic_port'),
                'scheme' => config('elastic.elastic_scheme'),
                'path' => config('elastic.elastic_path'),
                'user' => config('elastic.elastic_username'),
                'pass' => config('elastic.elastic_password')
            ]
        ];

        $this->clientBuilder::create();   // Instantiate a new ClientBuilder
        $this->clientBuilder->setHosts($hosts);           // Set the hosts
        $this->client = $this->clientBuilder->build();
    }
}
