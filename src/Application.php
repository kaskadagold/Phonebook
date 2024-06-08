<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\PageNotFoundException;
use App\Exceptions\HttpException;
use Exception;

class Application
{
    public function __construct(
        private readonly Router $router,
    ) {
    }

    /** @throws PageNotFoundException | HttpException | Exception */
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
        } catch (HttpException $exception) {
            return new Response(
                (new View('errors/error.php'))->render([
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                ]),
                $exception->getCode(),
            );
        } catch (Exception $exception) {
            return new Response(
                (new View('errors/error.php'))->render(['message' => $exception->getMessage(), 'code' => 500]),
                500,
            );
        }
    }
}
