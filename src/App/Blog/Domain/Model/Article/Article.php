<?php

declare(strict_types=1);

namespace App\Blog\Domain\Model\Article;

use App\Blog\Domain\Enum\Article\StatusEnum;
use App\Blog\Domain\Model\Article\Comment\Comment;
use App\Blog\Domain\Model\Author\AuthorId;
use App\Blog\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Domain\Model\Aggregate;
use App\Shared\Domain\Model\DatesTrait;
use App\Shared\Domain\Model\IdTrait;
use App\Shared\Domain\Model\UuidTrait;
use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepositoryInterface::class)]
#[ORM\Table('blog_article')]
#[ORM\HasLifecycleCallbacks]
class Article extends Aggregate
{
    use IdTrait;
    use UuidTrait;
    use DatesTrait;

    #[ORM\Column(type: 'article_name')]
    private Title $name;

    #[ORM\Column(type: 'article_content')]
    private Content $content;

    #[ORM\Column(type: 'uuid')]
    private AuthorId $authorId;

    #[ORM\Embedded]
    private Status $status;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Comment::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $comments;

    public function __construct(Uuid $uuid, Title $name, Content $content, AuthorId $authorId)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->content = $content;
        $this->authorId = $authorId;
        $this->status = new Status(StatusEnum::DRAFT, new DateTimeImmutable());
        $this->comments = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
    }

    public function name(): Title
    {
        return $this->name;
    }

    public function content(): Content
    {
        return $this->content;
    }

    public function authorId(): AuthorId
    {
        return $this->authorId;
    }

    public function status(): Status
    {
        return $this->status;
    }

    public function publish(): void
    {
        $this->status = new Status(StatusEnum::PUBLISHED, new DateTimeImmutable());
    }

    public function archive(): void
    {
        $this->status = new Status(StatusEnum::ARCHIVED, new DateTimeImmutable());
    }

    /** @return Comment[] */
    public function comments(): array
    {
        return $this->comments->toArray();
    }

    public function addComment(Comment $comment): void
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
        }
    }

    public function removeComment(Comment $comment): void
    {
        $this->comments->removeElement($comment);
    }
}
