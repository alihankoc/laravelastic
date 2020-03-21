<?php

return [
    'elastic_host'=>env('ELASTIC_HOST','localhost'),
    'elastic_port'=>env('ELASTIC_PORT',9200),
    'elastic_scheme'=>env('ELASTIC_SCHEME','http'),
    'elastic_path'=>env('ELASTIC_PATH','/'),
    'elastic_username'=>env('ELASTIC_USERNAME',''),
    'elastic_password'=>env('ELASTIC_PASSWORD',''),
];
