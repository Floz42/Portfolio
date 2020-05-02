<?php

namespace App\Service;

use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Pagination class
 * 
 * After instanciation we MUST pass the entity selected
 */
class PaginationService {
    /**
     * Name of entity to do the pagination
     *
     * @var string
     */
    private $entityClass;

    /**
     * Number of saves
     *
     * @var integer
     */
    private $limit = 10;

    /**
     * The currentpage (generally 1)
     *
     * @var integer
     */
    private $currentPage = 1;

    /**
     *
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * Generate twig template
     *
     * @var Twig\Environment
     */
    private $twig;

    /**
     * The name of route used to the pagination
     *
     * @var string
     */
    private $route;

    /**
     * Path of template who contain the pagination
     *
     * @var string
     */
    private $templatePath;

    /**
     *
     * @param EntityManagerInterface $manager
     * @param Environment $twig
     * @param RequestStack $request
     * @param string $templatePath
     */
    public function __construct(EntityManagerInterface $manager, Environment $twig, RequestStack $request, string $templatePath) {
        $this->route        = $request->getCurrentRequest()->attributes->get('_route');        
        $this->manager      = $manager;
        $this->twig         = $twig;
        $this->templatePath = $templatePath;
    }

    /**
     * To generate the renderer of pagination
     * 
     * @return void
     */
    public function display() {
        $this->twig->display($this->templatePath, [
            'page'  => $this->currentPage,
            'pages' => $this->getPages(),
            'route' => $this->route
        ]);
    }

    /**
     * To get the total of page to an entity
     * 
     * @throws Exception if property $entityClass is undefined
     * 
     * @return int
     */
    public function getPages(): int {
        if(empty($this->entityClass)) {
            throw new \Exception("Vous n'avez pas spécifié l'entité sur laquelle nous devons paginer ! Utilisez la méthode setEntityClass() de votre objet PaginationService !");
        }

        $total = count($this->manager
                        ->getRepository($this->entityClass)
                        ->findAll());

        return ceil($total / $this->limit);
    }

    /**
     * To get the data for the entity specified
     * 
     * @throws Exception if property $entityClass is undefined
     *
     * @return array
     */
    public function getData() {
        if(empty($this->entityClass)) {
            throw new \Exception("Vous n'avez pas spécifié l'entité sur laquelle nous devons paginer ! Utilisez la méthode setEntityClass() de votre objet PaginationService !");
        }
        $offset = $this->currentPage * $this->limit - $this->limit;

        return $this->manager
                        ->getRepository($this->entityClass)
                        ->findBy([], [], $this->limit, $offset);
    }

    public function setCurrentPage(int $page): self {
        $this->currentPage = $page;

        return $this;
    }

    public function getCurrentPage(): int {
        return $this->currentPage;
    }

    public function setLimit(int $limit): self {
        $this->limit = $limit;

        return $this;
    }

    public function getLimit(): int {
        return $this->limit;
    }

    public function setEntityClass(string $entityClass): self {
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getEntityClass(): string {
        return $this->entityClass;
    }

    public function setTemplatePath(string $templatePath): self {
        $this->templatePath = $templatePath;

        return $this;
    }

    public function getTemplatePath(): string {
        return $this->templatePath;
    }

    public function setRoute(string $route): self {
        $this->route = $route;

        return $this;
    }

    public function getRoute(): string {
        return $this->route;
    }
}