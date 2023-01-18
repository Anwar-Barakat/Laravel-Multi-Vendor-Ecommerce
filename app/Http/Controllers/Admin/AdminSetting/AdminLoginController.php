<?php

namespace App\Http\Controllers\Admin\AdminSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminLoginController extends Controller
{
    public function index()
    {
        $new_orders_options      = [
            'chart_title'           => 'New',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Order',
            'conditions'            => [
                ['name' => 'New', 'condition' => 'order_status = "New"', 'color' => 'rgb(33 150 243)', 'fill' => true],
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '60',
            'continous_time'        => true,
        ];
        $delivered_orders_options      = [
            'chart_title'           => 'Delivered',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Order',
            'conditions'            => [
                ['name' => 'Delivered', 'condition' => 'order_status = "Delivered"', 'color' => 'rgb(76 175 80)', 'fill' => true],
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '60',
            'continous_time'        => true,
        ];
        $cancelled_orders_options      = [
            'chart_title'           => 'Cancelled',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Order',
            'conditions'            => [
                ['name' => 'Cancelled', 'condition' => 'order_status = "Cancelled"', 'color' => 'rgb(244 67 54)', 'fill' => true],
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '60',
            'continous_time'        => true,
        ];
        $chart_options = [
            'chart_title'           => 'Users by months',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\User',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'month',
            'chart_type'            => 'bar',
            'aggregate_function'    => 'count',
            'filter_days'           => 30,
        ];

        $data['ordersChart'] = new LaravelChart($new_orders_options, $delivered_orders_options, $cancelled_orders_options);
        $data['chart1'] = new LaravelChart($chart_options);

        return view('admin.index', $data);
    }

    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data   = $request->only(['email', 'password']);

            $validated = $request->validate([
                'email'     => 'required|email|max:255',
                'password'  => 'required|min:8'
            ]);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) :

                if (Auth::guard('admin')->user()->type == 'vendor') :

                    if (Auth::guard('admin')->user()->status == 0) :
                        toastr()->warning("Your Vendor Account Must Be Active To Login, Please Check Your Email");
                        return redirect()->back();
                    else :
                        toastr()->success("Welcome Back in Vendor Dashboard");
                        return redirect()->route('admin.dashboard');
                    endif;

                elseif (Auth::guard('admin')->user()->type == 'admin' || Auth::guard('admin')->user()->type == 'super-admin') :
                    toastr()->success("Welcome Back in Admin Dashboard");
                    return redirect()->route('admin.dashboard');
                else :
                    return redirect()->back();
                endif;
            else :
                toastr()->error('Email or Password is Invalid');
                return redirect()->back();
            endif;
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login.form');
    }
}