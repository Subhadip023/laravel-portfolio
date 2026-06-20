<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $fillable = ['name', 'svg_html'];

    /**
     * Render the full HTML/SVG icon, dynamically injecting classes.
     */
    public function render(string $classes = 'w-5 h-5'): string
    {
        $html = trim($this->svg_html);

        // If it's a full SVG tag, handle class injection
        if (stripos($html, '<svg') === 0) {
            // Check if the SVG tag already contains a class attribute
            if (preg_match('/<svg[^>]*class=["\']([^"\']*)["\']/', $html)) {
                // Replace the existing class attribute with the custom classes
                return preg_replace('/class=["\']([^"\']*)["\']/', 'class="' . e($classes) . '"', $html, 1);
            } else {
                // Inject the class attribute right after the <svg tag opening
                return preg_replace('/<svg/', '<svg class="' . e($classes) . '"', $html, 1);
            }
        }

        return $html;
    }
}
