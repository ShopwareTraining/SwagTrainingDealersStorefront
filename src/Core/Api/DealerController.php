<?php declare(strict_types=1);

namespace Yireo\ExampleDealersStorefront\Core\Api;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Recovery\Common\HttpClient\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes="{storefront}")
 */
class DealerController extends AbstractController
{
    /**
     * @var EntityRepositoryInterface
     */
    private $dealerRepository;

    /**
     * DealerController constructor.
     * @param EntityRepositoryInterface $dealerRepository
     */
    public function __construct(EntityRepositoryInterface $dealerRepository)
    {
        $this->dealerRepository = $dealerRepository;
    }

    /**
     * @Route("/store-api/v{version}/dealers/index", name="api.action.dealers.index", methods={"GET"})
     */
    public function getDealers(Request $request, Context $context): Response
    {
        $searchResult = $this->dealerRepository->search(new Criteria(), Context::createDefaultContext());
    }
}
