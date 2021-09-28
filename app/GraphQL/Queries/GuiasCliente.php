<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class GuiasCliente
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
    public function GetGuiasCliente($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // TODO implement the resolver
       
        $GuiasCliente = DB::table('dbo.WebGuiasCliente')->orderBy('idServicio', 'DESC')
            ->where('IdServicio','LIKE','%'.$args['IdServicio'].'%')
            ->paginate($perPage = $args['number_paginate'], $columns = ['*'], $pageName = 'page', $page = $args['page']);
        foreach ($GuiasCliente as $GuiasClientes) {
            # code...
            $GuiasClientes->GuiasTrack=DB::table('dbo.WebGuiasTrack')->where('IdGuiaR', $GuiasClientes->IdGuiaR)->get();
            $GuiasClientes->ClientesDestinos=DB::table('dbo.vWebClientesDestinos')->where('IdDestino', $GuiasClientes->IdDestino)->first();
            $GuiasClientes->ClientesDestinos->Clientes=DB::table('dbo.vWebClientes')->where('IdCliente', $GuiasClientes->ClientesDestinos->IdDestino)->get();
            $GuiasClientes->Clientes=DB::table('dbo.vWebClientes')->where('IdCliente', $GuiasClientes->IdCliente)->first();
            
        }

        return ['nroTotal_items'=>$GuiasCliente->total(),'data'=>$GuiasCliente];
        
    }
    public function GetSerieGuiasCliente($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // TODO implement the resolver
        $GuiasClientes = DB::table('dbo.WebGuiasCliente')
            ->where('IdGuiaR',$args['IdGuiaR'])
            ->first();
        $GuiasClientes->GuiasTrack=DB::table('dbo.WebGuiasTrack')->where('IdGuiaR', $GuiasClientes->IdGuiaR)->get();
        $GuiasClientes->ClientesDestinos=DB::table('dbo.vWebClientesDestinos')->where('IdDestino', $GuiasClientes->IdDestino)->first();
        $GuiasClientes->ClientesDestinos->Clientes=DB::table('dbo.vWebClientes')->where('IdCliente', $GuiasClientes->ClientesDestinos->IdDestino)->get();
        $GuiasClientes->Clientes=DB::table('dbo.vWebClientes')->where('IdCliente', $GuiasClientes->IdCliente)->first();
        return $GuiasClientes;
        
    }
}
