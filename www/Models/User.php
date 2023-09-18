<?php
namespace App\Models;
use App\Core\Sql;
use Cassandra\Date;

class User extends Sql {

    protected Int $id =0;
    protected String $firstname;
    protected String $lastname;
    protected String $email;
    protected String $pwd;
    protected Int $role = 0;
    protected ?String $token;
    protected String $date_inserted;
    protected int $status ;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param Int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    /**
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return String
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param String $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname =ucwords(strtolower(trim($lastname)));
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->pwd;
    }

    /**
     * @param String $pwd
     */
    public function setPassword(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
    public function setDateInserted(): void
    {
        $this->date_inserted = date("Y-m-d H:i:s");
     }

    /**
     * @return mixed
     */
    public function getDateInserted(): mixed
    {
        return $this->date_inserted;
    }

    /**
     * @return mixed
     */

    public function verifPwd($pwd): bool
    {
        return password_verify($pwd,$this->getPassword());
    }

    public function generateToken():void
    {
        $this->token = substr(md5(uniqid().rand(1000000, 9999999)),0,10);
    }
    public function generateCode(): string
    {
       return $code = substr(md5(uniqid().rand(1000000, 9999999)),0,4);
    }

    public function getStats(): array
    {
        $static["byMonth"]= parent::getCountByMonth();
        $static["byWeek"]= parent::getCountByWeek();
        $static["byDay"]= parent::getCountByDay();
        return $static;

    }


}