<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PdfContentType
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->is('topic/*/*.pdf')) {
            $response->header('Content-Type', 'application/pdf')
                     ->header('Content-Disposition', 'inline');
        }

        return $response;
    }
}
