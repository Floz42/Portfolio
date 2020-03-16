<?php

namespace App\Service;

use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Classe de pagination qui extrait toute notion de calcul et de récupération de données de nos controllers
 * 
 * Elle nécessite après instanciation qu'on lui passe l'entité sur laquelle on souhaite travailler
 */
class PaginationService {
    /**
     * Le nom de l'entité sur laquelle on veut effectuer une pagination
     *
     * @var string
     */
    private $entityClass;

    /**
     * Le nombre d'enregistrement à récupérer
     *
     * @var integer
     */
    private $limit = 10;

    /**
     * La page sur laquelle on se trouve actuellement
     *
     * @var integer
     */
    private $currentPage = 1;

    /**
     * Le manager de Doctrine qui nous permet notamment de trouver le repository dont on a besoin
     *
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * Le moteur de template Twig qui va permettre de générer le rendu de la pagination
     *
     * @var Twig\Environment
     */
    private $twig;

    /**
     * Le nom de la route que l'on veut utiliser pour les boutons de la navigation
     *
     * @var string
     */
    private $route;

    /**
     * Le chemin vers le template qui contient la pagination
     *
     * @var string
     */
    private $templatePath;

    /**
     * Constructeur du service de pagination qui sera appelé par Symfony
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
     * Permet d'afficher le rendu de la navigation au sein d'un template twig !
     * 
     * @return void
     */
    public function display() {
        $this->twig->display($this->templatePath, [
            'page' => $this->currentPage,
            'pages' => $this->getPages(),
            'route' => $this->route
        ]);
    }

    /**
     * Permet de récupérer le nombre de pages qui existent sur une entité particulière
     * 
     * @throws Exception si la propriété $entityClass n'est pas configurée
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
     * Permet de récupérer les données paginées pour une entité spécifique
     * 
     * @throws Exception si la propriété $entityClass n'est pas définie
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