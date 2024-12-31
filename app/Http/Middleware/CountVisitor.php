<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class CountVisitor
{
  public function handle(Request $request, Closure $next)
  {
      $ip = $request->ip();//hash('sha512', $request->ip());
      if (Visitor::whereDate('created_at', today())->where('ip', $ip)->where('type', '1')->count() < 1)
      {
          Visitor::create([
              'created_at' => today(),
              'ip' => $ip,
              'type' => 1,
          ]);
      }
      return $next($request);
  }
}
