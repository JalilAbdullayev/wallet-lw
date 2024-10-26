<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $title ?? 'Wallet' }}
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar rounded-box bg-base-200 flex w-full gap-2 shadow max-md:flex-col md:items-center">
    <div class="flex max-md:w-full items-center justify-between">
        <div class="navbar-start items-center justify-between max-md:w-full">
            <a class="link text-base-content/90 link-neutral text-xl font-semibold no-underline"
               href="{{ route('home') }}" wire:navigate>
                Wallet
            </a>
            <div class="md:hidden">
                <button type="button" class="collapse-toggle btn btn-outline btn-secondary btn-sm btn-square"
                        data-collapse="#navbar-collapse" aria-controls="navbar-collapse" aria-label="Toggle navigation">
                    <span class="icon-[tabler--menu-2] collapse-open:hidden size-4"></span>
                    <span class="icon-[tabler--x] collapse-open:block hidden size-4"></span>
                </button>
            </div>
        </div>
    </div>
    <div id="navbar-collapse"
         class="md:navbar-end collapse hidden grow basis-full overflow-hidden transition-[height] duration-300 max-md:w-full">
        <ul class="menu md:menu-horizontal gap-2 p-0 text-base">
            <li>
                <a href="#">
                    Link 1
                </a>
            </li>
        </ul>
    </div>
</nav>
{{ $slot }}
<footer class="footer bg-base-200/60 px-6 py-4">
    <div class="flex w-full items-center justify-between">
        <aside class="grid-flow-col items-center">
            <p>
                © 2024 @if(date('Y') > 2024)
                    - {{ date('Y') }}
                @endif <a class="link link-hover font-medium" href="{{ route('home') }}" wire:navigate>
                    Wallet
                </a>
            </p>
        </aside>
        <div class="flex gap-4 h-5">
            <a href="#" class="link" aria-label="Github Link">
                <span class="icon-[tabler--brand-github] size-5"></span>
            </a>
            <a href="#" class="link" aria-label="Facebook Link">
                <span class="icon-[tabler--brand-facebook] size-5"></span>
            </a>
            <a href="#" class="link" aria-label="X Link">
                <span class="icon-[tabler--brand-x] size-5"></span>
            </a>
        </div>
    </div>
</footer>
</body>
</html>
