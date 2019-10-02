<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use App\Controller\CreateArticleComment;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ApiResource(
 *     collectionOperations={
 *          "get",
 *          "post_comment"={
 *                  "method"="POST",
 *                  "path"="/articles/{id}/comments",
 *                  "requirements"={"id"="\d+"},
 *                  "controller"=CreateArticleComment::class,
 *                  "swagger_context"= {
 *                      "summary"= "Commenter un article",
 *                      "description"= "Permet d'ajouter un commentaire à un article",
 *                  },
 *           },
 *     },
 *
 *     itemOperations={
 *          "delete",
 *          "get",
 *          "put"={
 *                  "method"="PUT",
 *                  "path"="/articles/{article_id}/comments/{id}",
 *                  "requirements"={"article_id"="\d+", "id"="\d+"},
 *                  "swagger_context"= {
 *                      "summary"= "Mettre à jour le commentaire d'un article",
 *                      "description"= "Permet de mettre àjour un commentaire dans un article",
 *                  },
 *           },
 *     },
 *
 *     subresourceOperations={
 *       "api_articles_comment_get_subresource"={
 *           "method"="GET",
 *           "normalization_context"={"groups"={"read"}}
 *       },
 *       "api_articles_comment_post_subresource"={
 *           "method"="POST",
 *           "denormalization_context"={"groups"={"write"}}
 *       }
 *    },
 *
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")

 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"articles"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"articles"})
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"articles"})
     *
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     * @Groups({"articles"})
     */
    private $isPublished = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }


    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

}
