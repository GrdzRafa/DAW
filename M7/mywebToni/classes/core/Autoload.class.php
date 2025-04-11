<?php
class Autoload {
    
    private static function trobar_subcarpetes($ruta) {
        $carpetes = [];
        $subcarpetes = scandir($ruta);
        foreach ($subcarpetes as $subcarpeta) {
            if ($subcarpeta!="." && $subcarpeta!=".." && is_dir("$ruta/$subcarpeta")){
                $carpetes[] = "$ruta/$subcarpeta";
                if (is_array($resultat = self::trobar_subcarpetes("$ruta/$subcarpeta"))) {
                    foreach ( $resultat as $item) {
                        $carpetes[] = $item;
                    }
                }
            }
        }
        return $carpetes;
    }
    
    public static function my_autoload($classe) {
        //     $carpetes = array(".","core","controller", "model", "view");
        
        $carpetes = self::trobar_subcarpetes(__ROOT__."classes");
        $classe = str_replace('\\', '/', $classe);
        
        foreach($carpetes as $carpeta) {
            if (file_exists("$carpeta/$classe.php")) {
                include "$carpeta/$classe.php";
                return;
            }
        }
    }
    
    public static function second_autoload($classe) {
        $carpetes = array(".","core","controller", "model", "view");
        
        foreach($carpetes as $carpeta) {
            if (file_exists(__ROOT__ ."classes/$carpeta/$classe.class.php")) {
                include __ROOT__."classes/$carpeta/$classe.class.php";
                return;
            }
        }
        throw new Exception("Definició de classe no trobada $classe");
    }
    
}