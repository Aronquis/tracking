<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
class CrudGuiasCliente
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
    public function Create($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $nameCreate="";
        if(isset($args['ImagenGuia'])==true){
            $image = $args['ImagenGuia'];
            $arrNameFile = explode(".", $image->getClientOriginalName());
            $extension = $arrNameFile[sizeof($arrNameFile) - 1];
            $fileName = str_replace(["(",")",' '],'',$arrNameFile[0]);
            //////////////////////////////7777
            
        
            $nameCreate =$fileName. '.' .$extension;
            $image->storeAs('ImagenGuia/'.date("Y").'-'.date("m"), $nameCreate, 'local');
        }
        $id=DB::table('dbo.vWebListaGuias')->insertGetId([
            #'IdGuiaR'=>$args['IdGuiaR'],
            'Serie'=>$args['Serie'],
            'Numero'=>$args['Numero'],
            'Fecha'=>$args['Fecha'],
            'Llegada'=>$args['Llegada'],
            'Bultos'=>$args['Bultos'],
            'Peso'=>$args['Peso'],
            'FechaEntrega'=>$args['FechaEntrega'],
            'Coordenadas'=>$args['Coordenadas'],
            'SerieGT'=>$args['SerieGT'],
            'NumeroGT'=>$args['NumeroGT'],
            'IdServicio'=>$args['IdServicio'],
            'IdCliente'=>$args['IdCliente'],
            'IdDestino'=>$args['IdDestino'],
            'ImagenGuia'=>env('APP_URL').'ImagenGuia/'.date("Y").'-'.date("m").$nameCreate,
            'IdEstado'=>$args['IdEstado'],

        ]);
        $listaGuias=DB::table('dbo.vWebListaGuias')->where('IdGuiaR',$id)->first();
        return $listaGuias;
    }
    public function Update($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if(isset($args['ImagenGuia'])==true){
            $image = $args['ImagenGuia'];
            $arrNameFile = explode(".", $image->getClientOriginalName());
            $extension = $arrNameFile[sizeof($arrNameFile) - 1];
            $fileName = str_replace(["(",")",' '],'',$arrNameFile[0]);
            //////////////////////////////7777
            
        
            $nameCreate =$fileName. '.' .$extension;
            $image->storeAs('ImagenGuia/'.date("Y").'-'.date("m"), $nameCreate, 'local');
            DB::table('dbo.vWebListaGuias')->where('ImagenGuia',$args['ImagenGuia'])->update(['ImagenGuia'=>$nameCreate]);
        }
        DB::table('dbo.vWebListaGuias')->where('IdGuiaR',$args['IdGuiaR'])->update([
            'Serie'=>$args['Serie'],
            'Numero'=>$args['Numero'],
            'Fecha'=>$args['Fecha'],
            'Llegada'=>$args['Llegada'],
            'Bultos'=>$args['Bultos'],
            'Peso'=>$args['Peso'],
            'FechaEntrega'=>$args['FechaEntrega'],
            'Coordenadas'=>$args['Coordenadas'],
            'SerieGT'=>$args['SerieGT'],
            'NumeroGT'=>$args['NumeroGT'],
            'IdServicio'=>$args['IdServicio'],
            'IdCliente'=>$args['IdCliente'],
            'IdDestino'=>$args['IdDestino'],
            'IdEstado'=>$args['IdEstado'],
        ]);
        $listaGuias=DB::table('dbo.vWebListaGuias')->where('IdGuiaR',$args['IdGuiaR'])->first();
        return $listaGuias;
    }
    public function Delete($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $listaGuias=DB::table('dbo.vWebListaGuias')->where('IdGuiaR',$args['IdGuiaR'])->first();
        if(isset($listaGuias->IdGuiaR)==false){
            throw new \Exception('NO_EXISTE');
        }
        else{
            DB::table('dbo.vWebListaGuias')->where('IdGuiaR',$args['IdGuiaR'])->delete();
            return "se elimino correctamente";
        }
    
    }
}
