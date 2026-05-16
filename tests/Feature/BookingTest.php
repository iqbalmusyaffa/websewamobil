<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_calculate_refund_percentage_force_majeure()
    {
        $booking = new Booking([
            'start_date' => now()->addDays(2), // Less than 3 days
            'cancel_category' => 'force_majeure'
        ]);

        $percentage = $booking->calculateRefundPercentage();
        
        $this->assertEquals(100, $percentage, 'Force majeure should always refund 100%');
    }

    public function test_calculate_refund_percentage_exception()
    {
        $booking = new Booking([
            'start_date' => now()->addDays(1),
            'cancel_category' => 'exception'
        ]);

        $percentage = $booking->calculateRefundPercentage();
        
        $this->assertEquals(100, $percentage, 'Exception should always refund 100%');
    }

    public function test_calculate_refund_percentage_damage_with_insurance()
    {
        $booking = new Booking([
            'start_date' => now()->addDays(5),
            'cancel_category' => 'damage',
            'insurance_claimed' => true,
            'is_customer_fault' => true // Even if customer fault, insurance claimed overrides
        ]);

        $percentage = $booking->calculateRefundPercentage();
        
        $this->assertEquals(100, $percentage, 'Damage with insurance claimed should refund 100%');
    }

    public function test_calculate_refund_percentage_damage_customer_fault()
    {
        $booking = new Booking([
            'start_date' => now()->addDays(5),
            'cancel_category' => 'damage',
            'insurance_claimed' => false,
            'is_customer_fault' => true
        ]);

        $percentage = $booking->calculateRefundPercentage();
        
        $this->assertEquals(0, $percentage, 'Damage due to customer fault without insurance should refund 0%');
    }

    public function test_calculate_refund_percentage_normal_more_than_7_days()
    {
        $booking = new Booking([
            'start_date' => now()->addDays(10),
            'cancel_category' => 'normal'
        ]);

        $percentage = $booking->calculateRefundPercentage();
        
        $this->assertEquals(100, $percentage, 'Normal cancellation > 7 days should refund 100%');
    }

    public function test_calculate_refund_percentage_normal_between_3_and_7_days()
    {
        $booking = new Booking([
            'start_date' => now()->addDays(5),
            'cancel_category' => 'normal'
        ]);

        $percentage = $booking->calculateRefundPercentage();
        
        $this->assertEquals(50, $percentage, 'Normal cancellation between 3 and 7 days should refund 50%');
    }

    public function test_calculate_refund_percentage_normal_less_than_3_days()
    {
        $booking = new Booking([
            'start_date' => now()->addDays(2),
            'cancel_category' => 'normal'
        ]);

        $percentage = $booking->calculateRefundPercentage();
        
        $this->assertEquals(0, $percentage, 'Normal cancellation < 3 days should refund 0%');
    }

    public function test_calculate_refund_amount()
    {
        $booking = new Booking([
            'start_date' => now()->addDays(5),
            'cancel_category' => 'normal',
            'total_price' => 1000000
        ]);

        // 5 days means 50% refund
        $amount = $booking->calculateRefundAmount();
        
        $this->assertEquals(500000, $amount, 'Refund amount should be 50% of 1,000,000');
    }
}
