<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\YouTubeService;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalUsers' => \App\Models\User::count(),
            'totalCourses' => \App\Models\Course::count(),
            'totalModules' => \App\Models\CourseModule::count(),
            'totalOrders' => \App\Models\Order::count(),
            'recentStudents' => \App\Models\User::where('is_admin', 0)->latest()->take(5)->get(),
            'recentOrders' => \App\Models\Order::latest()->take(5)->get(),
        ]);
    }
}
