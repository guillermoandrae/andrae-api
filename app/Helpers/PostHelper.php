<?php

namespace App\Helpers;

use App\Models\Post;
use Carbon\Carbon;
use ICanBoogie\Inflector;

class PostHelper
{
    /**
     * @const string
     */
    const TRUNCATED_SUMMARY_LENGTH = 50;

    /**
     * @param string $body
     * @return string
     */
    public static function getSummary($body): string
    {
        if (strlen($body) <= self::TRUNCATED_SUMMARY_LENGTH) {
            return $body;
        }
        return substr_replace($body, '...', self::TRUNCATED_SUMMARY_LENGTH);
    }

    /**
     * @param string $id
     * @param string $url
     * @return string
     */
    public static function getAction($id, $url): string
    {
        return sprintf(
            '<a href="/post/%s">%s</a> + <a target="_blank" href="%s">%s</a>',
            $id,
            'Here',
            $url,
            'There'
        );
    }

    /**
     * @param string $source
     * @param string $body
     * @return mixed
     */
    public static function getTitle($source, $body)
    {
        switch ($source) {
            case Post::SOURCE_TWITTER:
            case Post::SOURCE_GITHUB:
            case Post::SOURCE_SPOTIFY:
            case Post::SOURCE_PINTEREST:
            case Post::SOURCE_INSTAGRAM:
                return sprintf('%s - %s', $source, self::getSummary($body));
        }
    }

    /**
     * @param string $source
     * @param string $body
     * @return string
     */
    public static function getSlug($source, $body): string
    {
        switch ($source) {
            case Post::SOURCE_TWITTER:
            case Post::SOURCE_GITHUB:
            case Post::SOURCE_SPOTIFY:
            case Post::SOURCE_PINTEREST:
            case Post::SOURCE_INSTAGRAM:
                $string = str_replace(array('[\', \']'), '', self::getSummary($body));
                $string = preg_replace('/\[.*\]/U', '', $string);
                $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
                $string = htmlentities($string, ENT_COMPAT, 'utf-8');
                $string = preg_replace(
                    '/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i',
                    '\\1',
                    $string
                );
                $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
                return Inflector::get()->hyphenate(trim($string, '-'));
        }
    }

    /**
     * @param string $body
     * @return string
     */
    public static function getDescription($body): string
    {
        return self::getSummary($body);
    }
}
