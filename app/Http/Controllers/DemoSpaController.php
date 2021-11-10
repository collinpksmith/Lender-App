<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\View\View;

/**
 * @package
 */
class DemoSpaController extends Controller
{
    /**
     * Get the Demo SPA view.
     * @return View
     */
    public function __invoke(): View
    {
        return view('demospa');
    }
}
