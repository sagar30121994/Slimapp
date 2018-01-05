<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
/*$app->get('/[sagar]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/
$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $response->write("")->withRedirect("http://www.gennextplm.com");
});

$app->get('/todos', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM tasks ORDER BY task");
   $sth->execute();
   $todos = $sth->fetchAll();
   return $this->response->withJson($todos);
});

$app->get('/todo/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM tasks WHERE id=:id");
   $sth->bindParam("id", $args['id']);
   $sth->execute();
   $todos = $sth->fetchObject();
   return $this->response->withJson($todos);
});

$app->get('/todos/search/[{query}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task");
   $query = "%".$args['query']."%";
   $sth->bindParam("query", $query);
   $sth->execute();
   $todos = $sth->fetchAll();
   return $this->response->withJson($todos);
});

$app->post('/todo', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO tasks (task) VALUES (:task)";
     $sth = $this->db->prepare($sql);
    $sth->bindParam("task", $input['task']);
    $sth->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});

$app->delete('/todo/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM tasks WHERE id=:id");
   $sth->bindParam("id", $args['id']);
   $sth->execute();
   $todos = $sth->fetchAll();
   return $this->response->withJson($todos);
});


$app->put('/todo/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE tasks SET task=:task WHERE id=:id";
     $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("task", $input['task']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});


$app->get('/messeges', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM messeges ORDER BY id");
   $sth->execute();
   $todos = $sth->fetchAll();
   
   return $this->response->withJson($todos);
});

$app->get('/employee', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM employee ");
   $sth->execute();
   $todos = $sth->fetchAll();
   return $this->response->withJson($todos);
});

$app->get('/devs', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM devs ORDER BY id");
   $sth->execute();
   $todos = $sth->fetchAll();
   return $this->response->withJson($todos);
});
