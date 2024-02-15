<?php


function percent($sale,$price) {
    return round(($price-$sale)*100/$price);
}
// Helper file

 function getAverageRatingPercentage($reviews)
    {
      if (empty($reviews)) {
        return 0;
    }

    $totalRating = 0;
    $totalReviews = count($reviews);
    
    foreach ($reviews as $review) {
        $totalRating += $review->rating_star;
    }
    if ($totalReviews > 1) {
    $averageRating = $totalRating / $totalReviews;
    $averageRatingPercentage = $averageRating * 10;
    $widthStyle = 'width: ' . $averageRatingPercentage . '%';
    } else if($totalReviews > 0){
        $averageRating=$totalRating / $totalReviews;
        
        switch ($averageRating) {
            case 1:
                $widthStyle = 'width: 20%';
                break;
            case 2:
                $widthStyle = 'width: 40%';
                break;
            case 3:
                $widthStyle = 'width: 60%';
                break;
            case 4:
                $widthStyle = 'width: 80%';
                break;
            case 5:
                $widthStyle = 'width: 100%';
                break;
            default:
                $widthStyle = 'width: 40%';
        }
    }
    else{
        $widthStyle = 'width: 0%';
    }
   



    return $widthStyle;
    }




 
