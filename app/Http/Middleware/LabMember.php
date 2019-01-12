<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class LabMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user->is_member && !\Laratrust::can('lab-member.bypass')) {
            return back()->with('warning', '限實驗室成員進入');
        }

        return $next($request);
    }
}
