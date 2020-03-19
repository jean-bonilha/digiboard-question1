<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Image;

class Photo2x4Dimension implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $image = Image::make($value->path());
        $width = $image->width();
        $height = $image->height();
        $dimension = $width / $height;
        return $dimension > 0.74 && $dimension < 0.76 && ($width > 354 || $height > 472);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'As dimensões da imagem :attribute de ser de 3x4 maior que 354x472.';
    }

}
