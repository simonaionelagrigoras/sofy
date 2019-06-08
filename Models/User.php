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
            return ['error' => "Could not get the app: " . $e->getMessage()];
        }
    }
}
