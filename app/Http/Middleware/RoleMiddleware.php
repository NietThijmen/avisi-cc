<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\Role;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if(config('app.debug')) {
            return $next($request);
        }

        $roles = $this->getRoles($roles);

        $user = $request->user('web');

        if (is_null($user) || !in_array($user->role, $roles)) {
            abort(401);
        }

        return $next($request);
    }

    public function getRoles(array $roles)
    {
        return array_map($this->getRole(...), $roles);
    }

    public function getRole(string $name): Role
    {
        if (! defined($qualified = Role::class.'::'.ucfirst($name)))
            throw new \Exception(sprintf("Enum [%s] does not have case \"%s\"",
                Role::class, ucfirst($name),
            ));

        return constant($qualified);
    }
}
