<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 20:30
 */

class UserRepository extends Model
{
    public function create($userId, $repositoryId, $resource, $size, $tags, $description, $version, $officialSite)
    {
        $sql = "INSERT INTO user_repository (`user_id`, `repository_id`, `resource`, `size`, `tags`, `description`, `version`, `official_site` ,`created_at`, `updated_at`) " .
            "VALUES (?,?,?,?,?,?,?,?,?,?)";

        $query = Database::getBdd()->prepare($sql);

        return $query->execute(
            [
                $userId,
                $repositoryId,
                $resource,
                $size,
                $tags,
                $description,
                $version,
                $officialSite,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s')
            ]);
    }

    public function getAll($userId)
    {
        $sql = "SELECT id, repository_id, repository.name, repository.version as version, user_repository.resource, size, tags, description, " .
            " user_repository.version as user_repo_version, official_site, user_repository.created_at as created_at, user_repository.updated_at as updated_at" .
            " FROM `user_repository` " .
            " LEFT JOIN  repository on repository.entity_id = user_repository.repository_id" .
            " WHERE user_id=$userId";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($repositoryId, $resource, $size, $tags, $description, $version, $officialSite)
    {
        $sql = "UPDATE user_repository SET ";
        if(!is_null($resource)){
            $sql = $sql . "resource = :resource, size = :size ,";
        }
        $sql = $sql . "  tags = :tags, description = :description, version = :version, official_site = :official_site,  updated_at = :updated_at ".
            "WHERE id = :repository_id";

        $req = Database::getBdd()->prepare($sql);
        $data = [
            'repository_id' => $repositoryId,
            'tags' => $tags,
            'description' => $description,
            'version' => $version,
            'official_site' => $officialSite,
            'updated_at' => date('Y-m-d H:i:s')

        ];
        if(!is_null($resource)){
            $data['resource'] = $resource;
            $data['size'] = $size;
        }
        return $req->execute($data);
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
        $sql = "SELECT id as repository_id, repository.name, repository.version, user_repository.resource" .
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

    public function getTotalSizeForUSer($id)
    {
        $sql = "SELECT sum(size) as total_size" .
            " FROM `user_repository` " .
            " WHERE user_id=$id";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result ? $result->total_size : 0;
    }

    public function getUserRepoDataById($id)
    {
        $sql = "SELECT id, repository_id, repository.name, repository.version as repo_version, user_repository.resource, tags, description,user_repository.version as version, official_site " .
            " FROM `user_repository` " .
            " LEFT JOIN  repository on repository.entity_id = user_repository.repository_id" .
            " WHERE id=$id";
        $query = Database::getBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
