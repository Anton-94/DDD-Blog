<?php

declare(strict_types=1);

namespace App\Blog\Domain\Model\Article\Comment;

use App\Blog\Domain\Model\Article\Article;
use App\Blog\Domain\Model\Commentator\CommentatorId;
use App\Shared\Domain\Model\DatesTrait;
use App\Shared\Domain\Model\IdTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('blog_comment')]
#[ORM\HasLifecycleCallbacks]
class Comment
{
    use IdTrait;
    use DatesTrait;

    #[ORM\Column(type: 'comment_content')]
    private Content $content;

    #[ORM\Column(type: 'uuid')]
    private CommentatorId $commentatorId;

    #[ORM\ManyToOne(targetEntity: Article::class)]
    private Article $article;

    public function __construct(CommentatorId $commentatorId, Content $content, Article $article)
    {
        $this->commentatorId = $commentatorId;
        $this->content = $content;
        $this->article = $article;
    }

    public function content(): Content
    {
        return $this->content;
    }

    public function commentatorId(): CommentatorId
    {
        return $this->commentatorId;
    }
}
