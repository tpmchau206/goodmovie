<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function handle(Request $request, Closure $next)
    {
        $id = session('id');
        $check = $this->user->getUser($id);
        // dd(session()->all());
        if (!empty($id)) {
            # code...
            if ($check[0]->group_id == 1) {
                # code...
                // dd($check[0]->group_id);
                return $next($request);
            }
            abort(404);
        }
        return redirect()->route('index.home');
    }
}
