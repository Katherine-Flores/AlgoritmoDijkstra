<?php

// Función para encontrar el vértice con la distancia mínima
function distanciaMinima($distancia, $visitados, $V) {
    $minimo = INF;
    $indice_minimo = -1;

    for ($v = 0; $v < $V; $v++) {
        if ($visitados[$v] == false && $distancia[$v] <= $minimo) {
            $minimo = $distancia[$v];
            $indice_minimo = $v;
        }
    }

    return $indice_minimo;
}

// Función para imprimir el camino más corto desde el origen a cada nodo
function imprimirSolucion($origen, $distancia, $V) {
    echo "Origen \t  Final \t Distancia\n";
    for ($i = 0; $i < $V; $i++) {
        echo $origen . "\t\t\t" . $i . " \t\t\t " . $distancia[$i] . "\n";
    }
}

// Función principal que implementa el algoritmo de Dijkstra
function dijkstra($grafo, $origen, $V) {
    $distancia = array_fill(0, $V, INF); // Arreglo para almacenar las distancias más cortas desde el origen
    $visitados = array_fill(0, $V, false); // Arreglo para marcar los nodos visitados
    $distancia[$origen] = 0; // La distancia del origen a sí mismo es 0

    // Encontramos el camino más corto para todos los vértices
    for ($contador = 0; $contador < $V - 1; $contador++) {
        $u = distanciaMinima($distancia, $visitados, $V); // Elegimos el vértice con la distancia mínima desde los vértices no visitados
        $visitados[$u] = true; // Marcamos el vértice como visitado

        // Actualizamos las distancias de los vértices adyacentes del vértice seleccionado
        for ($v = 0; $v < $V; $v++) {
            if (!$visitados[$v] && $grafo[$u][$v] && $distancia[$u] != INF && $distancia[$u] + $grafo[$u][$v] < $distancia[$v]) {
                $distancia[$v] = $distancia[$u] + $grafo[$u][$v];
            }
        }
    }

    // Imprimir las distancias más cortas
    imprimirSolucion($origen, $distancia, $V);
}

// Ejemplos de uso
$grafo = array(
    array(0, 2, 4, 0),
    array(2, 0, 5, 1),
    array(4, 5, 0, 3),
    array(0, 1, 3, 0)
);

$grafo2 = array(
    array(0, 0, 0, 0, 0, 0),
    array(4, 0, 0, 0, 0, 0),
    array(0, 6, 0, 0, 0, 0),
    array(0, 0, 5, 0, 3, 0),
    array(7, 1, 0, 0, 0, 0),
    array(0, 0, 0, 2, 0, 0)
);

$V = count($grafo);

dijkstra($grafo, 0, $V);