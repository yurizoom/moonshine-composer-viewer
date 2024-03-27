<x-moonshine::box xmlns:x-moonshine="http://www.w3.org/1999/html">
    <x-moonshine::table>
        <x-slot:thead>
            <th>#</th>
            <th>{{ __('moonshine::composer-viewer.package_name') }}</th>
            <th>{{ __('moonshine::composer-viewer.current_version') }}</th>
            <th>{{ __('moonshine::composer-viewer.latest_version') }}</th>
            <th>{{ __('moonshine::composer-viewer.latest_status') }}</th>
            <th></th>
        </x-slot:thead>
        <x-slot:tbody>
            @foreach($packages as $index => $package)
                <tr>
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
        </x-slot:tbody>
    </x-moonshine::table>
</x-moonshine::box>