<x-moonshine::box xmlns:x-moonshine="http://www.w3.org/1999/html" x-data="data()">
    <x-moonshine::table>
        <x-slot:thead>
            <th>#</th>
            <th>{{ __('moonshine-composer-viewer::composer-viewer.package_name') }}</th>
            <th>{{ __('moonshine-composer-viewer::composer-viewer.current_version') }}</th>
            <th>{{ __('moonshine-composer-viewer::composer-viewer.latest_version') }}</th>
            <th>{{ __('moonshine-composer-viewer::composer-viewer.latest_status') }}</th>
            <th></th>
        </x-slot:thead>
        <x-slot:tbody>
            @if($packages)
                @foreach($packages as $index => $package)
                    <tr x-show="!loadedNewData">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <x-moonshine::link-native href="https://packagist.org/packages/{{ $package['name'] }}"
                                                      target="_blank">
                                {{ $package['name'] }}
                            </x-moonshine::link-native>
                        </td>
                        <td>{{ $package['version'] }}</td>
                        <td>{{ $package['latest'] }}</td>
                        <td>
                            <x-moonshine::badge
                                    color="{{ $package['badge']}}">{{ $package['latest-status'] }}</x-moonshine::badge>
                        </td>
                        <td>{{ $package['description'] }}</td>
                    </tr>
                @endforeach
            @else
                <template x-if="loading === true">
                    <tr>
                        <td colspan="6">
                            <x-moonshine::loader/>
                        </td>
                    </tr>
                </template>
            @endif
            <template x-for="(package, index) in packages" :key="index">
                <tr>
                    <td x-text="index+1"></td>
                    <td>
                        <x-moonshine::link-native x-bind:href="`https://packagist.org/packages/${package.name}`"
                                                  target="_blank"
                                                  x-text="package.name"
                        >
                        </x-moonshine::link-native>
                    </td>
                    <td x-text="package.version"></td>
                    <td x-text="package.latest"></td>
                    <td>
                        <span class="badge" x-bind:class="`badge-${package.badge}`" x-text="package['latest-status']"></span>
                    </td>
                    <td x-text="package.description"></td>
                </tr>
            </template>
        </x-slot:tbody>
    </x-moonshine::table>
</x-moonshine::box>

<script>
    function data() {
        return {
            loadedNewData: false,
            loading: false,
            packages: [],
            init() {
                this.fetchPackages();
            },
            fetchPackages() {
                this.loading = true;
                fetch('{{ route('moonshine.composer.viewer.index') }}')
                    .then(res => res.json())
                    .then(data => {
                        this.loadedNewData = true;
                        this.packages = data.packages;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        }
    }
</script>