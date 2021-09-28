<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class DestinosCliente
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
    public function GetDestinosCliente($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // TODO implement the resolver
       
        $DestinosCliente = DB::table('dbo.WebGuiasCliente')->orderBy('IdCliente', 'DESC')
            ->get();
        foreach ($DestinosCliente as $DestinosClientes) {
            # code...
            $DestinosClientes->Clientes=DB::table('dbo.vWebClientes')->where('IdCliente', $DestinosClientes->IdDestino)->get();
        }

        return $DestinosCliente;
        
    }
    
}
