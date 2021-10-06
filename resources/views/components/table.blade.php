<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between">
            <h2 class="text-2xl font-semibold leading-tight">
                {{ $title ?? '' }}
            </h2>
            <div>
                {{ $right ?? '' }}
            </div>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        {{ $thead ?? '' }}
                    </thead>
                    <tbody>
                        {{ $tbody ?? '' }}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-8">
            {{ $links ?? '' }}
        </div>
    </div>
</div>
