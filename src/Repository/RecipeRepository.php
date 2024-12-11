<?php
//Cette classe sert à récupérer des enregistrements
//On y met les méthodes qui permettent d'extraire des données depuis la BDD
//Dans notre cas, le Repo va récupérer les recettes

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function paginateRecipes(int $currentPage):PaginationInterface
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('r')->leftJoin('r.category', 'c')->select('r', 'c'),
            $currentPage,
            2,
            [
                'distinct'=> true,
                'sortFieldAllowList'=>['r.id']
            ]
        );

        /*
        return new Paginator($this
        ->createQueryBuilder('r')
        ->setFirstResult(($currentPage - 1) * $limit)
        ->setMaxResults(2)
        ->getQuery()
        ->setHint(Paginator::HINT_ENABLE_DISTINCT, false),
        false
    );
    */

    }

    public function findTotalDuration()
    {
        return $this->createQueryBuilder('r')
            ->select('SUM(r.duration) as total')
            ->getQuery()
            ->getSingleScalarResult(); //Fonctionne si on n'a qu'une seule ligne de resultat
    }

    /**
     * 
     * @return Recipe[]
     */
    public function findWithDurationLowerThan(int $duration): array
    {
        //Si on veut communiquer avec la base de manière profonde, on utilise le QueryBuilder
        return $this->createQueryBuilder('r')
            ->where('r.duration <= :duration')
            ->orderBy('r.duration', 'ASC')
            ->setMaxResults(10)
            ->setParameter('duration', $duration)
            ->getQuery()
            ->getResult();
    }
}
