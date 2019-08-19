<?php

namespace Component\Data;

interface DataInterface
{
    /**
     * Формирует запрос и возвращает результат
     *
     * @param array $params
     * @return DataItem|null
     * @throws \HttpException
     */
    public function get(array $params = []);
}
