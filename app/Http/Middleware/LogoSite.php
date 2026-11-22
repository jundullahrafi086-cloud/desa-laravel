<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Situs;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class LogoSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $situs      = Situs::first() ?? new Situs([
            'nm_desa'   => 'Desa Kertamukti',
            'kecamatan' => 'Kecamatan Ciawi',
            'kabupaten' => 'Kabupaten Tasikmalaya',
            'provinsi'  => 'Jawa Barat',
            'kode_pos'  => '46156',
        ]);
        $nm_desa    = $situs->nm_desa ?? 'Desa Kertamukti';
        $kecamatan  = $situs->kecamatan ?? 'Kecamatan Ciawi';
        $kabupaten  = $situs->kabupaten ?? 'Kabupaten Tasikmalaya';
        $provinsi   = $situs->provinsi ?? 'Jawa Barat';
        $kode_pos   = $situs->kode_pos ?? '46156';

        $kontak     = Kontak::first();
        $no_hp      = $kontak?->no_hp ?? '81223456789';
        $email      = $kontak?->email ?? 'pemdes@kertamuktidesa.id';
        
        $user       = auth()->user() ?? User::first();

        View::share('logo', $situs);
        View::share('nm_desa', $nm_desa);
        View::share('kecamatan', $kecamatan);
        View::share('kabupaten', $kabupaten);
        View::share('provinsi', $provinsi);
        View::share('kode_pos', $kode_pos);

        View::share('no_hp', $no_hp);
        View::share('email', $email);

        View::share('foto', $user);

        return $next($request);
    }
}
