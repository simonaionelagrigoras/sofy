<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 20:30
 */

class UserRepository extends Model
{
    public function create($userId, $repositoryId, $resource, $size)
    {
        $sql = "INSERT INTO user_repository (`user_id`, `repository_id`, `resource`, `size`,`created_at`, `updated_at`) VALUES (?,?,?,?,?,?)";

        $query = Database::getBdd()->prepare($sql);

        return $query->execute(
            [
                $userId,
                $repositoryId,
                $resource,
                $size,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s')
            ]);
    }

    public function update($userId, $repositoryId, $resource, $size)
    {
        $sql = "UPDATE user_repository SET resource = :resource, size = :size , updated_at = :updated_at ".
            "WHERE user_id = :user_id AND repository_id = :repository_id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'user_id' => $userId,
            'repository_id' => $repositoryId,
            'resource' => $resource,
            'size' => $size,
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function delete($userId, $repositoryId)
    {
        $sql = 'DELETE FROM user_repository WHERE user_id = ? AND repository_id= ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$userId, $repositoryId]);
    }
}
