<?php
namespace EzSystems\CustomizeAdminUIBundle\lib\Form\Data;

use eZ\Publish\Core\Repository\Values\ContentType\ContentType;
use Symfony\Component\Validator\Constraints as Assert;


class CountsContentOfContentTypeData
{
    /**
     * @var ContentType
     */
    private $content_type;
    /** @var array|null */

    /**
     * CountsContentOfContentTypeData constructor.
     *
     * @param int $limit
     * @param int $page
     * @param ContentType|null $content_type
     */
    public function __construct(
        ?ContentType $content_type = null
    ) {
        $this->content_type = $content_type;

    }
    /**
     * @param ContentType|null $content_type
     *
     * @return CountsContentOfContentTypeData
     */
    public function setContentType(?ContentType $content_type): self
    {
        $this->content_type = $content_type;
        return $this;
    }
    /**
     * @return ContentType|null
     */
    public function getContentType(): ?ContentType
    {
        return $this->content_type;
    }
}
