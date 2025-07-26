<?php

namespace App\Rules;

use App\Models\AttributeTranslation;
use Illuminate\Contracts\Validation\Rule;

class UniqueAttributeName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $attributeName;
    private $attributeId;
    public function __construct($attributeName , $attributeId)
    {
        //
        $this->attributeName = $attributeName;
        $this->attributeId = $attributeId;
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
        $query = AttributeTranslation::where('name', $value);

        // Exclude current attribute if updating
        if ($this->attributeId) {
            $query->where('attribute_id', '!=', $this->attributeId);
        }

        return !$query->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'attribute name must be unique';
    }
}
