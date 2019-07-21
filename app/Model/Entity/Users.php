<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 注册用户表
 * Class Users
 *
 * @since 2.0
 *
 * @Entity(table="users")
 */
class Users extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     * @var int|null
     */
    public $id;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $username;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $openId;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $unionId;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $telephone;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $avatar;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $createTime;


    /**
     * @param int|null $id
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string|null $username
     * @return self
     */
    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @param string|null $openId
     * @return self
     */
    public function setOpenId(?string $openId): self
    {
        $this->openId = $openId;

        return $this;
    }

    /**
     * @param string|null $unionId
     * @return self
     */
    public function setUnionId(?string $unionId): self
    {
        $this->unionId = $unionId;

        return $this;
    }

    /**
     * @param string|null $telephone
     * @return self
     */
    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @param string|null $avatar
     * @return self
     */
    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @param string|null $createTime
     * @return self
     */
    public function setCreateTime(?string $createTime): self
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getOpenId(): ?string
    {
        return $this->openId;
    }

    /**
     * @return string|null
     */
    public function getUnionId(): ?string
    {
        return $this->unionId;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

}
