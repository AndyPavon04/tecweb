<?php
class Pie {

    private $mensaje;

    public function __construct($msj) {
        $this->mensaje = $msj;
    }
    public function graficar() {
        $estilo = 'text-aling: center';
        echo '<h4 style="'.$estilo.'">'.$this->mensaje.'</h4>';
    }

}

?>