<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;

class BindRequestTest extends TestCase
{
    public function testBindingUnsuccessful()
    {
        $this->binder = $this
            ->getMockBuilder('App\BindRequest')
            ->disableOriginalConstructor()
            ->getMock();
        $this->binder->expects($this->once())
            ->method('bind')
            ->with(\App\Resources\FooBarRequest::class);

        $foo = new DefaultController();

        $response = $foo->index(
            $this->binder,
            \App\Resources\FooBarRequest::class
        );

        $this->assertEquals(
            400,
            $response->getStatusCode()
        );
    }

    public function testSuccessfulBinding()
    {
        $this->binder = $this
            ->getMockBuilder('App\BindRequest')
            ->disableOriginalConstructor()
            ->getMock();
        $this->binder->expects($this->once())
            ->method('bind')
            ->with(\App\Resources\FooBarRequest::class);

        $this->binder->expects($this->once())
            ->method('isSuccess')
            ->willReturn(true);

        $foo = new DefaultController();

        $response = $foo->index(
            $this->binder,
            \App\Resources\FooBarRequest::class
        );

        $this->assertEquals(
            200,
            $response->getStatusCode()
        );
    }
}
