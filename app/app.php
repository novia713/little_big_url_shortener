<?php

use Silex\Application;
use Carbon\Carbon;

$app = new Application();
$carbon = new Carbon();
require_once 'boot.php';

 /*
 $app->get('/', function() use( $app) {


     $slugs = $app['db']->fetchAssoc('SELECT * FROM slugs');
     return $app->json($slugs);
 });
 */

 //@TODO; these closures would be part of a Trait or a Class ....
 $existent_slug = function ($slug) use ($app) {
   $sql = 'SELECT * FROM slugs WHERE slug = ?';

   return $app['db']->fetchAssoc($sql, [$slug]);
 };

 $existent_url = function ($url, $table) use ($app) {
   $sql = "SELECT * FROM $table WHERE url = ?";

   return $app['db']->fetchAssoc($sql, [$url]);
 };

 $get_visits = function ($url) use ($app) {
   $sql = 'SELECT visits FROM stats WHERE url = ?';

   return $app['db']->fetchAssoc($sql, [$url]);
 };

 $app->post('/create/{url}', function (Silex\Application $app, $url) use ($existent_slug, $existent_url) {

   //check [ http:// || https:// ]
   if ((strpos($url, "http://") !== 0) && (strpos($url, "https://") !== 0) ) {
     return $app->json(['status' => 'ko', 'reason' => 'badformed url']);
   }

   //check if it already exists
   if ($existent = $existent_url($url, 'slugs')) {
       return $app->json(['status' => 'ok', 'slug' => $existent['slug'], 'already_existent' => 'yes']);
   }

   // not really random :-/
    $give_me_random_slug = function () use ($url) {
      return substr(sha1($url), 5, 9);
    };

    $the_slug = $give_me_random_slug();
    if ($existent_slug($the_slug) === false && $existent_url($url, 'slugs') === false) {
        //insert
      $app['db']->insert('slugs', ['slug' => "$the_slug", 'url' => "$url"]);

        return $app->json(['status' => 'ok', 'slug' => $the_slug]);
    } else {
        //already exists
      return $app->json(['status' => 'ko', 'reason' => 'url already existent']);
    }
 })->assert('url', '.*');

  $app->get('/view/{slug}', function (Silex\Application $app, $slug) use ($existent_slug, $existent_url, $carbon) {

   $res = $existent_slug($slug);
   if ($res === false) {
       return $app->json(['status' => 'ko', 'reason' => 'slug not existent']);
   } else {
       if ($res['url']) {
           if ($existent_url($res['url'], 'stats') === false) {
               return $app->json(['status' => 'ko', 'reason' => 'no stats found for slug '.$slug]);
           } else {
               $visits = $app['db']->fetchAll('SELECT * FROM stats WHERE url = ? ORDER BY id DESC', [$res['url']]);

               //get day of most frecuent visits
               $days = array_column($visits, 'timestamp');
               foreach ($days as &$day) {
                   $day = $carbon->createFromFormat('Y-m-d H:i:s', $day)->format('d-m-Y');
               }
               $most_days = array_count_values($days);

               //get visits today
               $today = $carbon->now()->format('d-m-Y');
               $visits_today = (@$most_days[$today] > 0) ?
                 $most_days[$today] :
                 0;

               arsort($most_days);

               return $app->json([
                  'status' => 'ok',
                  'total_visits' => sizeof($visits),
                  'day_most_visited' => key($most_days),
                  'visits_today' => $visits_today, ]);
           }
       }
   }
 });

 $app->get('/{slug}', function (Silex\Application $app, $slug) use ($existent_slug) {

   $res = $existent_slug($slug);
   if ($res === false) {
       return $app->json(['status' => 'ko', 'reason' => 'slug not existent']);
   } else {
       if ($res['url']) {
           $b = $_SERVER['HTTP_USER_AGENT'];

        //insert stats
        $app['db']->insert('stats', [
          'browser' => $b,
          'url' => $res['url'],
        ]);

           return $app->redirect($res['url']);
       }
   }
 });

 return $app;
