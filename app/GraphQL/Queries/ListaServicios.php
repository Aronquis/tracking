<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class ListaServicios
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
    public function GetListaServicios($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // TODO implement the resolver
       
        $ListaServicios = DB::table('dbo.vWebListaServicios')->orderBy('idServicio', 'DESC')
                ->where('IdChofer','LIKE','%'.$args['IdChofer'].'%')
                ->paginate($perPage = $args['number_paginate'], $columns = ['*'], $pageName = 'page', $page = $args['page']);
        return ['nroTotal_items'=>$ListaServicios->total(),'data'=>$ListaServicios];
        
    }
    
}
