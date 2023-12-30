<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor\Controller;

use Bolt\Controller\Backend\BackendZoneInterface;
use Bolt\Controller\TwigAwareController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy-editor")
 */
final class TaxonomyEditorController extends TwigAwareController implements BackendZoneInterface
{
	/**
	 * @Route(name="taxonomy_editor_list", methods={'GET'})
	 */
	public function list(): Response
	{
		return $this->render('taxonomy_editor_list.html.twig', [
		 'title' => 'User content'
		]);
	}

}
