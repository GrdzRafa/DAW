<?php
class PhraseON {
    private $id;
    private $text;
    private $author;
    private $theme;
    private $created_at;
    private $updated_at;
    
    public function __construct($id, $text, $author, $theme, $created_at, $updated_at) {
        $this->id = $id;
        $this->text = $text;
        $this->author = $author;
        $this->theme = $theme;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}