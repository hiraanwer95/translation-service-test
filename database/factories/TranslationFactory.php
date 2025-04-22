<?php

// database/factories/TranslationFactory.php

namespace Database\Factories;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    public function definition()
    {
        static $index = 1;

        return [
            'key' => 'key_' . $index++, // guaranteed to be unique
            'locale' => $this->faker->randomElement(['en', 'fr', 'es']),
            'content' => $this->faker->sentence(),
        ];
    }
}
