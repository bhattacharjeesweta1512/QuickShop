<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Jwt extends BaseConfig
{
    public $secretKey = '098765'; // Set your secret key here
    public $algorithm = 'HS256'; // Set the algorithm used for token generation
    public $validFor = 3600; // Token validity period in seconds (default: 1 hour)
    public $issuer = 'your_issuer'; // Set the issuer of the token
}
