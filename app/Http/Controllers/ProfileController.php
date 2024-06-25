<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use HeadlessChromium\BrowserFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        private BrowserFactory $browserFactory
    )
    {}
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }



    public function test(Request $request)
    {

        $this->browserFactory->addOptions(['enableImages' => false, 'noSandbox' => true]);
        // starts headless Chrome
        $browser = $this->browserFactory->createBrowser();
        $link = 'https://www.awin1.com/cread.php?awinmid=17697&awinaffid=1584600&ued=https%3A%2F%2Fwww.dafiti.com.br%2FSapatilha-Moleca-Fivela-Bege-13740308.html';

        try {
            // creates a new page and navigate to an URL
            $page = $browser->createPage();
            $page->navigate($link)->waitForNavigation();

            // get page title
            $pageTitle = $page->evaluate('document.title')->getReturnValue();

            echo "The title of the page is: {$pageTitle}\n";
        } finally {
            // bye
            $browser->close();
        }
    }
}
