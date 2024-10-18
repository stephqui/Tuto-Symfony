<?php
//Cette classe sert à récupérer des enregistrements
//On y met les méthodes qui permettent d'extraire des données depuis la BDD
//Dans notre cas, le Repo va récupérer les recettes

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
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
