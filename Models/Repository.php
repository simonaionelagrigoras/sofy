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
}
