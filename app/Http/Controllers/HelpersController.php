<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HelpersController extends Controller
{
    public function searchRoute(Request $request)
    {
        // Get all registered routes
        $searchTerm = $request->input('search');

        // Search for routes based on the search term
        $routes = Route::getRoutes()->getRoutesByName();

        $filteredRoutes = collect($routes)->filter(function ($route) use ($searchTerm) {
            return strpos($route->uri(), $searchTerm) !== false || strpos($route->getName(), $searchTerm) !== false;
        })->map(function ($route) {
            return [
                'name' => $route->getName(),
                'uri' => $route->uri(),
            ];
        });

        return response()->json(['routeList' => $filteredRoutes]);
    }
}
