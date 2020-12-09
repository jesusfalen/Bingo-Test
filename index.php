<?php

function generarBingo(){
    $carton = array();

    //For para crear los numero aleatorios que tendra nuestro bingo
    for ($i=0; $i<5; $i++) {
        //range — Crear un array que contiene un rango de elementos
        $numbers = range($i*15+1, $i*15+15);
        //shuffle Esta función mezcla un array (crea un orden aleatorio de sus elementos)
        shuffle($numbers);
        //array_slice — Extraer una parte de un array
        $carton[$i] = array_slice($numbers, 0, 5);
    }

    //Cabecera de la tabla
    $s = "<tr><th>B</th><th>I</th><th>N</th><th>G</th><th>O</th></tr>";

    //Doble for de 5x5 para crear nuestra tabla de bingo aleatoria
    for ($j=0; $j<5; $j++){
        $s .= "<tr>";
        for ($k=0; $k<5; $k++){
            //printf — Devuelve un string formateado
            $s .= ($j==2 && $k==2)? "<td></td>": sprintf("<td>%s</td>",$carton[$k][$j]);
        }
        $s .= "</tr>";
    }
    return $s;//retorno de la tabla html
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>BINGO </title>
</head>
<style>
	td, th {
		width: 50px;
		border: 1px solid #ccc;
		text-align: center;
	}
    body{
        text-align: center;
    }
    #number{
        font-size: 75px;
        font-weight: bold;
    }
</style>
<body>
	<button>Generar Numero aleatorio</button>
	<div id="number"></div>
	<h1>Lista de resultados</h1>
	<div id="result"></div>
    <hr>
    <center>
	<table>
		<div id="sheet">
			<?php echo generarBingo();?>
		</div>
	</table>
    </center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

$(function(){

	max = 75;
	bingo = new Array();
	for(i = 1; i <= max; i++) {
		bingo.push(i);
	}
	status = 0;
    $("#number").text('0');
	$("button").click(function(){
		if(status == 0) {
			status = 1;
			$("button").text("Stop");
			roulette = setInterval(function(){
                // Math.floo Devuelve el máximo entero menor o igual a un número.
				random = Math.floor(Math.random() * bingo.length);
				number = bingo[random];
				//pintamos pero ya que esta en el setInterval solo
                //finje la visualizacion de un recorrido de numero
				$("#number").text(number);
			}, 75);
		} else {
			status = 0;
			$("button").text("Start");
			clearInterval(roulette);
			random = Math.floor(Math.random() * bingo.length);
            result = bingo[random];
            if(result == undefined){
                //Pintar mensaje cuando termine los 75 numero
                $("#number").text('Numero terminados');
            }else{
                //Splice quitamos el valor del array para no repetir
                bingo.splice(random, 1);
                //Pintar en el texto el numero aletorio
                $("#number").text(result);
                //Adicionar en la lista de resultados
                $("#result").append(result + ", ");
            }


		}
	});
});
</script>


</body>
</html>