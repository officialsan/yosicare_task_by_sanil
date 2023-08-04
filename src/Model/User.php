<?php 
namespace Yosicare\Task\Model;
use Yosicare\Task\Config;
use Yosicare\Task\Database\Database;
use PDO;

class User extends Database
{
    private $table_name = Config::PREFIX."users";
    public $data;
    public $id;
    public function __construct()
    {
        parent::__construct();
        if(!$this->tableIsExist()) $this->createTable();
    }
    public function getId(int $id)  :?array
    {
        $query = "SELECT  * FROM {$this->table_name}  WHERE id = :id LIMIT 1" ;
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        if($data = $stmt->fetch(PDO::FETCH_ASSOC)) return  $this->data = (array) $data;
        return $this->data;
    }
    public function getByEmail(string $email)  :?object
    {
        $query = "SELECT  * FROM {$this->table_name}  WHERE email = :email LIMIT 1" ;
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':email',$email);
        $stmt->execute();
        if($data = $stmt->fetch(PDO::FETCH_ASSOC)) return  $this->data = (object) $data;
        return $this->data;
    }

    public function getCount(String $condition = ""):int
    {
        $query = "SELECT count(*) as allcount  FROM {$this->table_name} {$condition} ORDER BY id DESC";  
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['allcount'];
        }
        return 0;
    }

    public function all(String $condition = "")
    {
        $query = "SELECT * FROM {$this->table_name} {$condition}";  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function tableIsExist():bool
    {
         
        $sql = 'SELECT COUNT(*) AS count FROM information_schema.tables WHERE table_name = :table_name';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':table_name', $this->table_name);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['count'] != 0;
    }
    protected function createTable():void
    {
        $sql = "CREATE TABLE {$this->table_name} (
            `id` INT NOT NULL AUTO_INCREMENT,
            `first_name` VARCHAR(255) NOT NULL,
            `last_name` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) UNIQUE NOT NULL,
            `dob` DATE NOT NULL,
            `gender` ENUM('MALE', 'FEMALE', 'OTHER') NOT NULL,
            `address1` VARCHAR(255) NOT NULL,
            `address2` VARCHAR(255) NULL,
            `city` VARCHAR(255) NOT NULL,
            `state` VARCHAR(2) NOT NULL,
            `zipcode` VARCHAR(10) NOT NULL,
            `customfields` TEXT NULL,
            PRIMARY KEY (`id`),
            INDEX `idx_email` (`email`),
            INDEX `idx_last_name` (`last_name`)
          );";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }
    public function save(): bool
    {
        if(!$this->data) return false;
        $customFields =   $this->data['customfields'] ?? [];
        $query = "INSERT INTO  
                    {$this->table_name} (
                            first_name,
                            last_name,
                            email,
                            dob,
                            gender,
                            address1,
                            address2,
                            city,
                            state,
                            zipcode,
                            customfields
                        ) 
                        VALUES (
                            :first_name,
                            :last_name,
                            :email,
                            :dob,
                            :gender,
                            :address1,
                            :address2,
                            :city,
                            :state,
                            :zipcode,
                            :customfields
                        )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':first_name',$this->data['first_name']);
        $stmt->bindValue(':last_name',$this->data['last_name']);
        $stmt->bindValue(':email',$this->data['email']);
        $stmt->bindValue(':dob',$this->data['dob']);
        $stmt->bindValue(':gender',$this->data['gender']);
        $stmt->bindValue(':address1',$this->data['address1']);
        $stmt->bindValue(':address2',$this->data['address2']);
        $stmt->bindValue(':city',$this->data['city']);
        $stmt->bindValue(':state',$this->data['state']);
        $stmt->bindValue(':zipcode',$this->data['zipcode']);
        $stmt->bindValue(':customfields',json_encode($customFields));
        return $stmt->execute() ? true : false;
    }
    public function update():bool
    {
        $customFields =   $this->data['customfields'] ?? [];
        $query = "UPDATE  {$this->table_name} SET  
                            first_name = :first_name,
                            last_name = :last_name,
                            email = :email,
                            dob = :dob,
                            gender = :gender,
                            address1 = :address1,
                            address2 = :address2,
                            city = :city,
                            state = :state,
                            zipcode = :zipcode,
                            customfields = :customfields 
                        WHERE id = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':first_name',$this->data['first_name']);
        $stmt->bindValue(':last_name',$this->data['last_name']);
        $stmt->bindValue(':email',$this->data['email']);
        $stmt->bindValue(':dob',$this->data['dob']);
        $stmt->bindValue(':gender',$this->data['gender']);
        $stmt->bindValue(':address1',$this->data['address1']);
        $stmt->bindValue(':address2',$this->data['address2']);
        $stmt->bindValue(':city',$this->data['city']);
        $stmt->bindValue(':state',$this->data['state']);
        $stmt->bindValue(':zipcode',$this->data['zipcode']);
        $stmt->bindValue(':customfields',json_encode($customFields));        
        $stmt->bindValue(':id',$this->data['id']);
        return $stmt->execute() ? true : false;
    }
    public function delete():bool
    {
        $query = "DELETE FROM {$this->table_name} WHERE id =:id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id',$this->data['id']); 
        return $stmt->execute() ?  true : false;
    }
}