<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
//        if (Str::contains($request->getRequestUri(), 'api/') && Str::contains($request->getRequestUri(), 'api/project/')) {
//            return $next($request);
//        }
//
//        if (! Str::contains($request->getRequestUri(), 'api/') && ! Str::contains($request->getRequestUri(), 'api/company/')) {
//            return $next($request);
//        }
//
//        if (! $request->request->get(Company::EXTRA_COL_USER_ID) || ! $user = User::find($request->request->get(Company::EXTRA_COL_USER_ID))) {
//            throw new \Exception('Invalid argument');
//        }

        return $next($request);
    }
}
