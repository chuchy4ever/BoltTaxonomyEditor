<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor\Service;

use Bolt\Collection\DeepCollection;
use Bolt\Configuration\Config;

final class TaxonomyEditorService
{

    public function getTaxonomies(Config $config): array
    {
        $taxonomies = [];
        /** @var DeepCollection|null $taxonomyTypes */
        $taxonomyTypes = $config->get('taxonomies');
        if ($taxonomyTypes !== null) {
            foreach ($taxonomyTypes->toArray() as $taxonomy) {
                if (!empty($taxonomy['behaves_like']) && $taxonomy['behaves_like'] !== 'tags') {
                    $taxonomies[] = $taxonomy;
                }
            }
        }

        usort($taxonomies, function ($a, $b) {
            if ($a['name'] === $b['name']) {
                return 0;
            }

            return ($a['name'] < $b['name']) ? -1 : 1;
        });

        return $taxonomies;
    }
}
