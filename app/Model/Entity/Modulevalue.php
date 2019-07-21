<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class Modulevalue
 *
 * @since 2.0
 *
 * @Entity(table="modulevalue")
 */
class Modulevalue extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     * @var int|null
     */
    public $vId;

    /**
     * 
     *
     * @Column()
     * @var int|null
     */
    public $mId;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $vName;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $vEnName;

    /**
     * 
     *
     * @Column()
     * @var int
     */
    public $sort;


    /**
     * @param int|null $vId
     * @return self
     */
    public function setVId(?int $vId): self
    {
        $this->vId = $vId;

        return $this;
    }

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
     * @param string|null $vName
     * @return self
     */
    public function setVName(?string $vName): self
    {
        $this->vName = $vName;

        return $this;
    }

    /**
     * @param string|null $vEnName
     * @return self
     */
    public function setVEnName(?string $vEnName): self
    {
        $this->vEnName = $vEnName;

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
    public function getVId(): ?int
    {
        return $this->vId;
    }

    /**
     * @return int|null
     */
    public function getMId(): ?int
    {
        return $this->mId;
    }

    /**
     * @return string|null
     */
    public function getVName(): ?string
    {
        return $this->vName;
    }

    /**
     * @return string|null
     */
    public function getVEnName(): ?string
    {
        return $this->vEnName;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

}
