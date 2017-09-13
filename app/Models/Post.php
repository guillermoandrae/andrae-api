<?php

namespace App\Models;

/**
 * @SWG\Definition()
 */
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
     * The ID of the post on the originating platform.
     *
     * @var string
     * @SWG\Property()
     */
    protected $externalId = '';

    /**
     * The name of the originating platform.
     *
     * @var string
     * @SWG\Property()
     */
    protected $source = '';

    /**
     * The post's original author.
     *
     * @var string
     * @SWG\Property()
     */
    protected $originalAuthor = '';

    /**
     * The post title.
     *
     * @var string
     * @SWG\Property()
     */
    protected $title = '';

    /**
     * The post slug.
     *
     * @var string
     * @SWG\Property()
     */
    protected $slug = '';

    /**
     * The post body.
     *
     * @var string
     * @SWG\Property()
     */
    protected $body = '';

    /**
     * The post summary.
     *
     * @var string
     * @SWG\Property()
     */
    protected $summary = '';

    /**
     * A description of the post.
     *
     * @var string
     * @SWG\Property()
     */
    protected $description = '';

    /**
     * The link to the post on the originating platform.
     *
     * @var string
     * @SWG\Property()
     */
    protected $htmlUrl = '';

    /**
     * The link to the post thumbnail image.
     *
     * @var string
     * @SWG\Property()
     */
    protected $thumbnailUrl = '';

    /**
     * The human-friendly relative date of the post.
     *
     * @var string
     * @SWG\Property()
     */
    protected $relativeCreatedAt = '';

    /**
     * The action link.
     *
     * @var string
     * @SWG\Property()
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
