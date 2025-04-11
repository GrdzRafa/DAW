<?php

class View {
    protected $idiomaActiu;
    protected $file;
    
    public function __construct() {
        $this->idiomaActiu = (isset($_COOKIE['lang'])) ? $_COOKIE["lang"] : "cat";
        $this->file = "../langs/vars_{$this->idiomaActiu}.php";
    }
    
    /*
     * funció html_generateSelect: a partir d'un array associatiu, genera codi
     * html per la visualització d'un control SELECT-OPTION generand un menú
     * desplegable.
     *
     * paràmetres:
     * * opcions: array associatiu, en el que la clau representa el valor a definir i
     *      el valor serà el text a mostrar.
     * * atributs: (Opcional) Array associatiu amb parelles atribut-valor segons la
     *       definició html.
     *       https://www.w3schools.com/tags/tag_select.asp apartat Attributes
     *       autofocus: boolean
     *       disabled: boolean
     *       form: string
     *       multible: boolean
     *       name: string
     *       required: boolean
     *       size: integer
     *       class: string
     *       id: string
     *       label: string
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    
    public function html_generateSelect($opcions, $seleccionat, $atributs) {
        if (isset($atributs)) {
            //atribut autofocus: boolean
            $attAutofocus = (isset($atributs['autofocus']) && $atributs['autofocus']===true) ? "autofocus " : "";
            
            //atribut disabled: boolean
            $attDisabled = (isset($atributs['disabled']) && $atributs['disabled']===true) ? "disabled " : "";
            
            //atribut form: string
            $attForm = isset($atributs['form']) ? "form=\"{$atributs['form']}\"" : "";
            
            //atribut multible: boolean
            $attMultiple = isset($atributs['multiple']) ? "multiple" : "";
            
            //atribut name: string
            $attName = isset($atributs['name']) ? "name=\"{$atributs['name']}\"" : "";
            
            //atribut required: boolean
            $attRequred = isset($atributs['required']) ? "required" : "";
            
            //atribut size: integer
            $attSize = isset($atributs['size']) ? "size=\"{$atributs['size']}\"" : "";
            
            //atribut class: string
            $attClass = isset($atributs['class']) ? "class=\"{$atributs['class']}\"" : "";
            
            //atribut id: string
            $attId = isset($atributs['id']) ? "id=\"{$atributs['id']}\"" : "";
            
            //label no és un atribut, però ho tractarem com si ho fos.
            $attLabel = isset($atributs['label']) ? "<label for='".$atributs['id']."'>".$atributs['label']."</label><br/>\n" : "";
        }
        
        $resultat = $attLabel;
        $resultat .= "<select $attId $attClass $attName $attSize $attForm $attRequred $attMultiple $attDisabled $attAutofocus>\n";
        foreach ($opcions as $key => $value) {
            $resultat .= "<option value=\"$key\"";
            if (isset($seleccionat) && $seleccionat===$key ) {
                $resultat .= " selected";
            }
            $resultat .=">".ucwords($value)."</option>\n";
        }
        $resultat .="</select>\n";
        if ($atributs['span']!="") {
            $resultat .= "<span class=\"error\" >{$atributs['span']}</span>\n";
        }
        
        return $resultat;
    }
    
    /*
     * funció html_generateChekBox: a partir d'un array associatiu, genera codi
     * html per la visualització dels controls CHECK-BOX.
     *
     * paràmetres:
     * * opcions: array associatiu, amb la clau que representa l'identificador html
     *       únic (l'id) i el valor serà un array amb les següents claus:
     *       "name" que representa el valor a definir,
     *       "label" que emmagatzemarà el text a mostrar,
     *       "value" el valor a assignar,
     *       "checked" que emmagatzemarà un valor booleà.
     * * abans: (Per defecte true) Defineix el label abans/dreprés del checkbox
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    
    public function html_generateCheckBox($opcions, $abans="true") {
        foreach ($opcions as $key => $value) {
            $bChecked = ($value['checked']) ? true : false;
            unset($value['checked']);
            $label = "<label for=\"{$key}\">{$value['label']}</label><br>\n";
            unset($value['label']);
            
            $value["type"] = "checkbox";
            $value["id"] = $key;
            $input = $this->html_generaInput($value);
            $input = ($bChecked) ? str_replace(">","checked >",$input) : $input;
            
            if ($abans) {
                $resultat .= "$input\n$label";
            } else {
                $resultat .= "$label\n$input";
            }
        }
        
        return $resultat;
    }
    
    /*
     * funció html_generateChekBox: a partir d'un array associatiu, genera codi
     * html per la visualització dels controls CHECK-BOX.
     *
     * paràmetres:
     * * opcions: array associatiu, amb la clau que representa l'identificador html
     *       únic (l'id) i el valor serà un array amb les següents claus:
     *       "name" que representa el valor a definir,
     *       "label" que emmagatzemarà el text a mostrar,
     *       "value" el valor a assignar,
     *       "checked" que emmagatzemarà un valor booleà.
     * * abans: (Per defecte true) Defineix el label abans/dreprés del checkbox
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    
    public function html_generateRadioButon($opcions, $abans="true") {
        $resultat = "";
        foreach ($opcions as $key => $value) {
            $bChecked = ($value['checked']) ? true : false;
            unset($value['checked']);
            $label = "<label for=\"{$key}\" class=\"fs-form\">{$value['label']}</label>";
            unset($value['label']);
            
            $value["type"] = "radio";
            $value["id"] = $key;
            $input = $this->html_generaInput($value);
            $input = ($bChecked) ? str_replace(">","checked >",$input) : $input;
            
            
            if ($abans) {
                $resultat .= "<div class='curt' style='display: inline-block;'>$input\n$label</div>";
            } else {
                $resultat .= "$label\n$input";
            }
        }
        
        
        return $resultat;
    }
    
    /*
     * funció html_generateInput: a partir d'un array associatiu, genera codi
     * html per la visualització dels controls INPUT.
     *
     * paràmetres:
     * * opcions: array associatiu, amb la clau que representa l'identificador html
     *       únic (l'id) i el valor serà un array amb les següents claus:
     *       "type"
     *       "name" ,
     *       "placeholder"
     *       "class"
     *       "value"
     *       o qualsevol altre atribut de INPUT
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    public function html_generaInput($options) {
        $resultat = "<input ";
        
        foreach ($options as $key => $value) {
            $resultat .= ($key!="span") ? "$key =\"$value\" " : "";
        }
        $resultat .= ">\n";
        if (isset($options["span"]) && $options["span"]!="") {
            $resultat .= "<span class=\"error\" >{$options['span']}</span>\n";
        }
        return $resultat;
    }
    
    
    
}

