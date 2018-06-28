<?php
    class Bayes {

        // ***************************** ATRIBUTOS *****************************

        private $n;
        private $nc;
        private $valoresPorCaracteristica;
        private $p;
        private $p_priori;
        private $m;
        private $p1;
        private $p2;
        private $registros;
        private $registroUsuario;
        private $clases;
        private $frecuencias;
        private $productoFrecuencias;
        private $p_total;

        // **************************** CONSTRUCTOR ****************************

        function Bayes($m, $p1, $p2, $n, $priori, $ubicaciones, $precios) {
            $this->n = $n;
            $this->nc = array();
            $this->valoresPorCaracteristica = array();
            $this->p = array();
            $this->p_priori = $priori;
            $this->m = $m;
            $this->p1 = $p1;
            $this->p2 = $p2;
            $this->frecuencias = array();
            $this->productoFrecuencias = array();
            $this->p_total = array();
        }//Fin del constructor.
        
        // ***************************** FUNCIONES *****************************
        
        function calcularBayes(){
            $this->calcularVariablesBayes();
            $posicionResultado = 0;
            $valorMayor = -1000;
            for($i = 0; $i < count($this->n); $i++){
                if($valorMayor < $this->p_total[$i]){
                    $valorMayor = $this->p_total[$i];
                    $posicionResultado = $i;
                }/* Fin del if que verifica cual es la probabilidad más alta y a
                    que clase pertenece. */
            }//Fin del for $i que recorre todas las probabilidades.
            return $posicionResultado;
        }/* Fin de la función calcularBayes que realiza todos los cálculos necesarios
        con los registros de la BD y el que ingresó el usuario. Una vez obtenidos
        todos los datos, verifica cual es la probabilidad más alta para determinar
        la clase y retorna el dato al respectivo controlador. */

        private function calcularVariablesBayes(){
            $this->calcular_n();
            $this->calcular_p_priori();
            $this->calcular_p();
            $this->calcular_nc();
            $this->calcularFrecuencias();
            $this->calcularProductoriaFrecuencias();
            $this->calcularP_Total();
        }/* Fin de la función calcularVariablesBayes que realiza el cálculo de todas
        las variables que se necesitan para hacer Bayes. */
        
        private function calcular_n(){
            for($i = 0; $i < count($this->clases); $i++){
                $contador = 0;
                foreach($this->registros as $registro){
                    switch($this->tipoCalculo){
                        case 2: {
                            if(strcmp($registro->getRecinto(), $this->clases[$i]) === 0){
                                $contador++;
                            }/* Fin del if que verifica si ambas clases son iguales 
                                para aumentar el contador. */
                        }//Fin del case 2.
                        break;
                        case 3: {
                            if(strcmp($registro->getSexo(), $this->clases[$i]) === 0){
                                $contador++;
                            }/* Fin del if que verifica si ambas clases son iguales 
                                para aumentar el contador. */
                        }//Fin del case 3.
                        break;
                        default: {
                            if(strcmp($registro->getClase(), $this->clases[$i]) === 0){
                                $contador++;
                            }/* Fin del if que verifica si ambas clases son iguales 
                                para aumentar el contador. */
                        }//Fin del case 1.
                        break;
                    }/* Fin del switch que determina cual es la clase que se está 
                        calculando (estilo de aprendizaje, sexo, tipo de profesor,
                        recinto o tipo de red). */
                }/* Fin del foreach que recorre todos los registros que se trajeron 
                    de la base de datos. */
                array_push($this->n, $contador);
            }//Fin del for $i que itera dependiendo del número de clases que existen.
            return $contador;
        }/* Fin de la función calcular_n que determina el número de instancias de
        cada clase, de los registros almacenados en la base de datos. */
        
        private function calcular_p_priori(){
            for($i = 0; $i < count($this->n); $i++){
                array_push($this->p_priori, ($this->n[$i]/count($this->registros))); //p priori = Clases/Registros
            }/* Fin del for que itera dependiendo del número de clases que tiene
                ese objeto, para determinar el p_priori, dividiendo el # de clases
                entre el número de registros que se obtuvieron de la base de datos. */
        }//Fin de la función calcular_p_priori.
        
        private function calcular_p(){
            $principalArray = array();
            
            for($i = 0; $i < $this->m; $i++){
                array_push($principalArray, array());
            }/* Fin del for $i que itera dependiendo del valor de m (número de 
                atributos que se toman en cuenta para realizar el cálculo de Bayes). */
            
            foreach ($this->registros as $registro) {
                switch($this->tipoCalculo){
                    case 1: {
                        array_push($principalArray[0], $registro->getRecinto());
                        array_push($principalArray[1], intval($registro->getPromedio()));
                        array_push($principalArray[2], $registro->getSexo());
                    }/* Fin del case 1 que almacena los datos de los atributos de
                        ese registro en el arreglo. (Estudiante) */
                    break;
                    case 2: {
                        array_push($principalArray[0], $registro->getClase());
                        array_push($principalArray[1], intval($registro->getPromedio()));
                        array_push($principalArray[2], $registro->getSexo());
                    }/* Fin del case 2 que almacena los datos de los atributos de
                        ese registro en el arreglo. (Estudiante) */
                    break;
                    case 3: {
                        array_push($principalArray[0], $registro->getClase());
                        array_push($principalArray[1], intval($registro->getPromedio()));
                        array_push($principalArray[2], $registro->getRecinto());
                    }/* Fin del case 3 que almacena los datos de los atributos de
                        ese registro en el arreglo. (Estudiante) */
                    break;
                    case 4: {
                        array_push($principalArray[0], $registro->getConfiabilidad());
                        array_push($principalArray[1], $registro->getNumeroEnlaces());
                        array_push($principalArray[2], $registro->getCapacidad());
                        array_push($principalArray[3], $registro->getCosto());
                    }/* Fin del case 4 que almacena los datos de los atributos de
                        ese registro en el arreglo. (Red) */
                    break;
                    case 5:{
                        array_push($principalArray[0], $registro->getEC());
                        array_push($principalArray[1], $registro->getOR());
                        array_push($principalArray[2], $registro->getCA());
                        array_push($principalArray[3], $registro->getEA());
                    }/* Fin del case 5 que almacena los datos de los atributos de
                        ese registro en el arreglo. (Estilo de Aprendizaje) */
                    break;
                    case 6:{
                        array_push($principalArray[0], $registro->getA());
                        array_push($principalArray[1], $registro->getB());
                        array_push($principalArray[2], $registro->getC());
                        array_push($principalArray[3], $registro->getD());
                        array_push($principalArray[4], $registro->getE());
                        array_push($principalArray[5], $registro->getF());
                        array_push($principalArray[6], $registro->getG());
                        array_push($principalArray[7], $registro->getH());
                    }/* Fin del case 5 que almacena los datos de los atributos de
                        ese registro en el arreglo. (Profesor) */
                    break;
                }/* Fin del switch que determina cual es la clase que se está 
                        calculando (estilo de aprendizaje, sexo, tipo de profesor,
                        recinto o tipo de red). */
            }/* Fin del foreach que recorre todos los registros que se obtuvieron
                de la base de datos. */
            for($i = 0; $i < $this->m; $i++){
                array_push($this->valoresPorCaracteristica, count(array_count_values($principalArray[$i])));
                array_push($this->p, (1/$this->valoresPorCaracteristica[$i]));
            }/* Fin del for $i que itera dependiendo del valor de m (número de 
                atributos que se toman en cuenta para realizar el cálculo de Bayes)
                y calcula en número total de valores diferentes que se tiene en 
                la base de datos por cada atributo que se está tomando en cuenta
                para realizar el cálculo de Bayes, además de calcular la probabilidad
                de cada uno de esos atributos.*/
        }//Fin de la función calcular_p.
        
        private function calcular_nc(){
            for($i = 0; $i < count($this->n); $i++){
                array_push($this->nc, array());
                for($j = 0; $j < $this->m; $j++){
                    array_push($this->nc[$i], 0);
                }/* Fin del for $j que itera dependiendo del número de atributos
                    de la entidad que se toman en cuenta para realizar el cálculo
                    de Bayes. */
                $this->calcular_nc_clase($i, $this->clases[$i]);
            }/* Fin del for $i que iera dependiendo del número de clases que tiene
                esa entidad.*/
        }//Fin de la función calcular_nc.
        
        private function calcular_nc_clase($i, $clase){
            foreach($this->registros as $registro){
                    switch($this->tipoCalculo){
                        case 1: {
                            if(strcmp($registro->getClase(), $clase) === 0){
                                if(strcmp($registro->getRecinto(), $this->registroUsuario->getRecinto()) === 0){
                                    $this->nc[$i][0]++;
                                }/* Si el recinto del registro de la BD coincide
                                    con el recinto ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if(intval($registro->getPromedio()) === intval($this->registroUsuario->getPromedio())){
                                    $this->nc[$i][1]++;
                                }/* Si el promedio del registro de la BD coincide
                                    con el promedio ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if(strcmp($registro->getSexo(), $this->registroUsuario->getSexo()) === 0){
                                    $this->nc[$i][2]++;
                                }/* Si el sexo del registro de la BD coincide
                                    con el sexo ingresado por el usuario, el
                                    contador aumenta en 1. */
                            }/* Fin del if que verifica si coinciden los estilos de
                            aprendizaje de los strings. */
                        }/* Fin del case 1 que determina el número de instancias por
                            cada uno de los atributos para el estudiante. */
                        break;
                        case 2: {
                            if(strcmp($registro->getRecinto(), $clase) === 0){
                                if(strcmp($registro->getClase(), $this->registroUsuario->getClase()) === 0){
                                    $this->nc[$i][0]++;
                                }/* Si el estilo de aprendizaje del registro de 
                                    la BD coincide con el estilo de aprendizaje 
                                    ingresado por el usuario, el contador aumenta
                                    en 1. */
                                if(intval($registro->getPromedio()) === intval($this->registroUsuario->getPromedio())){
                                    $this->nc[$i][1]++;
                                }/* Si el promedio del registro de la BD coincide
                                    con el promedio ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if(strcmp($registro->getSexo(), $this->registroUsuario->getSexo()) === 0){
                                    $this->nc[$i][2]++;
                                }/* Si el sexo del registro de la BD coincide
                                    con el sexo ingresado por el usuario, el
                                    contador aumenta en 1. */
                            }/* Fin del if que verifica si coinciden los recintos
                                de los strings. */
                        }/* Fin del case 2 que determina el número de instancias por
                            cada uno de los atributos para el estudiante. */
                        break;
                        case 3: {
                            if(strcmp($registro->getSexo(), $clase) === 0){
                                if(strcmp($registro->getClase(), $this->registroUsuario->getClase()) === 0){
                                    $this->nc[$i][0]++;
                                }/* Si el estilo de aprendizaje del registro de 
                                    la BD coincide con el estilo de aprendizaje 
                                    ingresado por el usuario, el contador aumenta
                                    en 1. */
                                if(intval($registro->getPromedio()) === intval($this->registroUsuario->getPromedio())){
                                    $this->nc[$i][1]++;
                                }/* Si el promedio del registro de la BD coincide
                                    con el promedio ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if(strcmp($registro->getRecinto(), $this->registroUsuario->getRecinto()) === 0){
                                    $this->nc[$i][2]++;
                                }/* Si el recinto del registro de la BD coincide
                                    con el recinto ingresado por el usuario, el
                                    contador aumenta en 1. */
                            }/* Fin del if que verifica si coinciden los sexos
                                de los strings. */
                        }/* Fin del case 3 que determina el número de instancias por
                            cada uno de los atributos para el estudiante. */
                        break;
                        case 4: {
                            if(strcmp($registro->getClase(), $clase) === 0){
                                if($registro->getConfiabilidad() === $this->registroUsuario->getConfiabilidad()){
                                    $this->nc[$i][0]++;
                                }/* Si la confiabilidad del registro de la BD coincide
                                    con la confiabilidad ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if($registro->getNumeroEnlaces() === $this->registroUsuario->getNumeroEnlaces()){
                                    $this->nc[$i][1]++;
                                }/* Si el # de enlaces del registro de la BD coincide
                                    con el # de enlaces ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if(strcmp($registro->getCapacidad(), $this->registroUsuario->getCapacidad()) === 0){
                                    $this->nc[$i][2]++;
                                }/* Si la capacidad del registro de la BD coincide
                                    con la capacidad ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if(strcmp($registro->getCosto(), $this->registroUsuario->getCosto()) === 0){
                                    $this->nc[$i][3]++;
                                }/* Si el costo del registro de la BD coincide
                                    con el costo ingresado por el usuario, el
                                    contador aumenta en 1. */
                            }/* Fin del if que verifica si coinciden las clases
                                de los strings. */
                        }/* Fin del case 4 que determina el número de instancias por
                            cada uno de los atributos para las redes. */
                        break;
                        case 5: {
                            if(strcmp($registro->getClase(), $clase) === 0){
                                if($registro->getEC() === $this->registroUsuario->getEC()){
                                    $this->nc[$i][0]++;
                                }/* Si el EC del registro de la BD coincide
                                    con el EC ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if($registro->getOR() === $this->registroUsuario->getOR()){
                                    $this->nc[$i][1]++;
                                }/* Si el OR del registro de la BD coincide
                                    con el OR ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if($registro->getCA() === $this->registroUsuario->getCA()){
                                    $this->nc[$i][2]++;
                                }/* Si el CA del registro de la BD coincide
                                    con el CA ingresado por el usuario, el
                                    contador aumenta en 1. */
                                if($registro->getEA() === $this->registroUsuario->getEA()){
                                    $this->nc[$i][3]++;
                                }/* Si el EA del registro de la BD coincide
                                    con el EA ingresado por el usuario, el
                                    contador aumenta en 1. */
                            }/* Fin del if que verifica si coinciden las clases
                                de los strings. */
                        }/* Fin del case 5 que determina el número de instancias por
                            cada uno de los atributos para los estulos de
                            aprendizaje. */
                        break;
                        case 6: {
                            if(strcmp($registro->getClase(), $clase) === 0){
                                if($registro->getA() === $this->registroUsuario->getA()){
                                    $this->nc[$i][0]++;
                                }
                                if(strcmp($registro->getB(), $this->registroUsuario->getB()) === 0){
                                    $this->nc[$i][1]++;
                                }
                                if(strcmp($registro->getC(), $this->registroUsuario->getC()) === 0){
                                    $this->nc[$i][2]++;
                                }
                                if($registro->getD() === $this->registroUsuario->getD()){
                                    $this->nc[$i][3]++;
                                }
                                if(strcmp($registro->getE(), $this->registroUsuario->getE()) === 0){
                                    $this->nc[$i][4]++;
                                }
                                if(strcmp($registro->getF(), $this->registroUsuario->getF()) === 0){
                                    $this->nc[$i][5]++;
                                }
                                if(strcmp($registro->getG(), $this->registroUsuario->getG()) === 0){
                                    $this->nc[$i][6]++;
                                }
                                if(strcmp($registro->getH(), $this->registroUsuario->getH()) === 0){
                                    $this->nc[$i][7]++;
                                }
                            }/* Fin del if que verifica si coinciden las clases
                                de los strings. */
                        }/* Fin del case 6 que determina el número de instancias por
                            cada uno de los atributos para los profesores. */
                        break;
                    }//Fin del switch.
            }/* Fin del foreach que recorre todos los registros obtenidos de la 
                base de datos. */
        }//Fin de la función calcular_nc_clase.
        
        private function calcularFrecuencias(){
            for($i = 0; $i < count($this->n); $i++){
                array_push($this->frecuencias, array());
                for($j = 0; $j < $this->m; $j++){
                    array_push($this->frecuencias[$i], 0);
                    $this->frecuencias[$i][$j] = ($this->nc[$i][$j]+$this->m*$this->p[$j])/($this->n[$i]+$this->m); //(nc+m*p)/(n+m)
                }/* Fin del for $j que itera dependiendo del número de atributos
                    que se están tomando en cuenta para realizar el cálculo de Bayes,
                    el cual lo que hace es utilizar la fórmula de bayes para determinar
                    la frecuencia en que el valor de ese atributo aparece. */
            }/* Fin del for $i que itera dependiendo del número de clases que tiene
                esa entidad */
        }//Fin de la función calcularFrecuencias.
        
        private function calcularProductoriaFrecuencias(){
            for($i = 0; $i < count($this->n); $i++){
                $frecuenciaProductoria = 1;
                for($j = 0; $j < $this->m; $j++){
                    $frecuenciaProductoria *= $this->frecuencias[$i][$j];
                }/* Fin del for $j que itera dependiendo del número de atributos
                    que se están tomando en cuenta para realizar el cálculo de Bayes,
                    el cual lo que hace es hacer una productoria de todas las frecuencias
                    que se tiene por cada uno de los atributos de dicha entidad. */
                array_push($this->productoFrecuencias, $frecuenciaProductoria);
            }/* Fin del for $i que itera dependiendo del número de clases que tiene
                esa entidad */
        }//Fin de la función calcularProductoriaFrecuencias.
        
        private function calcularP_Total(){
            for($i = 0; $i < count($this->n); $i++){
                array_push($this->p_total, $this->productoFrecuencias[$i]*$this->p_priori[$i]);
            }/* Fin del for que itera dependiendo del número de clases que tiene
                esa entidad, para determinar el P_Total, multiplicando el producto
                de todas las frecuencias de los atributos por el p_priori de esa
                clase.*/
        }//Fin de la función calcularP_Total.
        
        function getN() {
            return $this->n;
        }
        
        function getNC() {
            return $this->nc;
        }
        
        function getP() {
            return $this->p;
        }
        
        function getPriori() {
            return $this->p_priori;
        }
        
        function getFrecuencia() {
            return $this->frecuencias;
        }
        
        function getProductoria() {
            return $this->productoFrecuencias;
        }
        
        function getTotal() {
            return $this->p_total;
        }
        
        function getValores() {
            return $this->valoresPorCaracteristica;
        }
    }//Fin de la clase Bayes.
?>