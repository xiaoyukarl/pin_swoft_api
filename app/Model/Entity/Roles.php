<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 角色表
 * Class Roles
 *
 * @since 2.0
 *
 * @Entity(table="roles")
 */
class Roles extends Model
{
    /**
     * 
     * @Id()
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
    public $roleName;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $roleRight;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $roleDesc;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $createTime;


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
     * @param string|null $roleName
     * @return self
     */
    public function setRoleName(?string $roleName): self
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * @param string|null $roleRight
     * @return self
     */
    public function setRoleRight(?string $roleRight): self
    {
        $this->roleRight = $roleRight;

        return $this;
    }

    /**
     * @param string|null $roleDesc
     * @return self
     */
    public function setRoleDesc(?string $roleDesc): self
    {
        $this->roleDesc = $roleDesc;

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
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @return string|null
     */
    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    /**
     * @return string|null
     */
    public function getRoleRight(): ?string
    {
        return $this->roleRight;
    }

    /**
     * @return string|null
     */
    public function getRoleDesc(): ?string
    {
        return $this->roleDesc;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

}
