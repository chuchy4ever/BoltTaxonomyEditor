<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor\Controller;

use Bolt\Controller\Backend\BackendZoneInterface;
use Bolt\Controller\TwigAwareController;
use Chuchy4ever\TaxonomyEditor\Service\TaxonomyEditorService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy-editor")
 */
final class TaxonomyEditorController extends TwigAwareController implements BackendZoneInterface
{

    private TaxonomyEditorService $taxonomyEditorService;

    public function __construct(TaxonomyEditorService $taxonomyEditorService)
    {
        $this->taxonomyEditorService = $taxonomyEditorService;
    }

    /**
	 * @Route("", name="taxonomy_editor_index", methods={"GET"})
	 */
	public function index(): Response
	{
        $config = $this->config;

		return $this->render('@taxonomy-editor/index.html.twig', [
             'taxonomy_config' => $config,
             'taxonomies' => $this->taxonomyEditorService->getTaxonomies($config),
		]);
	}
}
