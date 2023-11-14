<?php
namespace TimDreier\TdReadingTime\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class EstimateReading implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $body = $response->getBody()->__toString();

        $cache = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Cache\CacheManager::class)->getCache('readingtime_cache');

        $cache_identifier = hash('sha256', serialize($GLOBALS['TSFE']->pageArguments));

        if (isset($GLOBALS['EXT']['TdReadingTime']['stringgroup'])) {
            $replacementArray = \TimDreier\TdReadingTime\Service\EstimateReadingService::getReplacementArray();
            $cache->set($cache_identifier, $replacementArray, [], 60*60*24*7);
        } else {
            $replacementArray = $cache->get($cache_identifier);
        }
        $body = str_replace($replacementArray['search'] ?? '', $replacementArray['replace'] ?? '', $body);

        return new HtmlResponse($body);
    }
}
