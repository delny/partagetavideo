<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Video;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * VideoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VideoRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $url
     * @return mixed
     */
    public function getVideoByUrl($url)
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->andWhere('v.url = :url')
            ->setParameter(':url', $url)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return array
     */
    public function getTopVideos()
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->andWhere('v.isActive = :isActive')
            ->andWhere('v.count > :count')
            ->setParameters([':isActive' => 1,':count' => 2])
            ->addOrderBy('v.count', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $nom
     * @return array
     */
    public function lookForVideos($nom)
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->andWhere('v.isActive = :isActive')
            ->andWhere('v.titre LIKE :nom')
            ->setParameters([':isActive' => 1,':nom' => '%'.$nom.'%'])
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function getReportedVideos()
    {
        $tableVideo = $this->getClassMetadata()->getTableName();

        $sql = 'SELECT v.*, COUNT(adresse_ip) AS total ';
        $sql .= 'FROM '.$tableVideo.' As v JOIN signalement AS s ON v.id = s.video_id ';
        $sql .= 'GROUP BY v.id ';
        $sql .= 'ORDER BY total DESC';

        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addEntityResult(Video::class, 'v');

        // On mappe le nom de chaque colonne en base de données sur les attributs de nos entités
        foreach ($this->getClassMetadata()->fieldMappings as $obj) {
            $rsm->addFieldResult("u", $obj["columnName"], $obj["fieldName"]);
        }

        $stmt = $this->getEntityManager()->createNativeQuery($sql, $rsm);

        return $stmt->getResult();
    }
}
