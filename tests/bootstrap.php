<?php
require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;
use Reggora\Lender;

$config = Yaml::parse(file_get_contents('./tests/credentials.yml'));

new Lender($config['lenderEmail'], $config['lenderPassword'], $config['lenderIntegrationToken']);