<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor\Service;

use Bolt\Configuration\Config;

final class TaxonomyService
{

    private function getEditableTaxonomies(Config $config): array
    {
        $all_taxonomies = $this->config->get('taxonomies');
        $taxonomies     = [];

        // Remove behaves_like tags
        if (!empty($all_taxonomies) && is_array($all_taxonomies)) {
            foreach ($all_taxonomies as $taxonomy) {
                if (!empty($taxonomy['behaves_like']) && $taxonomy['behaves_like'] !== 'tags') {
                    $taxonomies[] = $taxonomy;
                }
            }
        }

        // Sort Taxonomies by name
        usort($taxonomies, function ($a, $b) {

            if ($a['name'] == $b['name']) {
                return 0;
            }

            return ($a['name'] < $b['name']) ? -1 : 1;
        });

        return $taxonomies;
    }
}
