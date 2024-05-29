<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\PageNotFoundException;

class Application
{
    public function __construct(
        private readonly Router $router,
    ) {
    }

    public function run(Request $request): Response
    {
        try {
            container()->instance(Request::class, $request);
            return $this->router->run($request);
        } catch (PageNotFoundException $exception) {
            return new Response(
                (new View('errors/404.php'))->render(),
                404,
            );
        }
    }
}
