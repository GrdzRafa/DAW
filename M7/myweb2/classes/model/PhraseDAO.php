<?php

class PhraseDAO
{

    public static function getAll($pageN)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($pageN) {
            $offset = ($pageN - 1) * 9;
            $stmt = $dbh->prepare("SELECT * FROM tbl_phrases LIMIT 9 OFFSET :offset;");
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $stmt = $dbh->prepare("SELECT * FROM tbl_phrases");
            $stmt->execute();
        }

        $result = $stmt->fetchAll(PDO::FETCH_CLASS, stdClass::class);
        $allPhrases = [];

        foreach ($result as $phrase) {
            $authorRes = AuthorDAO::getById((int) $phrase->author_id);

            $theme = new ThemeDAO();
            $themeRes = $theme->getById((int) $phrase->theme_id);

            $phrase = new PhraseON($phrase->id, $phrase->text, $authorRes, $themeRes, $phrase->created_at, $phrase->updated_at);
            $allPhrases[] = $phrase;
        }

        return $allPhrases;
    }
    public static function getTotalCount()
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("SELECT COUNT(*) FROM tbl_phrases");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_NUM);

        return $result[0]/9;
    }
    public static function getById($id)
    {

        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("SELECT * FROM tbl_phrases WHERE id = ?");
        $stmt->execute([(int) $id]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $author = new AuthorDAO();
        $authorRes = $author->getById((int) $result->author_id);
        $theme = new ThemeDAO();
        $themeRes = $theme->getById((int) $result->theme_id);

        $phrase = new PhraseON($result->id, $result->text, $authorRes, $themeRes, $result->created_at, $result->updated_at);
        return $phrase;
    }
    public static function getPhrasesByAuthor($id)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM tbl_phrases WHERE author_id = ?");
        $stmt->execute([
            $id
        ]);
        $result = $stmt->fetch(PDO::FETCH_NUM);

        return $result;
    }
    public static function getPhrasesByTheme($id)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM tbl_phrases WHERE theme_id = ?");
        $stmt->execute([
            $id
        ]);
        $result = $stmt->fetch(PDO::FETCH_NUM);

        return $result;
    }
    public static function deleteById($id)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("DELETE FROM tbl_phrases WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    public static function update($id, $text, $author_id, $theme_id)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("UPDATE tbl_phrases SET text = ?, author_id = ?, theme_id = ?, updated_at = NOW() WHERE id = ?");

        $stmt->execute([$text, $author_id, $theme_id, $id]);
        return $stmt->rowCount() > 0;
    }

    public static function create($text, $author_id, $theme_id)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $dbh->prepare("INSERT INTO tbl_phrases (text, author_id, theme_id) VALUES (?, ?, ?)");

        $stmt->execute([$text, $author_id, $theme_id]);
        return $stmt->rowCount() > 0;
    }
}

// MANERA 2
// $stmt = $DBH->prepare("
// SELECT p.text, p.created_at, p.updated_at, a.id AS author_id, a.name AS author_name,
// t.id AS theme_id, t.name AS theme_name
// FROM tbl_phrases p
// LEFT JOIN tbl_authors a ON p.author_id = a.id
// LEFT JOIN tbl_themes t ON p.theme_id = t.id
// ");
// $stmt->execute();
// $allPhrases = [];
// // Obtener todos los resultados
// while ($phraseData = $stmt->fetch(PDO::FETCH_ASSOC)) {
// // Crear el objeto AuthorON
// $author = new AuthorON();
// $author->id = $phraseData['author_id'];
// $author->name = $phraseData['author_name'];
// // Crear el objeto ThemeON (asegúrate de que esta clase esté definida)
// $theme = new ThemeON();
// $theme->id = $phraseData['theme_id'];
// $theme->name = $phraseData['theme_name'];
// // Crear el objeto PhraseON
// $phrase = new PhraseON($phraseData['text'], $author, $theme, $phraseData['created_at'], $phraseData['updated_at']);
// $allPhrases[] = $phrase;
// }
// return $allPhrases;

// ********************Lógica para hacer el xml:
// Se recorre todo el xml y creo un objeto de cada tipo según corresponda.
// Y tengo que tener 3 arrays, 1 para cada tipo de objeto (obvio).
// No puedo hacerlo todo a la vez, el proceso es el siguiente:
// Primera frase: cojo el tema y creo un objeto. Lo meto en base de datos
// y en el atributo ID del objeto tema, meto el (last insert id) o algo así.
// Hago lo mismo con el Autor.

// Luego creo el objeto frase, en los atributos tema y frase meteré el objeto tema recién añadido y también
// el autor. Y entonces añadiré el objeto frase a base de datos cogiendo los id de los
// objeto tema e id.

// OBviamente, cada vez que meta un objeto a uno de los arrays, comprobaré si ya está dentro.
?>