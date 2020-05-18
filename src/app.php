<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

//$routes->add('hello', new Routing\Route('/hello/{name}', [
//    'name' => 'World',
//    '_controller' => function ($request) {
//        // $foo will be available in the template
//        $request->attributes->set('foo', 'bar');
//
//        $response = render_template($request);
//
//        // change some header
//        $response->headers->set('Content-Type', 'text/plain');
//
//        return $response;
//    }
//]));

function is_leap_year($year = null) {
    if (null === $year) {
        $year = date('Y');
    }

    return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
}

class LeapYearController
{
    public function index($request)
    {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
}

$routes = new Routing\RouteCollection();
$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => [new LeapYearController(), 'index'],
]));

return $routes;