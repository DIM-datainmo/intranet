<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Article;
use App\Entity\Comment;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateArticleComment
{

    private $em;
    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * CreateArticleComment constructor.
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Comment $data
     * @param Request $request
     * @return Comment
     */
    public function __invoke(Comment $data, Request $request)
    {
        if(empty($data->getArticle()))
        {
            $article_id = $request->attributes->get('id');
            if (!$article_id) {
                throw new BadRequestHttpException('"id" article is required');
            }
            $article = $this->repository->find($article_id);
            $data->setArticle($article);
        }

        return $data;

    }

}
