<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 拼车信息表
 * Class Orders
 *
 * @since 2.0
 *
 * @Entity(table="orders")
 */
class Orders extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     * @var int|null
     */
    private $id;

    /**
     * 类型 1找车，2找人
     *
     * @Column()
     * @var int|null
     */
    private $type;

    /**
     * 
     *
     * @Column()
     * @var int|null
     */
    private $userId;

    /**
     * 
     *
     * @Column()
     * @var string
     */
    private $title;

    /**
     * 出发城市
     *
     * @Column()
     * @var string|null
     */
    private $destCity;

    /**
     * 目的城市
     *
     * @Column()
     * @var string|null
     */
    private $starCity;

    /**
     * 出发时间
     *
     * @Column()
     * @var string|null
     */
    private $departureTime;

    /**
     * 电话
     *
     * @Column()
     * @var string|null
     */
    private $telephone;

    /**
     * 备注
     *
     * @Column()
     * @var string|null
     */
    private $content;

    /**
     * 照片
     *
     * @Column()
     * @var string|null
     */
    private $img;

    /**
     * 1有效 2无效
     *
     * @Column()
     * @var int|null
     */
    private $enable;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    private $createTime;


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
     * @param int|null $type
     * @return self
     */
    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param int|null $userId
     * @return self
     */
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string|null $destCity
     * @return self
     */
    public function setDestCity(?string $destCity): self
    {
        $this->destCity = $destCity;

        return $this;
    }

    /**
     * @param string|null $starCity
     * @return self
     */
    public function setStarCity(?string $starCity): self
    {
        $this->starCity = $starCity;

        return $this;
    }

    /**
     * @param string|null $departureTime
     * @return self
     */
    public function setDepartureTime(?string $departureTime): self
    {
        $this->departureTime = $departureTime;

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
     * @param string|null $content
     * @return self
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

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
     * @param int|null $enable
     * @return self
     */
    public function setEnable(?int $enable): self
    {
        $this->enable = $enable;

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
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDestCity(): ?string
    {
        return $this->destCity;
    }

    /**
     * @return string|null
     */
    public function getStarCity(): ?string
    {
        return $this->starCity;
    }

    /**
     * @return string|null
     */
    public function getDepartureTime(): ?string
    {
        return $this->departureTime;
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
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @return string|null
     */
    public function getImg(): ?string
    {
        return $this->img;
    }

    /**
     * @return int|null
     */
    public function getEnable(): ?int
    {
        return $this->enable;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

}
