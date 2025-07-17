<main>
    <section class="section py-4">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center">
                    <h2 class="mb-3 text-capitalize">Documentation</h2>
                    <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                        <li class="list-inline-item"><a wire:navigate href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="list-inline-item">/ &nbsp; Documentation
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container" x-data="{
            categories: @js($topicsTree),
            selected: null
        }">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 mb-2">
                    <div class="p-3 bg-light rounded shadow-sm h-100 overflow-auto" style="max-height: 80vh">
                        @verbatim
                        <template x-for="cat in Object.keys(categories)" :key="cat">
                            <div class="mb-1" x-data="{ open: false }">
                                <button
                                    @click="open = !open"
                                    class="w-100 text-start fw-semibold border-0 bg-transparent px-0 py-1"
                                    :class="{ 'text-dark': open, 'text-muted': !open }"
                                    style="font-size: 0.95rem;">
                                    <span x-text="cat"></span>
                                </button>

                                <div x-show="open" class="ps-3">
                                    <!-- Flat array langsung -->
                                    <template x-if="Array.isArray(categories[cat])">
                                        <ul class="list-unstyled small mb-1">
                                            <template x-for="(item, index) in categories[cat]" :key="item.title || index">
                                                <li>
                                                    <button
                                                        @click="selected = item"
                                                        class="border-0 bg-transparent text-start px-0 py-1 w-100 text-muted hover-text-dark"
                                                        :class="{ 'fw-bold text-primary': selected?.title === item.title }"
                                                        style="font-size: 0.85rem;"
                                                        x-text="item.title"></button>
                                                </li>
                                            </template>
                                        </ul>
                                    </template>

                                    <!-- Nested Subcategory -->
                                    <template x-if="!Array.isArray(categories[cat])">
                                        <div>
                                            <template x-for="([key, val]) in Object.entries(categories[cat])" :key="key">
                                                <div class="mb-1" x-data="{ openSub: false }">
                                                    <button
                                                        @click="openSub = !openSub"
                                                        class="w-100 text-start border-0 bg-transparent px-0 py-1 text-muted fw-medium"
                                                        :class="{ 'text-dark fw-semibold': openSub }"
                                                        style="font-size: 0.9rem;">
                                                        <span x-text="key"></span>
                                                    </button>

                                                    <div x-show="openSub" class="ps-3">
                                                        <template x-if="Array.isArray(val)">
                                                            <ul class="list-unstyled small mb-1">
                                                                <template x-for="(item, idx) in val" :key="item.title || idx">
                                                                    <li>
                                                                        <button
                                                                            @click="selected = item"
                                                                            class="border-0 bg-transparent text-start px-0 py-1 w-100 text-muted hover-text-dark"
                                                                            :class="{ 'fw-bold text-primary': selected?.title === item.title }"
                                                                            style="font-size: 0.85rem;"
                                                                            x-text="item.title"></button>
                                                                    </li>
                                                                </template>
                                                            </ul>
                                                        </template>

                                                        <!-- Sub-sub kategori -->
                                                        <template x-if="!Array.isArray(val)">
                                                            <div class="ps-2">
                                                                <template x-for="([subsub, items]) in Object.entries(val)" :key="subsub">
                                                                    <div class="mb-1" x-data="{ openSubSub: false }">
                                                                        <button
                                                                            @click="openSubSub = !openSubSub"
                                                                            class="w-100 text-start border-0 bg-transparent px-0 py-1 text-muted fw-medium"
                                                                            :class="{ 'text-dark fw-semibold': openSubSub }"
                                                                            style="font-size: 0.85rem;">
                                                                            <span x-text="subsub"></span>
                                                                        </button>

                                                                        <ul x-show="openSubSub" class="list-unstyled small mb-1 ps-2">
                                                                            <template x-for="(item, i) in items" :key="item.title || i">
                                                                                <li>
                                                                                    <button
                                                                                        @click="selected = item"
                                                                                        class="border-0 bg-transparent text-start px-0 py-1 w-100 text-muted hover-text-dark"
                                                                                        :class="{ 'fw-bold text-primary': selected?.title === item.title }"
                                                                                        style="font-size: 0.8rem;"
                                                                                        x-text="item.title"></button>
                                                                                </li>
                                                                            </template>
                                                                        </ul>
                                                                    </div>
                                                                </template>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                        @endverbatim
                    </div>
                </div>

                <!-- Konten -->
                <div class="col-lg-9">
                    <div class="p-4 bg-white rounded shadow-sm min-vh-50">
                        <template x-if="selected">
                            <div>
                                <h4 class="text-primary mb-3" x-text="selected.title"></h4>
                                <p class="text-muted small" x-html="selected.content"></p>

                                <template x-if="selected.video_url">
                                    <a :href="selected.video_url" target="_blank" class="btn btn-sm btn-primary mt-3">
                                        🎥 Lihat Video
                                    </a>
                                </template>
                            </div>
                        </template>

                        <template x-if="!selected">
                            <p class="text-muted fst-italic">Pilih salah satu topik untuk melihat konten.</p>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>