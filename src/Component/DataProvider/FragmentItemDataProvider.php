<?php


namespace App\Component\DataProvider;


use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Component\DTO\FragmentDTO;
use App\Entity\Fragment;
use Doctrine\ORM\EntityManagerInterface;

final class FragmentItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var EntityManagerInterface  */
    private $em;

    /**
     * FragmentItemDataProvider constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return FragmentDTO::class === $resourceClass;
    }

    /**
     * @param string $resourceClass
     * @param array|int|string $id
     * @param string|null $operationName
     * @param array $context
     *
     * @return FragmentDTO|null
     * @throws \Exception
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?FragmentDTO
    {
        $fragment =  $this->em->getRepository(Fragment::class)->findOneByUuid($id);

        return (new FragmentDTO())->fromEntity($fragment);
    }

}