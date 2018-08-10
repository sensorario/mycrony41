<?php

namespace App;

use Symfony\Component\HttpFoundation\RequestStack;
use Psr\Log\LoggerInterface;

class BindRequest
{
    private $requestStack;

    private $logger;

    private $success;

    public function __construct(
        RequestStack $requestStack,
        LoggerInterface $logger
    ) {
        $this->requestStack = $requestStack;
        $this->logger = $logger;
    }

    public function bind($requestObject)
    {
        try {
            $queryString =  $this->requestStack
                ->getCurrentRequest()
                ->query->all();
            $requestObject::box($queryString);
            $this->success = true;
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
            $this->success = false;
        }
    }

    public function isSuccess()
    {
        return $this->success == true;
    }
}
