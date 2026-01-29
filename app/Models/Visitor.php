<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Visitor extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['ip_address', 'visited_at'];
    protected $casts = ['visited_at' => 'datetime'];

    public static function recordVisit()
    {
        $ip = request()->ip();
        
        // Only count unique visits per IP per day
        $today = Carbon::today();
        $exists = self::where('ip_address', $ip)
            ->whereDate('visited_at', $today)
            ->exists();
        
        if (!$exists) {
            self::create([
                'ip_address' => $ip,
                'visited_at' => now(),
            ]);
        }
    }

    public static function getCount($period = 'daily')
    {
        $query = self::query();
        
        switch ($period) {
            case 'daily':
                $query->whereDate('visited_at', Carbon::today());
                break;
            case 'monthly':
                $query->whereMonth('visited_at', Carbon::now()->month)
                    ->whereYear('visited_at', Carbon::now()->year)
                    ->distinct('ip_address');
                break;
            case 'yearly':
                $query->whereYear('visited_at', Carbon::now()->year)
                    ->distinct('ip_address');
                break;
        }
        
        return $query->count('ip_address');
    }

    public static function getChartData($period = 'daily')
    {
        switch ($period) {
            case 'daily':
                return self::getDailyData();
            case 'monthly':
                return self::getMonthlyData();
            case 'yearly':
                return self::getYearlyData();
        }
    }

    private static function getDailyData()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $count = self::whereDate('visited_at', $date)->count();
            $data[] = [
                'label' => $date->format('M d'),
                'count' => $count
            ];
        }
        return $data;
    }

    private static function getMonthlyData()
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = self::whereMonth('visited_at', $date->month)
                ->whereYear('visited_at', $date->year)
                ->count();
            $data[] = [
                'label' => $date->format('M Y'),
                'count' => $count
            ];
        }
        return $data;
    }

    private static function getYearlyData()
    {
        $data = [];
        for ($i = 4; $i >= 0; $i--) {
            $year = Carbon::now()->subYears($i)->year;
            $count = self::whereYear('visited_at', $year)->count();
            $data[] = [
                'label' => (string)$year,
                'count' => $count
            ];
        }
        return $data;
    }
}
