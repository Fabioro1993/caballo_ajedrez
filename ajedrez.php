<?php
$min=1; // movimiento disponible inicial, para el numero aleatorio para la funcion makeMovement
$max=8; // movimiento disponible final, para el numero aleatorio para la funcion makeMovement
$maxPosicion = 16; // maximo numero de casillas en el tablero

// comenzar el juego
start();

// funcion que inicia el movimiento de los caballos
function start() {
	global $min, $max, $maxPosicion;
  // inicializar los caballos en cada posicion
	$caballo_negro = ['x' => 1, 'y' => 1];
	$caballo_blanco = ['x' => $maxPosicion, 'y' => $maxPosicion];

	$json = [];
	$turno = 1;
	$termino = false;

  // se ejecuta el codigo hasta que uno de los caballos se cancele
	while (!$termino) {
    if ($turno == 1) {
      $turno--;
      $result = jugada($caballo_negro, rand($min,$max));
      $caballo_negro = $result;
      array_push($json, ['Pieza' => 'C', 'Color' => 'N', 'Posicion_X' => $result['x'], 'Posicion_Y' => $result['y'],]);
    } else {
      $turno++;
      $result = jugada($caballo_blanco, rand($min,$max));
      $caballo_blanco = $result;
      array_push($json, ['Pieza' => 'C', 'Color' => 'B', 'Posicion_X' => $result['x'], 'Posicion_Y' => $result['y'],]);
    }
		if ($caballo_negro['x'] == $caballo_blanco['x'] && $caballo_negro['y'] == $caballo_blanco['y']) {
      $termino = true;
    }
	}
  echo 'termino <pre>'; print_r($json); echo '</pre>';
}

// funcion que obtiene un movimiento disponible en el tablero para cada caballo
function jugada($caballo, $movement) {
	global $min, $max, $maxPosicion;
	$result = makeMovement($caballo, $movement);
	if ($result['x'] > 0 && $result['x'] <= $maxPosicion
		&& $result['y'] > 0 && $result['y'] <= $maxPosicion) {
		return $result;
	} else {
		return jugada($caballo, rand($min,$max));
	}
}

// moviminetos disponibles para cada caballo segun su posicion
function makeMovement($caballo, $movement) {
  // Movimientos
  switch ($movement) {
    case 1:// x + 1 | y + 2
      $caballo['x'] += 1;
      $caballo['y'] += 2;
      break;
    case 2:// x + 2 | y + 1
      $caballo['x'] += 2;
      $caballo['y'] += 1;
      break;
    case 3:// x + 2 | y - 1
      $caballo['x'] += 2;
      $caballo['y'] -= 1;
      break;
    case 4:// x + 1 | y - 2
      $caballo['x'] += 1;
      $caballo['y'] -= 2;
      break;

    case 5:// x - 1 | y - 2
      $caballo['x'] -= 1;
      $caballo['y'] -= 2;
      break;
    case 6:// x - 2 | y - 1
      $caballo['x'] -= 2;
      $caballo['y'] -= 1;
      break;
    case 7:// x - 2 | y + 1
      $caballo['x'] -= 2;
      $caballo['y'] += 1;
      break;
    case 8:// x - 1 | y + 2
      $caballo['x'] -= 1;
      $caballo['y'] += 2;
      break;
	}
	return $caballo;
}

?>