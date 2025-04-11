<?php
class AuthorDAO
{
    public static function getAll($pageN)
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if ($pageN) {
                $offset = ($pageN - 1) * 9;
                $stmt = $dbh->prepare("SELECT * FROM tbl_authors LIMIT 9 OFFSET :offset;");
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                $stmt = $dbh->prepare("SELECT * FROM tbl_authors");
                $stmt->execute();
            }

            $result = $stmt->fetchAll(PDO::FETCH_CLASS, AuthorON::class);

            foreach ($result as $author) {
                $author->numFrases = PhraseDAO::getPhrasesByAuthor($author->id)[0];
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

        $stmt = $dbh->prepare("SELECT COUNT(*) FROM tbl_authors");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_NUM);

        return $result[0]/9;
    }
    public static function getById($id)
    {
        try {
            $DBH = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $DBH->prepare("SELECT * FROM tbl_authors WHERE id = ?");
            
            $stmt->execute([
                $id
            ]);
            
            $result = $stmt->fetchObject(AuthorON::class);
            return $result;
        } catch (PDOException $e) {
            ErrorView::show($e);
        }
    }
    public static function deleteById($id)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("DELETE FROM tbl_authors WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    public static function update($id, $nom, $descripcio)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("UPDATE tbl_authors SET nom = ?, descripcio = ? WHERE id = ?");

        $stmt->execute([$nom, $descripcio, $id]);
        
        return $stmt->rowCount() > 0;
    }
    public static function create($nom, $descripcio, $url)
    {
        $dbh = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $dbh->prepare("INSERT INTO tbl_authors (nom, descripcio, url) VALUES (?, ?, ?)");

        $stmt->execute([$nom, $descripcio, $url]);
        return $stmt->rowCount() > 0;
    }
}