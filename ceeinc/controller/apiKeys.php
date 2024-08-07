<?php 
header('Content-Type: application/json');


class apiKeys {
    function pk() {
        $response = [
            'success' => true,
            'key' => '' // Replace with your actual Stripe API key
        ];    
        echo json_encode($response);
    }

    function sk(){
        return 'sk_test_51PjSyUDq80qrBqISRmjNDLxV65kFsOfKakD9tWMon9DvknqIVJKfeM6ZxEHJgRDY02WZHiYciGU3lO85ag00B63600hQ4wLgA6';
    }
}