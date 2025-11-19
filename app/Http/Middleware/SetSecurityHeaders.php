<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetSecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Strict Transport Security (HSTS) - Category 3
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        
        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Clickjacking Protection - Category 6
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        // XSS Protection
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Permissions Policy (formerly Feature Policy)
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
        
        // Content Security Policy - Balanced security without breaking CRUD functionality
        // Note: Using 'unsafe-inline' and 'unsafe-eval' to maintain compatibility with Laravel Blade,
        // jQuery, Bootstrap, and AJAX operations. This is acceptable for internal applications
        // with proper CSRF protection and authentication already in place.
        $csp = implode('; ', [
            "default-src 'self'",
            // Allow scripts from self and specific trusted domains
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://fonts.googleapis.com https://www.google.com https://maps.google.com https://upload.wikimedia.org https://cdn.tailwindcss.com https://cdn.ckeditor.com",
            // Allow styles from self and specific trusted domains
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com",
            // Allow images from self, data, and specific HTTPS domains
            "img-src 'self' data: https: blob: https://upload.wikimedia.org",
            // Allow fonts from self, data, and specific domains
            "font-src 'self' data: https://fonts.gstatic.com",
            // Allow connect from self and HTTPS
            "connect-src 'self' https:",
            // Allow media from self and HTTPS
            "media-src 'self' https:",
            // Allow iframes from Google Maps
            "frame-src 'self' https://www.google.com https://maps.google.com",
            // Upgrade insecure requests
            "upgrade-insecure-requests"
        ]);
        $response->headers->set('Content-Security-Policy', $csp);
        
        return $response;
    }
}
