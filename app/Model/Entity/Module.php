<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class Module
 *
 * @since 2.0
 *
 * @Entity(table="module")
 */
class Module extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     * @var int|null
     */
    public $mId;

    /**
     * 
     *
     * @Column()
     * @var int|null
     */
    public $groupId;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $modName;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $modNameEn;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $modUrl;

    /**
     * 
     *
     * @Column()
     * @var int
     */
    public $isSuper;

    /**
     * 是否开放给用户
     *
     * @Column()
     * @var int|null
     */
    public $isOpen;

    /**
     * 
     *
     * @Column()
     * @var int
     */
    public $sort;


    /**
     * @param int|null $mId
     * @return self
     */
    public function setMId(?int $mId): self
    {
        $this->mId = $mId;

        return $this;
    }

    /**
     * @param int|null $groupId
     * @return self
     */
    public function setGroupId(?int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @param string|null $modName
     * @return self
     */
    public function setModName(?string $modName): self
    {
        $this->modName = $modName;

        return $this;
    }

    /**
     * @param string|null $modNameEn
     * @return self
     */
    public function setModNameEn(?string $modNameEn): self
    {
        $this->modNameEn = $modNameEn;

        return $this;
    }

    /**
     * @param string|null $modUrl
     * @return self
     */
    public function setModUrl(?string $modUrl): self
    {
        $this->modUrl = $modUrl;

        return $this;
    }

    /**
     * @param int $isSuper
     * @return self
     */
    public function setIsSuper(int $isSuper): self
    {
        $this->isSuper = $isSuper;

        return $this;
    }

    /**
     * @param int|null $isOpen
     * @return self
     */
    public function setIsOpen(?int $isOpen): self
    {
        $this->isOpen = $isOpen;

        return $this;
    }

    /**
     * @param int $sort
     * @return self
     */
    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMId(): ?int
    {
        return $this->mId;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @return string|null
     */
    public function getModName(): ?string
    {
        return $this->modName;
    }

    /**
     * @return string|null
     */
    public function getModNameEn(): ?string
    {
        return $this->modNameEn;
    }

    /**
     * @return string|null
     */
    public function getModUrl(): ?string
    {
        return $this->modUrl;
    }

    /**
     * @return int
     */
    public function getIsSuper(): int
    {
        return $this->isSuper;
    }

    /**
     * @return int|null
     */
    public function getIsOpen(): ?int
    {
        return $this->isOpen;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

}
