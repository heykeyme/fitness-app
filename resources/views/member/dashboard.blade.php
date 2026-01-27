<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- My Membership -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">My Membership</h3>
                    @if($subscription)
                        <p class="text-xl font-bold text-indigo-600">{{ $subscription->membershipPlan->name }}</p>
                        <p class="text-gray-600">Expires on: {{ $subscription->end_date->format('Y-m-d') }}</p>
                    @else
                        <p class="text-gray-600">No active subscription.</p>
                    @endif
                </div>
            </div>

            <!-- My Upcoming Classes (Dummy Data) -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">My Upcoming Classes</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Yoga</td>
                                <td class="px-6 py-4 whitespace-nowrap">2026-01-28</td>
                                <td class="px-6 py-4 whitespace-nowrap">18:00</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Pilates</td>
                                <td class="px-6 py-4 whitespace-nowrap">2026-01-30</td>
                                <td class="px-6 py-4 whitespace-nowrap">19:00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Activity</h3>
                    <ul class="divide-y divide-gray-200">
                        @forelse($activities as $activity)
                            <li class="py-4 flex">
                                <span class="font-bold mr-2">{{ $activity->description }}</span>
                                <span>{{ $activity->created_at->diffForHumans() }}</span>
                            </li>
                        @empty
                            <li class="py-4">No recent activity.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Announcements -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Announcements</h3>
                    <ul class="divide-y divide-gray-200">
                        @forelse($announcements as $announcement)
                            <li class="py-4">
                                <h4 class="text-md font-semibold text-gray-800">{{ $announcement->title }}</h4>
                                <p class="text-gray-600">{{ $announcement->content }}</p>
                                <small class="text-gray-500">{{ $announcement->created_at->diffForHumans() }}</small>
                            </li>
                        @empty
                            <li class="py-4">No announcements at the moment.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
