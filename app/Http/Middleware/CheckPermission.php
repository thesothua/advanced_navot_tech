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

            // abort(403, 'You don’t have permission to access this action.');


          return response("
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Access Denied</title>
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-box {
            text-align: center;
            padding: 40px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        .error-icon {
            font-size: 80px;
            color: #dc3545;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 15px;
        }
        p {
            font-size: 16px;
            color: #666;
            margin-bottom: 25px;
        }
        a.btn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            background: #dc3545;
            color: white;
            border-radius: 30px;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        a.btn:hover {
            background: #b02a37;
        }
    </style>
</head>
<body>
    <div class='error-box'>
        <div class='error-icon'>🚫</div>
        <h1>Access Denied</h1>
        <p>You don’t have permission to access this action.<br> Please contact your administrator 🔒</p>
        <a href='javascript:history.back()' class='btn'>⬅ Go Back</a>
    </div>
</body>
</html>
", 403)->header('Content-Type', 'text/html');

            // return redirect()->route('admin.no-permission');
        }

        return $next($request);
    }
}
