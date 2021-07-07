<?php declare(strict_types=1);

namespace SwagTraining\DealersStorefront\Controller;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SwagTraining\DealersCore\Core\Content\Dealer\DealerCollection;

/**
 * Class IndexController
 * @package SwagTraining\DealersStorefront\Controller
 */
class IndexController extends StorefrontController
{
    /**
     * @var EntityRepositoryInterface
     */
    private EntityRepositoryInterface $dealerRepository;

    /**
     * ExampleController constructor.
     * @param EntityRepositoryInterface $dealerRepository
     */
    public function __construct(EntityRepositoryInterface $dealerRepository)
    {
        $this->dealerRepository = $dealerRepository;
    }

    /**
     * @RouteScope(scopes={"storefront"})
     * @Route("/dealers", name="frontend.dealers.index", options={"seo"="false"}, methods={"GET"})
     */
    public function showPage(Request $request, Context $context): Response
    {
        return $this->renderStorefront(
            '@SwagTrainingDealersStorefront/storefront/page/index.html.twig',
            [
                'dealers' => $this->getDealers($context)
            ]
        );
    }

    /**
     * @param Context $context
     * @return DealerCollection
     */
    private function getDealers(Context $context): DealerCollection
    {
        $searchResult = $this->dealerRepository->search(new Criteria(), $context);
        return $searchResult->getEntities();
    }
}
