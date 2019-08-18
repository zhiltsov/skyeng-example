<?php

namespace Component\Data;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Провайдер для сервиса X
 *
 * Class DataProvider
 * @package Component\Data
 */
class DataProvider implements DataInterface
{
    const HTTP_TIMEOUT = 2;

    /** @var string */
    private $host;

    /** @var string */
    private $user;

    /** @var string */
    private $password;

    /** @var string */
    private $httpClient;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = rtrim($host, '/');
        $this->user = $user;
        $this->password = $password;

        $this->httpClient = new Client(['timeout' => self::HTTP_TIMEOUT]);
    }

    /**
     * Производит запрос
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function getRequest(RequestInterface $request)
    {
        return $this->httpClient->send($request);
    }

    /**
     * Формирует запрос и возвращает результат
     *
     * @param array $params
     * @return DataItem
     * @throws \HttpException
     */
    public function get(array $params = [])
    {
        try {
            /** @var ResponseInterface $response */
            $response = $this->getRequest(
                new Request('GET', $this->host . '/?' . http_build_query($params))
            );

            if ($response->getStatusCode() >= 400) {
                throw new \HttpResponseException($response->getReasonPhrase(), $response->getStatusCode());
            }

            $content = $response->getBody()->getContents();
            $result = $content
                ? \GuzzleHttp\json_decode($content, true)
                : null;

            return is_array($result)
                ? DataItem::arrayMap($result)
                : null;
        } catch (GuzzleException $e) {
            throw new \HttpException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}
