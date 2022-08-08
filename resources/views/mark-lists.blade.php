<x-guest-layout>
    <section class="py-15 bg-gray-50">
        <div class="container items-center max-w-6xl px-4 px-10 mx-auto sm:px-20 md:px-32 lg:px-16">
            @if ($marks)
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr class="border-b">
                            <th scope="col" class="py-3 px-6">
                                Student Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Listening
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Speaking
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Reading
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Writing
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Overall
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($marks as $mark)
                            <tr class="bg-white border-b {{$loop->odd ? 'bg-gray-100' : ''}}">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $mark->student->name }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ $mark->listening }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $mark->speaking }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $mark->reading }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $mark->writing }}
                                </td>
                                <td class="py-4 px-6 font-semibold text-green-700">
                                    {{ $mark->overall }}
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white">
                                <td class="py-4 px-6" colspan="6"><h1 class="mb-3 text-2xl text-center font-semibold tracking-tight text-green-600 uppercase">No mark list found.</h1></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </section>
</x-guest-layout>