<?php

class CommonComponent extends Component {
    public function sum_cart_price($cart) {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['sale_price'];
        }
        return $total;
    }

    public function is_date_between($date, $start, $end, $timezone = 'Asia/Ho_Chi_Minh') {
        date_default_timezone_set($timezone);
        $date = strtotime($date);
        $start = strtotime($start);
        $end = strtotime($end);
        if($date >= $start && $date <= $end) {
            return true;
        } else {
            return false;
        }
    }
}
?>