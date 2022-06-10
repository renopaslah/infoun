<?php

namespace App\Http\Middleware;

use \App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use function Psy\debug;

class RoleForController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, int $controller_id, string $mode = 'readonly')
    {
        $role_id = Hashids::decode(session()->get('current_role')['id']);
        $data = Role::find($role_id[0])->xcontrollers();
        $data->where('xcontroller_id', $controller_id);

        if($mode == 'readonly'){ 
            $data->where('is_can_modify', '>=', 0);
        }else if($mode == 'modify'){
            $data->where('is_can_modify', 1);
        }else{
            $data->where('is_can_modify', 0);
        }

        if(!$data->get()->isEmpty()){
            return $next($request);
        }else{
            abort(403, 'Unauthorized action.');
        }
        
    }
}
