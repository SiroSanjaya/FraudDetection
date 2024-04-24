<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'salutation', 'first_name', 'last_name', 'email', 'phone_number',
        'kota', 'provinsi', 'address', 'NIK', 'NPWP', 'status', 'source', 'created_by', 'score'
    ];

    /**
     * Calculate the lead's score based on field completeness.
     * Ensure that the score does not exceed 100.
     *
     * @return int
     */
    public function calculateScore()
    {
        $fields = [
            $this->salutation, $this->first_name, $this->last_name, $this->email,
            $this->phone_number, $this->kota, $this->provinsi, $this->address,
            $this->NIK, $this->NPWP, $this->status, $this->source
        ];

        $score = 0;
        $allFieldsFilled = true;

        foreach ($fields as $field) {
            if (!is_null($field) && $field !== '') {
                $score += 2;  // Add 2 points for each non-null field
            } else {
                $allFieldsFilled = false;  // If any field is empty, set this to false
            }
        }

        if ($allFieldsFilled) {
            $score += 10;  // Add a bonus of 10 points if all fields are filled
        }

        // Ensure the score does not exceed 100
        return min($score, 100);
    }

    /**
     * Update the score of the lead in the database.
     * Ensure that the score is recalculated and saved.
     */
    public function updateScore()
    {
        $this->score = $this->calculateScore();  // Call calculateScore to compute the score
        $this->save();  // Save the updated score to the database
    }

    // Model Relationships

    public function survey()
    {
        return $this->hasOne(Survey::class);
    }
}
