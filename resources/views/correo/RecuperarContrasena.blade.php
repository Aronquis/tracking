<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<style>
	.container {
		width:996px;
		margin:0px auto;
		font-size:12px;
	}
	section{
		padding: 10px;
		background:#AFEFF2;
		-moz-border-radius:5px;-webkit-border-radius:5px;-o-border-radius:5px;border-radius:5px;
	}
	section {
		float: left;
		width: 45%;
	}
	
	/* para 980px o menos */
	@media screen and (max-width:980px) {
		.container {
			width:98%;
		}
		section {
			width:68%;
		}
	}
 
	/* para 700px o menos */
	@media screen and (max-width:700px) {
		section {
			float:none;
			width:96%;
		}
		section {
			font-size:10px;
		}
		
	}
 
	/* para 480px o menos */
	@media screen and (max-width:480px) {
		
		section {
			font-size:10px;
		}
		section {
			width:94%;
		}
	}
    
       p {
		font-size:medium  ;
        text-align: justify;
        text-justify: inter-word;
        }
	</style>
 
</head>
 
<body>
 
<div class="container">
	

	<section>
    <table width="45%" class="image"> 
        
        
    </table>
    
	<table width="100%">
		<tr>
		  
		  <td width="100%" align="left" ><h2>RECUPERAR CONTRASEÑA!</h2></td>
		  
		</tr>
		<tr>
		  
		  <td width="100%" align="left" ><h2>Hola:</h2> <p>{{@$user->nombre}}</p></td>
		  
		</tr>
		<tr>
		  
		  <td width="100%" align="left" ><h2>Su nueva contraseña es :</h2><p> {{@$password}}</p></td>
		  
		</tr>
		
	</table>
	
	</section>

</div>
</body>
</html>