<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserVerificationScore;

class UserScoreEvaluator
{
    /**
     * @var User $user
     */
    protected User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Evaluating User Score
     * @return float
     */
    public function evaluate()
    {
        $UserVerificationScoreObj = new UserVerificationScore();
        $criteriaWeights = $UserVerificationScoreObj->getCriteriaWeights();
        $totalWeight = array_sum($criteriaWeights);

        $score = 0;
        foreach ($criteriaWeights as $criteria => $weight) {
            // Evaluate the user's score for this/these criteria
            // You would implement this logic based on your specific criteria
            $criteriaScore = $this->evaluateCriteria($criteria);

            // Add the criteria score to the overall score, weighted by the criteria weight
            $score += ($criteriaScore / 100) * $weight;
        }

        // Return the final score as a percentage
        return round(($score / $totalWeight) * 100);
    }

    /**
     * Save Evaluated User Score
     * @return bool
     */
    public function updateScore(): bool
    {
        $this->user->score = $this->evaluate();
        return $this->user->save();
    }

    /**
     * Calcualtion Score of each criterion
     * @param int|string $criteria
     * @return int|void
     */
    private function evaluateCriteria(int|string $criteria)
    {
        switch ($criteria) {
            case "User profile uploaded":
                return $this->user->profileImage()->first() ? 100 : 0;
                break;
            case "Header Image uploaded":
                return $this->user->headerImage()->first() ? 100 : 0;
                break;
            case "First name and Last name setted":
                return ($this->user->fname ? 50 : 0) + ($this->user->lname ? 50 : 0);
                break;
            case "Verification email address":
                return $this->user->email_verified_at ? 100 : 0;
                break;
            case "Job criteria setted":
                return $this->user->title ? 100 : 0;
                break;
            case "Gender":
                return $this->user->sex ? 100 : 0;
                break;
            case "About me":
                return strlen($this->user->about_me) > 100 ? 100 : 0;
                break;
            case "Passport Scan":
                return $this->user->userDocuments()->count() > 0 ? 100 : 0;
                break;
            case "Education Background":
                return $this->user->userEducations()->count() > 0 ? 100 : 0;
                break;
            case "Work Experience":
                return $this->user->userCompanies()->count() > 0 ? 100 : 0;
                break;
            case "Social media":
                return $this->user->socialMedia()->count() > 0 ? 100 : 0;
                break;
            default:
        }
    }
}