<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();

   $server = 'mysql:host=localhost:8889;dbname=hair_salon';
   $username = 'root';
   $password = 'root';
   $DB = new PDO($server, $username, $password);



    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
      return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
      });

      $app->get("/clients", function() use ($app) {
          return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
      });

      $app->post("/clients", function() use ($app) {
          $client_name = $_POST['client_name'];
          $stylist_id = $_POST['stylist_id'];
          $client = new Client($client_name, $stylist_id, $id = null);
          $client->save();
        //   var_dump($client);
          $stylist = Stylist::find($stylist_id);
          return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
      });

      $app->get("/stylists", function() use ($app) {
          return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
      });

      $app->get("/stylists/{id}", function($id) use ($app) {
          $stylist = Stylist::find($id);
          return $app['twig']->render('stylist.html.twig', array('stylists' => $stylist, 'clients' => $stylist->getClients()));
      });

      $app->post("/stylists", function() use ($app) {
          $stylist = new Stylist($_POST['stylist_name']);
          $stylist->save();
          return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
      });

      $app->get("/stylists/{id}/edit", function($id) use ($app) {
          $stylist = Stylist::find($id);
          return $app['twig']->render('stylist_edit.html.twig',   array('stylists' => $stylist));
      });

      $app->patch("/stylists/{id}", function($id) use ($app) {
          $stylist_name = $_POST['stylist_name'];
          $stylist = Stylist::find($id);
          $stylist->update($stylist_name);
          return $app['twig']->render('stylist.html.twig', array('stylists' => $stylist, 'clients' => $stylist->getClients()));
      });

      $app->delete("/stylists/{id}", function($id) use ($app) {
          $stylist = Stylist::find($id);
          $stylist->delete();
          return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

      $app->post("/delete_stylists", function() use ($app) {
          Stylist::deleteAll();
          return $app['twig']->render('index.html.twig');
      });

      $app->post("/delete_clients", function() use ($app) {
          Client::deleteAll();
          return $app['twig']->render('index.html.twig');
      });




    return $app;
?>
