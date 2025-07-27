<?php

namespace App\Exceptions;

use App\Models\Material;
use App\Models\Member;
use Exception;

class MaterialAlreadyBorrowedException extends Exception
{
    protected $code = 409;

    public function __construct(
        public readonly Material $material,
        public readonly Member $currentBorrower,
        public readonly \DateTime $borrowedAt
    ) {
        $message = sprintf(
            'Le matériel "%s" (#%d) est déjà emprunté par %s depuis le %s',
            $this->material->name,
            $this->material->id,
            $this->currentBorrower->name,
            $this->borrowedAt->format('d/m/Y H:i')
        );

        parent::__construct($message);
    }

    /**
     * Données pour la réponse API
     */
    public function toArray(): array
    {
        return [
            'error' => 'material_already_borrowed',
            'message' => $this->getMessage(),
            'material' => [
                'id' => $this->material->id,
                'name' => $this->material->name,
            ],
            'current_borrower' => [
                'id' => $this->currentBorrower->id,
                'name' => $this->currentBorrower->name,
            ],
            'borrowed_since' => $this->borrowedAt->format('c'),
        ];
    }
}