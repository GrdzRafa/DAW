<?php

class ThemeController extends Controller
{
    public function show($params=[]) {
        
        $maxPage = ceil(ThemeDAO::getTotalCount());

        if (empty($params) || $params[0] < 1 || $params[0] > $maxPage) {
            $params = [1];
        }

        $llistatTemes = ThemeDAO::getAll();
        $vTheme = new ThemeView();
        $vTheme->show($llistatTemes, $params[0], $maxPage);
    }

    public function delete($id)
    {
        ThemeDAO::deleteById($id[0]);
        header("Location: ?Theme/show");
    }
    public function edit($id)
    {
        try {
            $editTheme = new ThemeView();

            $theme = ThemeDAO::getById($id[0]);

            $editTheme->showEdit($theme);
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }

    public function update($dades)
    {
        try {
            $updated = ThemeDAO::update($dades["nom"], $dades["descripcio"]);

            if ($updated) {
                header("Location: ?Theme/show");
            } else {
                throw new Exception("No s'ha pogut actualitzar el tema.");
            }
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }

    public function new()
    {
        try {
            $editTheme = new ThemeView();

            $editTheme->showCreate();
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }

    public function create($dades)
    {
        try {
            $created = ThemeDAO::create($dades["nom"], $dades["descripcio"]);

            if ($created) {
                header("Location: ?Theme/show");
            } else {
                throw new Exception("No s'ha pogut crear el tema.");
            }
        } catch (Exception $e) {
            ErrorView::show($e);
        }
    }
}

