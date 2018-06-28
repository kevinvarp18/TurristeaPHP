<?php
    class Bayes {

        // ********** ATRIBUTOS **********

        private $n;        
        private $p;
        private $p_priori;
        private $m;
        private $p1;
        private $p2;        
        private $frecuencias1;
        private $frecuencias2;
        private $productoFrecuencias;        
        private $p_total;
        private $ubicaciones;
        private $precios;

        // ********** CONSTRUCTOR **********

        function Bayes($m, $p1, $p2, $n, $priori, $ubicaciones, $precios) {
            $this->n = $n;            
            $this->p_priori = $priori;
            $this->ubicaciones = $ubicaciones;
            $this->precios = $precios;
            $this->m = $m;
            $this->p1 = $p1;
            $this->p2 = $p2;
            $this->frecuencias1 = array();
            $this->frecuencias2 = array();
            $this->productoFrecuencias = array();            
            $this->p_total = array();
        }//Fin del constructor.
        
        // ********** FUNCIONES **********
        
        function calcularBayes(){
            $clases = array('Cultural','Negocio','Familiar','Deportivo');
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
            return $clases[$posicionResultado];
        }/* Fin de la función calcularBayes que realiza todos los cálculos necesarios
        con los registros de la BD y el que ingresó el usuario. Una vez obtenidos
        todos los datos, verifica cual es la probabilidad más alta para determinar
        la clase y retorna el dato al respectivo controlador. */

        private function calcularVariablesBayes(){//          
            $this->calcularFrecuenciasPrecios();
            $this->calcularFrecuenciasUbicacion();
            $this->calcularProductoriaFrecuencias();
            $this->calcularP_Total();
        }/* Fin de la función calcularVariablesBayes que realiza el cálculo de todas
        las variables que se necesitan para hacer Bayes. */
             
             
        private function calcularFrecuenciasPrecios(){
            for($i = 0; $i < count($this->n); $i++){
                $this->frecuencias1[$i] = (intval($this->precios[$i][0])+$this->m*$this->p1)/($this->n[$i][0]+$this->m); //(nc+m*p)/(n+m)
            }
        }//Fin de la función calcularFrecuencias.
        
          
        private function calcularFrecuenciasUbicacion(){            
            for($i = 0; $i < count($this->n); $i++){
                $this->frecuencias2[$i] = ($this->ubicaciones[$i][0]+$this->m*$this->p2)/($this->n[$i][0]+$this->m); //(nc+m*p)/(n+m)
            }
        }//Fin de la función calcularFrecuencias.
        
        private function calcularProductoriaFrecuencias(){
            for($i = 0; $i < count($this->n); $i++){                
                $this->productoFrecuencias[$i] = $this->frecuencias1[$i]*$this->frecuencias2[$i];
            }
         }//Fin de la función calcularProductoriaFrecuencias.
        
        private function calcularP_Total(){
            for($i = 0; $i < count($this->n); $i++){
                array_push($this->p_total, $this->productoFrecuencias[$i]*$this->p_priori[$i][0]);
            }/* Fin del for que itera dependiendo del número de clases que tiene
                esa entidad, para determinar el P_Total, multiplicando el producto
                de todas las frecuencias de los atributos por el p_priori de esa
                clase.*/
        }//Fin de la función calcularP_Total.
                
    }//Fin de la clase Bayes.
?>