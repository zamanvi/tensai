<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttpsHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Content-Security-Policy', 'upgrade-insecure-requests');

        // Rewrite any http:// app URLs in HTML responses directly
        $contentType = $response->headers->get('Content-Type', '');
        if (str_contains($contentType, 'text/html') && method_exists($response, 'getContent')) {
            $appUrl = config('app.url');
            $httpUrl = str_replace('https://', 'http://', $appUrl);
            $content = $response->getContent();
            if ($content && $httpUrl !== $appUrl && str_contains($content, $httpUrl)) {
                $response->setContent(str_replace($httpUrl, $appUrl, $content));
            }
        }

        return $response;
    }
}
