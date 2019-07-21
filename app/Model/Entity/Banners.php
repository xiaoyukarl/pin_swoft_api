<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class Banners
 *
 * @since 2.0
 *
 * @Entity(table="banners")
 */
class Banners extends Model
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
    public $bannerName;

    /**
     * 
     *
     * @Column()
     * @var int|null
     */
    public $bannerTypeId;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    public $bannerUrl;

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
    public $img;

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
     * @param string|null $bannerName
     * @return self
     */
    public function setBannerName(?string $bannerName): self
    {
        $this->bannerName = $bannerName;

        return $this;
    }

    /**
     * @param int|null $bannerTypeId
     * @return self
     */
    public function setBannerTypeId(?int $bannerTypeId): self
    {
        $this->bannerTypeId = $bannerTypeId;

        return $this;
    }

    /**
     * @param string|null $bannerUrl
     * @return self
     */
    public function setBannerUrl(?string $bannerUrl): self
    {
        $this->bannerUrl = $bannerUrl;

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
     * @param string|null $img
     * @return self
     */
    public function setImg(?string $img): self
    {
        $this->img = $img;

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
    public function getBannerName(): ?string
    {
        return $this->bannerName;
    }

    /**
     * @return int|null
     */
    public function getBannerTypeId(): ?int
    {
        return $this->bannerTypeId;
    }

    /**
     * @return string|null
     */
    public function getBannerUrl(): ?string
    {
        return $this->bannerUrl;
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
    public function getImg(): ?string
    {
        return $this->img;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

}
