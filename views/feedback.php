<?php

if (!isset($itemId))
    echo "<div class='container-fluid review-block'></div>";
else {
    include_once ROOT . '/models/Feedback.php';

    $feedback = Feedback::selectByItemId($itemId);

    for ($i = 0; $i < 3; $i++) {
        if (isset($feedback[$i])) {
            echo "<div class='col-md-8 col-md-offset-2 review row'>
                    <div class='col-md-1'>
                        <div class='author-img'>" . substr($feedback[$i]['name'], 0, 2) . "</div>
                    </div>
                    <div class='row col-md-11'>
                        <div class='user-name col-md-1'>" . $feedback[$i]['name'] . "</div>
                    </div>
                    <div class='review-text col-md-10'>
                        <h4>" . $feedback[$i]['text'] . "</h4>
                    </div>
                </div>";
        }
    }
}
