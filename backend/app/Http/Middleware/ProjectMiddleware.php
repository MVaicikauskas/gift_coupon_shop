<?php

namespace App\Http\Middleware;

use App\Models\Order;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ProjectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Str::contains($request->getRequestUri(), 'api/') && Str::contains($request->getRequestUri(), 'api/company/')) {
            return $next($request);
        }

        if (! Str::contains($request->getRequestUri(), 'api/') && ! Str::contains($request->getRequestUri(), 'api/project/')) {
            return $next($request);
        }

        if (! $request->request->get(Order::EXTRA_COL_PROJECT_ID) || ! $project = Project::find($request->request->get(Order::EXTRA_COL_PROJECT_ID))) {
            throw new \Exception('Invalid argument');
        }

        if (! $project->{Project::COL_IS_ACTIVE}) {
            throw new \Exception('Project is inactive');
        }

        return $next($request);
    }
}
