<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 管理员
 * Class Admins
 *
 * @since 2.0
 *
 * @Entity(table="admins")
 */
class Admins extends Model
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
     * @var int|null
     */
    public $roleId;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $name;

    /**
     * 
     *
     * @Column(hidden=true)
     * @var string|null
     */
    public $password;

    /**
     * 1可用 2不可用
     *
     * @Column()
     * @var int|null
     */
    public $isEnable;

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
     * @param int|null $roleId
     * @return self
     */
    public function setRoleId(?int $roleId): self
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $password
     * @return self
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param int|null $isEnable
     * @return self
     */
    public function setIsEnable(?int $isEnable): self
    {
        $this->isEnable = $isEnable;

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
     * @return int|null
     */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return int|null
     */
    public function getIsEnable(): ?int
    {
        return $this->isEnable;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

}
