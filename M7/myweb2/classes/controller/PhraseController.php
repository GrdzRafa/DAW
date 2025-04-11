<?php

use Doctrine\ORM\Query\AST\Functions\FunctionNode;

class PhraseController extends Controller
{
    public function show($params = [])
    {
        $maxPage = ceil(PhraseDAO::getTotalCount());

        if (empty($params) || $params[0] < 1 || $params[0] > $maxPage) {
            $params = [1];
        }
        
        $llistatFrases = PhraseDAO::getAll(($params[0]));
        $vPhrase = new PhraseView();
        $vPhrase->show($llistatFrases, $params[0], $maxPage);
    }
    public function delete($id)
    {
        PhraseDAO::deleteById($id[0]);
        header("Location: ?Phrase/show");
    }
    public function edit($id)
    {
        try {
            $editPhrase = new PhraseView();

            $phrase = PhraseDAO::getById($id[0]);
            $authors = AuthorDAO::getAll(0);
            $themes = ThemeDAO::getAll();

            $editPhrase->showEdit($phrase, $authors, $themes);
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }
    public function update($dades)
    {
        try {
            // if (empty($text)) {
            //     throw new Exception("El text de la frase no pot estar buit.");
            // }

            $updated = PhraseDAO::update((int) $dades["id"], $dades["text"], (int) $dades["author_id"], (int) $dades["theme_id"]);

            if ($updated) {
                header("Location: ?Phrase/show");
            } else {
                throw new Exception("No s'ha pogut actualitzar la frase.");
            }
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }
    public function new()
    {
        try {
            $editPhrase = new PhraseView();

            $authors = AuthorDAO::getAll(null);
            $themes = ThemeDAO::getAll();

            $editPhrase->showCreate($authors, $themes);
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }
    public function create($dades)
    {
        try {
            $created = PhraseDAO::create($dades["text"], (int) $dades["author_id"], (int) $dades["theme_id"]);

            if ($created) {
                header("Location: ?Phrase/show");
            } else {
                throw new Exception("No s'ha pogut crear la frase.");
            }
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }

    // public function import()
    // {
    //     // Cargar el XML
    //     $xml = simplexml_load_file('ruta/a/tu/archivo.xml');

    //     $authors = []; // Para evitar duplicados de autores
    //     $themes = [];  // Para evitar duplicados de temas

    //     foreach ($xml->autor as $authorNode) {
    //         // Crear objeto AuthorON
    //         $author = new AuthorON();
    //         $author->nom = (string) $authorNode->nombre;
    //         $author->descripcio = (string) $authorNode->descripcion;
    //         $author->url = (string) $authorNode['url'];

    //         // Comprobar si el autor ya existe
    //         if (!in_array($author->nom, $authors)) {
    //             AuthorDAO::create($author); // Método para insertar el autor en la base de datos
    //             $authors[] = $author->nom; // Agregar a la lista de autores procesados
    //         }

    //         // Recorrer las frases del autor
    //         foreach ($authorNode->frases->frase as $phraseNode) {
    //             // Crear objeto PhraseON
    //             $phraseText = (string) $phraseNode->texto;
    //             $themeName = (string) $phraseNode->tema;

    //             // Comprobar si el tema ya existe
    //             if (!in_array($themeName, $themes)) {
    //                 $theme = new ThemeON();
    //                 $theme->nom = $themeName;
    //                 $theme->descripcio = ''; // Puedes agregar una descripción si lo deseas
    //                 ThemeDAO::create($theme); // Método para insertar el tema en la base de datos
    //                 $themes[] = $themeName; // Agregar a la lista de temas procesados
    //             }

    //             // Obtener el ID del autor y del tema
    //             $authorId = AuthorDAO::getByName($author->nom)->id; // Método para obtener el ID del autor por nombre
    //             $themeId = ThemeDAO::getByName($themeName)->id; // Método para obtener el ID del tema por nombre

    //             // Crear y guardar la frase
    //             $phrase = new PhraseON(null, $phraseText, $author, $theme, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
    //             PhraseDAO::create($phrase->text, $authorId, $themeId); // Método para insertar la frase en la base de datos
    //         }
    //     }

    //     // Redirigir a la página de frases
    //     header("Location: ?Phrase/show");
    //     exit();
    // }
}


