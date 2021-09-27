<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Image;
use Hash;
use App\Services\JWTServices;
use Firebase\JWT\JWT;
use JWTAuth;
use App\Exceptions\CustomException;
class AuthMutator
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
   
    public function auth($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        @$user=DB::table('dbo.WebUsuarios')->where('NmUsuario',$args['NmUsuario'])->first();
        if(isset($user->IdUsuario)==true){
            
            if ($user->Password==$args['Password']) {
                
                $payload = array(
                    "iss" => $args['NmUsuario'],
                    "aud" => $args['Password'],
                    "nbf" => $user->IdUsuario
                );
                $token = JWT::encode($payload, env('KEY_FIREBASE'));
                DB::table('dbo.WebUsuarios')->where('IdUsuario',$user->IdUsuario)->update(['apiToken' => $token]);
                $usuario=DB::table('dbo.WebUsuarios')->where('IdUsuario',$user->IdUsuario)->first();
                return $usuario;
            }
            else{
                throw new \Exception('CONTRASEÑA_INCORRECTA');
            }
        }
        else{
            throw new \Exception('NO_EXISTE');
        }
    }
    
}
