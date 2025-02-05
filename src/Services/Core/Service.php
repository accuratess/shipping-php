<?php

namespace Accurate\Shipping\Services\Core;

use Accurate\Shipping\Client\Client;
use GraphQL\Exception\QueryError;

class Service
{
    /**
     * 
     *
     * @param object $operation
     * @param array $variables
     * @return void
     */
    function runOperation(object $operation, ?array $variables = null)
    {
        try {
            $mutationResponse = Client::$shared->runQuery($operation, true, $variables ?? []);
            return json_encode([
                'status' => 200,
                'data' => $mutationResponse->getResults()
            ]);
        } catch (QueryError $e) {
            return json_encode([
                'status' => 500,
                'data' => $e->getErrorDetails()
            ]);
        }
    }
}
