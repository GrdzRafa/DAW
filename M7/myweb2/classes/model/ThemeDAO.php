<?php
class ThemeDAO {

    public static function getAll($pageN)
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if ($pageN) {
                $offset = ($pageN - 1) * 9;
                $stmt = $dbh->prepare("SELECT * FROM tbl_themes LIMIT 9 OFFSET :offset;");
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                $stmt = $dbh->prepare("SELECT * FROM tbl_themes");
                $stmt->execute();
            }

            $result = $stmt->fetchAll(PDO::FETCH_CLASS, ThemeON::class);

            foreach ($result as $theme) {
                $theme->numFrases = PhraseDAO::getPhrasesByTheme($theme->id)[0];
            }

            return $result;
        } catch (PDOException $e) {
            ErrorView::show($e);
        }
    }

    public static function getTotalCount()
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("SELECT COUNT(*) FROM tbl_themes");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_NUM);

        return $result[0]/9;
    }

    function getById($id)
    {
        try {
            
            $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("SELECT nom, descripcio FROM tbl_themes WHERE id = ?");
            $stmt->execute([
                (int)$id
            ]);
            $result = $stmt->fetchObject(ThemeON::class);
            
            return $result;
        } catch (PDOException $e) {
            ErrorView::show($e);
        }
    }

    public static function deleteById($id)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("DELETE FROM tbl_themes WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    public static function update($id, $nom, $descripcio)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("UPDATE tbl_themes SET nom = ?, descripcio = ? WHERE id = ?");

        $stmt->execute([$nom, $descripcio, $id]);
        
        return $stmt->rowCount() > 0;
    }
    public static function create($nom, $descripcio)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $dbh->prepare("INSERT INTO tbl_themes (nom, descripcio) VALUES (?, ?)");

        $stmt->execute([$nom, $descripcio]);
        return $stmt->rowCount() > 0;
    }
}
?>