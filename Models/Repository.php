<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 20:30
 */

class Repository extends Model
{
    public function create($name, $version)
    {
        $sql = "INSERT INTO repository (`name`, `version`, `updated_at`) VALUES (?,?,?)";

        $query = Database::getBdd()->prepare($sql);

        return $query->execute([$name, $version, date('Y-m-d H:i:s')]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM repository WHERE entity_id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }

    public function getMainRepositories()
    {
        $sql = "SELECT DISTINCT name AS repository_name" .
            " FROM `repository` ";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getVersions($repoName)
    {
        $sql = "SELECT version FROM `repository` WHERE name = '" . $repoName . "'";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getRepoByVersion($version)
    {
        $sql = "SELECT name FROM `repository` WHERE version = '" . $version . "'";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result->name;
    }

    public function getRepoIdByVersion($version)
    {
        $sql = "SELECT entity_id FROM `repository` WHERE version = '" . $version . "'";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result->entity_id;
    }

}
