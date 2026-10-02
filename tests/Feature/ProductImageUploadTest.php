<?php

namespace Tests\Feature;

use App\Models\Fournisseur;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductImageUploadTest extends TestCase
{
    public function test_partner_product_accepts_an_image_larger_than_two_megabytes()
    {
        $response = $this->postProductWithImage(UploadedFile::fake()->image('product.png')->size(3 * 1024));

        $response->assertSessionHasErrors(['nom', 'description']);
        $response->assertSessionDoesntHaveErrors(['images.0']);
    }

    public function test_partner_product_accepts_an_image_of_fifty_megabytes()
    {
        $response = $this->postProductWithImage(UploadedFile::fake()->image('product.png')->size(50 * 1024));

        $response->assertSessionHasErrors(['nom', 'description']);
        $response->assertSessionDoesntHaveErrors(['images.0']);
    }

    public function test_partner_product_rejects_an_image_larger_than_fifty_megabytes()
    {
        $response = $this->postProductWithImage(UploadedFile::fake()->image('product.png')->size(50 * 1024 + 1));

        $response->assertSessionHasErrors(['images.0']);
    }

    private function postProductWithImage(UploadedFile $image)
    {
        $user = new User();
        $user->setRelation('partner', new Fournisseur());

        return $this->withoutMiddleware()
            ->actingAs($user)
            ->from('/partner/products/create')
            ->post('/partner/products', ['images' => [$image]]);
    }
}
