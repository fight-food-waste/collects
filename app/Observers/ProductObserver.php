<?php

namespace App\Observers;

use App\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\CategoryTranslation;
use App\Category;
use Exception;

class ProductObserver
{
    /**
     * Handle the product "creating" event.
     * Get product info from OpenFoodFacts
     *
     * @param Product $product
     * @return void
     * @throws Exception
     */
    public function creating(Product $product)
    {
        try {
            $client = new Client();
            $url = "https://world.openfoodfacts.org/api/v0/product/" . $product->barcode . "json";
            $response = $client->request('GET', $url);
            $product_details = (string) $response->getBody();

            $product_info = json_decode($product_details, true)['product'];

            // Get product weight if available, else default to 200g
            if (array_key_exists('product_quantity', $product_info)) {
                $product_weight = intval($product_info['product_quantity']);
            } else {
                $product_weight = 200;
            }

            $product->details = $product_details;
            $product->weight = $product_weight;

        } catch (GuzzleException $e) {
            throw new Exception('Could not contact OpenFoodFacts. Error: ' . $e->getMessage());
        }
    }

    /**
     * Handle the product "created" event.
     * Fetch, create and attach categories to product
     *
     * @param Product $product
     * @return void
     */
    public function created(Product $product)
    {
        $product_info = json_decode($product->details, true)['product'];

        $categories = [];

        foreach ($product_info['categories_tags'] as $category) {
            $categoryAttributes = explode(':', $category);
            $categoryLang = $categoryAttributes[0];
            $categoryName = $categoryAttributes[1];

            // Store category if it doesn't already exist
            $translation = CategoryTranslation::firstOrNew([
                'name' => $categoryName,
                'lang' => $categoryLang,
            ]);

            if ($translation->category_id === null) {
                $cat = Category::create();

                $translation->category_id = $cat->id;
                $translation->save();
            } else {
                $cat = Category::findOrFail($translation->category_id);
            }

            array_push($categories, $cat->id);
        }

        $product->categories()->attach($categories);
    }

}
