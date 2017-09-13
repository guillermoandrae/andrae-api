<?php

namespace App\Models;

abstract class AbstractModel implements ModelInterface
{
    /**
     * The ID.
     *
     * @var string
     * @SWG\Property()
     */
    protected $id = '';

    /**
     * The creation date.
     *
     * @var \DateTime
     * @SWG\Property()
     */
    protected $createdAt;

    /**
     * @param array|null $data
     */
    final public function __construct(array $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return string
     */
    final public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    final public function getCreatedAt(): \DateTime
    {
        if (!$this->createdAt) {
            return new \DateTime();
        }
        return $this->createdAt;
    }

    /**
     * @return array
     */
    final public function toArray()
    {
        $properties = [];
        $reflectedProperties = (new \ReflectionObject($this))->getProperties();
        foreach ($reflectedProperties as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($this);
            if (is_a($value, \DateTime::class)) {
                $value = $value->format(DATE_ATOM);
            }
            $properties[$property->getName()] = $value;
        }
        return $properties;
    }
}
