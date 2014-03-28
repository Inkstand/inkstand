<?php


class PeerreviewLibrary 
{
	public function getReviewList() {
		// return list of reviews
		return DB::query("SELECT * FROM course_peerreview");
	}
	public function getReview($id) {
		return DB::query("SELECT * FROM course_peerreview WHERE id = %i", $id);
	}
}

?>