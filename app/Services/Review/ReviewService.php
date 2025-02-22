<?php

namespace App\Services\Review;

use App\Repositories\Review\ReviewRepository;

class ReviewService{
   protected $reviewRepo;

   public function __construct(ReviewRepository $reviewRepo){
    $this->reviewRepo=$reviewRepo;
   }

   public function getAllReview(){
    return $this->reviewRepo->getAll();
   }

   public function createReview($data){
    return $this->reviewRepo->create($data);
   }

   public function showReviewById($id){
    return $this->reviewRepo->show($id);
   }

   public function updateReview($data,$id){
    return $this->reviewRepo->update($data,$id);
   }

   public function destroyReviewById($id){
    return $this->reviewRepo->delete($id);
   }
}
