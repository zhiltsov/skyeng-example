<?php

namespace Component\Data;

final class DataItem
{
    /** @var string */
    private $original;

    /** @var string */
    private $md5;

    /**
     * @return string
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Ожидаем MD5 от original
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Отобразить объект как строку
     *
     * @return string
     */
    public function toString()
    {
        return sprintf('Md5 for text "%s" - %s', $this->original, $this->getMd5());
    }

    /**
     * @param array $params
     * @return DataItem
     */
    public static function arrayMap(array $params)
    {
        return new static(
            (string)$params['original'],
            (string)$params['md5']
        );
    }

    /**
     * DataItem constructor.
     * @param string $original
     * @param string $md5
     */
    public function __construct($original, $md5)
    {
        $this->original = $original;
        $this->md5 = $md5;
    }
}
