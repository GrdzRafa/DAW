<?php

class AuthorController extends Controller
{
    public function show($params = [])
    {
        $maxPage = ceil(AuthorDAO::getTotalCount());

        if (empty($params) || $params[0] < 1 || $params[0] > $maxPage) {
            $params = [1];
        }

        $llistatAutors = AuthorDAO::getAll(($params[0]));
        $vAuthor = new AuthorView();
        $vAuthor->show($llistatAutors, $params[0], $maxPage);
    }

    public function delete($id)
    {
        AuthorDAO::deleteById($id[0]);
        header("Location: ?Author/show");
    }
    public function edit($id)
    {
        try {
            $editAuthor = new AuthorView();

            $author = AuthorDAO::getById($id[0]);

            $editAuthor->showEdit($author);
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

            $updated = AuthorDAO::update((int) $dades["id"], $dades["nom"], $dades["descripcio"]);

            if ($updated) {
                header("Location: ?Author/show");
            } else {
                throw new Exception("No s'ha pogut actualitzar l'autor.");
            }
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }

    public function new()
    {
        try {
            $editAuthor = new AuthorView();

            $editAuthor->showCreate();
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }

    public function create($dades)
    {
        try {

            $specialChars = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '-', '=', '{', '}', '[', ']', ':', ';', '"', "'", '<', '>', ',', '.', '?', '/', '\\', '|', '`', '~'];
            $url = strtolower(str_replace($specialChars, '', $dades["nom"]));
            $url = explode(" ", $url);
            $url = "/autores/" . implode("-", $url);
            echo $url;
            $created = AuthorDAO::create($dades["nom"], $dades["descripcio"], $url);

            if ($created) {
                header("Location: ?Author/show");
            } else {
                throw new Exception("No s'ha pogut crear l'autor.");
            }
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }
}

