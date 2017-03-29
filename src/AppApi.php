<?php

namespace API;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class AppApi
{
    /**
     * Stores an instance of the Slim application.
     *
     * @var \Slim\App
     */
    private $app;

    public function __construct()
    {

        $app = new \Slim\App;

        $app->get('/', function (Request $request, Response $response) {
            $response->getBody()->write('hello');
            return $response;
        });

        $app->group('/todo', function () {

            $this->map(['GET'], '', function (Request $request, Response $response) {
                return $response->withJson(['message' => 'Hello, Todo']);
            });
            $this->get('/{id}', function (Request $request, Response $response, $args) {
                if (todoIdValid($args['id'])) {
                    return $response->withJson(['message' => "Todo " . $args['id']]);
                }
                return $response->withJson(['message' => 'Todo Not Found'], 404);
            });
            $this->map(['POST', 'PUT', 'PATCH'], '/{id}', function (Request $request, Response $response, $args) {
                if (todoIdValid($args['id'])) {
                    return $response->withJson(['message' => "Todo " . $args['id'] . " updated successfully"]);
                }
                return $response->withJson(['message' => 'Todo Not Found'], 404);
            });
            $this->delete('/{id}', function (Request $request, Response $response, $args) {
                if (todoIdValid($args['id'])) {
                    return $response->withJson(['message' => "Todo " . $args['id'] . " deleted successfully"]);
                }
                return $response->withJson(['message' => 'Todo Not Found'], 404);
            });
        });

        $this->app = $app;
    }

    /**
     * Get an instance of the application.
     *
     * @return \Slim\App
     */
    public function get()
    {
        return $this->app;
    }
}