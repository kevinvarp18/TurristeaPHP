<?php

/**
 * Método distancia euclidiana el cuál permite calcular la distancia entre dos
 * vectores para así a partir de ciertos criterios lograr  obtener un similitudes y 
 * diferencias entre personas o cosas. 
 * @param type $vectorA: Valores ingresados por el usuario.
 * @param type $registrosBaseDatos: Registros de la base de datos.
 * @param type $variables: Variables a evaluar para cada uno de los elementos de los
 * arreglos
 * @return type $clase: Se retorna la clase para la cual se obtuvo mejor aproximación
 * o menor distancia entre los puntos con respecto a los datos ingresados por el 
 * usuario
 */
function euclides($vectorA, $registrosBaseDatos, $variables) {
    //Distancia mínima
    $diferenciaMin = array();
    $diferenciaMin[0] = null;
    $diferenciaMin[1] = null;
    $diferenciaMin[2] = null;
    $diferenciaMin[3] = null;
    $diferenciaMin[4] = null;
    //Clase obtenida (clasificación) según distancia mínima
    $clase = "";
    $cont = (int)-1;
    $contSitios = 0;
    $sitios = array();
    //Se comparan cada uno de los elementos del vectorA contra los registros de la
    //base de datos con el propósito de encontrar un vectorB (formado a partir de una
    //tupla de la base de datos) que permita obtener una distancia mínima entre ambos
    //vectores A y B
    for ($i = 0; $i <= 4; $i++) {

        foreach ($registrosBaseDatos as $registroActual) {
            $vectorB = array();
            //Se forma el vectorB
            foreach ($variables as $variableActual) {
                $vectorB[$variableActual] = $registroActual[$variableActual];
            }
            $diferencia = 0;
            //Se lleva a cabo la sumatoria de las diferencias ((Bi - Ai)^2) entre cada uno de los puntos de 
            //los vectores A y B
            foreach ($variables as $variableActual) {
                $diferencia += pow(($vectorB[$variableActual] - $vectorA[$variableActual]), 2);
            }
            //Se obtiene la raiz cuadrada de las diferencias obtenidas
            $diferencia = sqrt($diferencia);
            //Si la diferencia obtenida para los valores del vectorB  para la tupla en 
            //evaluación es menor a los se han guardado anteriormente se guarda la nueva
            //diferencia así como la clase que clasifica los datos de dicha tupla
            if ($cont >= 0) {
                    if ($diferenciaMin[$i] === null) {
                        $diferenciaMin[$i] = $diferencia;
                        $clase = $registroActual['clase'];
                        $sitios[$contSitios] = $registroActual;
                    } else if ($diferenciaMin[$i] > $diferencia && $diferenciaMin[$i-1]<$diferencia) {
                        $diferenciaMin[$i] = $diferencia;
                        $clase = $registroActual['clase'];
                        $sitios[$contSitios] = $registroActual;
                    }
            } else {

                if ($diferenciaMin[$i] === null) {
                    $diferenciaMin[$i] = $diferencia;
                    $clase = $registroActual['clase'];
                    $sitios[$contSitios] = $registroActual;
                } else if ($diferenciaMin[$i] > $diferencia) {
                        $diferenciaMin[$i] = $diferencia;
                        $clase = $registroActual['clase'];
                        $sitios[$contSitios] = $registroActual;
                }//if-else
            }//primer registro
        }//for de resgistros
        $cont++;
        $contSitios++;
    }//end for de diferencias
    //Se retorna la clase obtenida
    return $sitios;
}
