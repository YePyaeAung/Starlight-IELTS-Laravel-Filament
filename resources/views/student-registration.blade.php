<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Registration Lists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Profile Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date of Birth
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Course
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Created At
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $registration)
                        <tr class="bg-white border-b">
                            <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <img class="w-full h-full rounded-full" src="{{ Storage::url($registration->profile_image) }}" alt="Image" />
                            </td>
                            <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$registration->name}}
                            </td>
                            <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$registration->email}}
                            </td>
                            <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$registration->phone}}
                            </td>
                            <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$registration->date_of_birth}}
                            </td>
                            <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$registration->address}}
                            </td>
                            <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$registration->course->name}}
                            </td>
                            <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$registration->created_at}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
