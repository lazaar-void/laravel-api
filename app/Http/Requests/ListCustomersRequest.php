<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListCustomersRequest extends FormRequest
{
    public function authorize(): bool
    {
        // On retourne true car l'autorisation est déjà gérée par le middleware auth.basic
        return true;
    }

    public function rules(): array
    {
        return [
            // Sécurité sur la pagination (bloque les requêtes demandant 1 million de lignes)
            'page.number' => ['nullable', 'integer', 'min:1'],
            'page.size'   => ['nullable', 'integer', 'min:1', 'max:100'], // Maximum 100 résultats par page

            // Validation des filtres autorisés
            'filter.first_name' => ['nullable', 'string', 'max:100'],
            'filter.last_name'  => ['nullable', 'string', 'max:100'],
            'filter.email'      => ['nullable', 'string', 'email', 'max:255'],

            // Validation du tri
            'sort' => ['nullable', 'string'],
        ];
    }
}
