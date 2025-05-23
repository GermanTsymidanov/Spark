<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        App::setLocale(Cookie::get('locale', config('app.locale')));

        [$message, $author] = Str::of(Inspiring::quotes()->random())->explode('-');

        $user = $request->user();

//        $defaultDisk = config('filesystems.default');
//        $fallbackDisk = 'public';
//
//        $profileImage = null;
//
//        if ($user && $user->profileImage) {
//            $filePath = $user->profileImage->file_path;
//
//            try {
//                $diskToUse = $user->profileImage->disk ?? $defaultDisk;
//                if (Storage::disk($diskToUse)->exists($filePath)) {
//                    $profileImage = Storage::disk($diskToUse)->url($filePath);
//                } else {
//                    if (Storage::disk($fallbackDisk)->exists($filePath)) {
//                        $profileImage = Storage::disk($fallbackDisk)->url($filePath);
//                    }
//                }
//            } catch (\Exception $e) {
//                try {
//                    if (Storage::disk($fallbackDisk)->exists($filePath)) {
//                        $profileImage = Storage::disk($fallbackDisk)->url($filePath);
//                    }
//                } catch (\Exception $ex) {
//                    $profileImage = null;
//                }
//            }
//        }

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'locale' => app()->getLocale(),
            'translations' => trans('common'),
            'quote' => [
                'message' => trim($message),
                'author' => trim($author),
            ],
            'auth' => [
                'user' => $user ? [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
//                    'profile_image_url' => $user->profileImage
//                        ? asset('storage/' . $user->profileImage->file_path)
//                        : null,
//                    'profile_image_url' => $user->profileImage
//                        ? Storage::disk($this->disk ?? 's3')->url($user->profileImage->file_path)
//                        : null,
                    'profile_image' => $user->profileImage,
                    'is_verified' => $user->is_verified,
                ] : null,
            ],
        ];
    }
}
