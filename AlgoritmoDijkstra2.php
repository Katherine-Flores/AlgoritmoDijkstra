<?php

// Función para encontrar el vértice con la distancia mínima
function minimaDistancia($distancia, $visitados, $V) {
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
function imprimirCamino($padres, $destino) {
    if ($padres[$destino] == -1) {
        echo "No hay camino hacia el destino";
        return;
    }

    $camino = array();
    $vertice = $destino;
    while ($vertice != -1) {
        array_unshift($camino, $vertice);
        $vertice = $padres[$vertice];
    }

    echo "El camino más corto desde el origen hasta el destino es: ";
    echo implode(" -> ", $camino);
}

// Función principal que implementa el algoritmo de Dijkstra
function dijkstra($grafo, $origen, $destino, $V) {
    $distancia = array_fill(0, $V, INF); // Arreglo para almacenar las distancias más cortas desde el origen
    $visitados = array_fill(0, $V, false); // Arreglo para marcar los nodos visitados
    $padres = array_fill(0, $V, -1); // Arreglo para almacenar los padres de cada vértice en el camino más corto
    $distancia[$origen] = 0; // La distancia del origen a sí mismo es 0

    // Encontramos el camino más corto para todos los vértices
    for ($contador = 0; $contador < $V - 1; $contador++) {
        $u = minimaDistancia($distancia, $visitados, $V); // Elegir el vértice con la distancia mínima desde los vértices no visitados
        $visitados[$u] = true; // Marcar el vértice como visitado

        // Actualizamos las distancias de los vértices adyacentes del vértice seleccionado
        for ($v = 0; $v < $V; $v++) {
            if (!$visitados[$v] && $grafo[$u][$v] && $distancia[$u] != INF && $distancia[$u] + $grafo[$u][$v] < $distancia[$v]) {
                $distancia[$v] = $distancia[$u] + $grafo[$u][$v];
                $padres[$v] = $u; // Actualizamos el padre del vértice $v en el camino más corto
            }
        }
    }

    // Imprimimos el camino más corto desde el origen hasta el destino
    imprimirCamino($padres, $destino);
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

$origen = 0; // Vértice de origen
$destino = 3; // Vértice de destino
$V = count($grafo);

dijkstra($grafo, $origen, $destino, $V);