<?php
class User extends Model
{
    public function create($name, $email, $password)
    {
        $sql = "INSERT INTO user (`name`, `email`, `password`,`created_at`, `updated_at`) VALUES (?,?,?,?,?)";

        $query = Database::getBdd()->prepare($sql);

        return $query->execute([$name, $email, $password, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
    }

    public function getFieldByEmail($email, $fieldCode)
    {
        try{
            $sql = "SELECT $fieldCode FROM user WHERE email='" . $email ."'";
            $query = Database::getBdd()->prepare($sql);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            if (empty($result) || empty($result->$fieldCode)){
                return ['error' => "User with id " .$email . " does not exist"];
            }
            return $result->$fieldCode;
        }catch (Exception $e){
            return ['error' => "Could not get the user: " . $e->getMessage()];
        }
    }

    public function getFieldById($id, $fieldCode)
    {
        try{
            $sql = "SELECT $fieldCode FROM user WHERE entity_id='" . $id ."'";
            $query = Database::getBdd()->prepare($sql);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            if (empty($result) || empty($result->$fieldCode)){
                return ['error' => "User with id " . $id . " does not exist"];
            }
            return $result->$fieldCode;
        }catch (Exception $e){
            return ['error' => "Could not get the user: " . $e->getMessage()];
        }
    }

    public function update($userId, $name, $email)
    {
        $sql = "UPDATE user SET name = :name, email = :email , updated_at = :updated_at ".
            "WHERE entity_id = :entity_id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'entity_id' => $userId,
            'name'    => $name,
            'email'   => $email,
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function updatePassword($userId, $password)
    {
        $sql = "UPDATE user SET password = :password, updated_at = :updated_at  ".
            "WHERE entity_id = :entity_id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'entity_id'    => $userId,
            'password'   => $password,
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }
}
