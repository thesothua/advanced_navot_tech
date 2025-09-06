<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, $permission)
    {
        if (! canSuperAdminOr($permission)) {

            abort(403, 'You don’t have permission to access this action.');

            // return redirect()->route('admin.no-permission');
        }

        return $next($request);
    }
}
