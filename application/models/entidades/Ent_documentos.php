<?php
    class ent_documentos{
        private static $tipos = array(
            array('name' => 'Factura', 'value' => '01', 'attr' => 'factura'),
            array('name' => 'Boleta', 'value' => '03', 'attr' => 'boleta'),
            array('name' => 'Nota Credito', 'value' => '07', 'attr' => 'notcre'),
            array('name' => 'Nota Debito', 'value' => '08', 'attr' => 'notdeb')
            );
        public static function lstTipos(){
            return self::$tipos;
        }
        public static function getTipo($tipo){
            foreach (self::$tipos as $key => $value) {
                if(+$value['attr'] == $tipo) return +$value['value'];
            }
            return 0;
        }
    }
?>