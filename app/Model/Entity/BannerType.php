<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * banner类型
 * Class BannerType
 *
 * @since 2.0
 *
 * @Entity(table="banner_type")
 */
class BannerType extends Model
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
    public $typeName;

    /**
     * 
     *
     * @Column()
     * @var int
     */
    public $sort;

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
     * @param string|null $typeName
     * @return self
     */
    public function setTypeName(?string $typeName): self
    {
        $this->typeName = $typeName;

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
    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

}
