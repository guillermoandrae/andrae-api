<?php

namespace App\Models;

final class Post extends AbstractModel
{
    /**
     * @const string
     */
    const SOURCE_TWITTER = 'Twitter';

    /**
     * @const string
     */
    const SOURCE_SPOTIFY = 'Spotify';

    /**
     * @const string
     */
    const SOURCE_GITHUB = 'GitHub';

    /**
     * @const string
     */
    const SOURCE_PINTEREST = 'Pinterest';

    /**
     * @const string
     */
    const SOURCE_INSTAGRAM = 'Instagram';

    /**
     * @var string
     */
    protected $externalId = '';

    /**
     * @var string
     */
    protected $source = '';

    /**
     * @var string
     */
    protected $originalAuthor = '';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $slug = '';

    /**
     * @var string
     */
    protected $body = '';

    /**
     * @var string
     */
    protected $summary = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $htmlUrl = '';

    /**
     * @var string
     */
    protected $thumbnailUrl = '';

    /**
     * @var string
     */
    protected $relativeCreatedAt = '';

    /**
     * @var string
     */
    protected $action = '';

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getOriginalAuthor(): string
    {
        return $this->originalAuthor;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @return string
     */
    public function getHtmlUrl(): string
    {
        return $this->htmlUrl;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @return string
     */
    public function getRelativeCreatedAt(): string
    {
        return $this->relativeCreatedAt;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
