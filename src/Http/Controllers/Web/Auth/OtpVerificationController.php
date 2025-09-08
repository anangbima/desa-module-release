<?php

namespace Modules\DesaModuleRelease\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use Modules\DesaModuleRelease\Http\Controllers\Controller;
use Modules\DesaModuleRelease\Http\Requests\Web\Auth\OtpRequest;
use Modules\DesaModuleRelease\Services\Auth\AuthenticationService;

class OtpVerificationController extends Controller
{
    public function __construct(
        protected AuthenticationService $authService,
    ) {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Verify OTP',
        ];

        return view(desa_module_release_meta('kebab').'::web.auth.verify-otp', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OtpRequest $request)
    {
        $userId = session('otp_pending_user_id');

        if (!$userId) {
            return redirect()->route(desa_module_release_meta('kebab').'.auth.login')
                ->withErrors(['otp' => 'Session expired, please login again.']);
        }

        $result = $this->authService->confirmOtp($userId, $request->validated()['otp']);

        if ($result['status'] === 'error') {
            return back()->withErrors(['otp' => $result['message']]);
        }

        $user = $result['user'];

        if ($user->hasRole('user')) {
            return redirect()->route(desa_module_release_meta('kebab').".user.index")
                ->with('success', 'Login successful!');
        }

        return redirect()->intended(desa_module_release_meta('kebab').'/admin')
            ->with('success', 'Login successful!');
    }

    public function resend()
    {
        $result = $this->authService->resendOtp();

        if ($result['status'] === 'error') {
            return back()->withErrors(['otp' => $result['message']]);
        }

        return back()->with('status', $result['message']);
    }
}
