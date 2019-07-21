<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class Collect
 *
 * @since 2.0
 *
 * @Entity(table="collect")
 */
class Collect extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     * @var int|null
     */
    private $id;

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
     * @var int|null
     */
    private $orderId;

    /**
     * 1收藏 2取消
     *
     * @Column()
     * @var int
     */
    private $isCollect;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    private $updateTime;

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
     * @param int|null $userId
     * @return self
     */
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param int|null $orderId
     * @return self
     */
    public function setOrderId(?int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @param int $isCollect
     * @return self
     */
    public function setIsCollect(int $isCollect): self
    {
        $this->isCollect = $isCollect;

        return $this;
    }

    /**
     * @param string|null $updateTime
     * @return self
     */
    public function setUpdateTime(?string $updateTime): self
    {
        $this->updateTime = $updateTime;

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
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @return int
     */
    public function getIsCollect(): int
    {
        return $this->isCollect;
    }

    /**
     * @return string|null
     */
    public function getUpdateTime(): ?string
    {
        return $this->updateTime;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

}
