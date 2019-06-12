<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 20:30
 */

class UserRepository extends Model
{
    public function create($userId, $repositoryId, $resource, $size, $tags)
    {
        $sql = "INSERT INTO user_repository (`user_id`, `repository_id`, `resource`, `size`, `tags` ,`created_at`, `updated_at`) VALUES (?,?,?,?,?,?,?)";

        $query = Database::getBdd()->prepare($sql);

        return $query->execute(
            [
                $userId,
                $repositoryId,
                $resource,
                $size,
                $tags,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s')
            ]);
    }

    public function update($userId, $repositoryId, $resource, $size, $tags)
    {
        $sql = "UPDATE user_repository SET resource = :resource, size = :size , tags = :tags, updated_at = :updated_at ".
            "WHERE user_id = :user_id AND repository_id = :repository_id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'user_id' => $userId,
            'repository_id' => $repositoryId,
            'resource' => $resource,
            'size' => $size,
            'tags' => $tags,
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function delete($userId, $repositoryId)
    {
        $sql = 'DELETE FROM user_repository WHERE user_id = ? AND id= ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$userId, $repositoryId]);
    }

    public function getSearchResults($userId, $searchKey)
    {
        try{
            $sql = "SELECT id as repository_id, repository.name as repository_name, repository.version, resource FROM user_repository " .
                " LEFT JOIN  repository on repository.entity_id = user_repository.repository_id" .
                " WHERE user_id='" . $userId ."'" .
                " AND (resource like '%" . $searchKey . "%' OR tags like '%" . $searchKey . "%')";
            $query = Database::getBdd()->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            if (empty($result)){
                return ['error' => "No serach results found for key " . $searchKey];
            }
            return $result;
        }catch (Exception $e){
            return ['error' => "Could not get the app: " . $e->getMessage()];
        }
    }

    public function getUserRepositories($id)
    {
        $sql = "SELECT repository_id, repository.name, repository.version, user_repository.resource" .
            " FROM `user_repository` " .
            " LEFT JOIN  repository on repository.entity_id = user_repository.repository_id" .
            " WHERE user_id=$id";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getUserRepositoryById($id)
    {
        $sql = "SELECT id, repository_id, repository.name, repository.version, user_repository.resource" .
            " FROM `user_repository` " .
            " LEFT JOIN  repository on repository.entity_id = user_repository.repository_id" .
            " WHERE id=$id";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
