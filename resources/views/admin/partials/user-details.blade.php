<div class="space-y-6">
    <!-- User Photo and Basic Info -->
    <div class="flex items-start space-x-4">
        <div class="flex-shrink-0">
            <div class="flex items-center space-x-4">
                @if($user->hasProfilePhoto())
                    <img class="h-20 w-20 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->full_name }}">
                @else
                    <div class="h-20 w-20 bg-gray-300 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex-1">
            <h4 class="text-xl font-semibold text-gray-900">{{ $user->full_name }}</h4>
            @if($user->nickname)
                <p class="text-gray-600">"{{ $user->nickname }}"</p>
            @endif
            <p class="text-gray-500">{{ $user->email }}</p>
            <p class="text-gray-500">{{ $user->contact_number }}</p>
        </div>
    </div>

    <!-- Basic Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h5 class="font-semibold text-gray-900 mb-3">Basic Information</h5>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-medium text-gray-700">Blood Group:</span>
                <span class="text-gray-900">{{ $user->blood_group }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Session:</span>
                <span class="text-gray-900">{{ $user->session }}</span>
            </div>
                          <div>
                  <span class="font-medium text-gray-700">Session:</span>
                  <span class="text-gray-900">{{ $user->session ?? 'Not specified' }}</span>
              </div>
            <div>
                <span class="font-medium text-gray-700">WhatsApp:</span>
                <span class="text-gray-900">{{ $user->whatsapp_number ?? 'Not provided' }}</span>
            </div>
        </div>
    </div>

    <!-- Address Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h5 class="font-semibold text-gray-900 mb-3">Address Information</h5>
        <div class="space-y-2 text-sm">
            <div>
                <span class="font-medium text-gray-700">Present Address:</span>
                <span class="text-gray-900">{{ $user->present_address }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Permanent Address:</span>
                <span class="text-gray-900">{{ $user->permanent_address }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Location:</span>
                <span class="text-gray-900">{{ $user->city_of_residence }}, {{ $user->country_of_residence }}</span>
            </div>
        </div>
    </div>

    <!-- Professional Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h5 class="font-semibold text-gray-900 mb-3">Professional Information</h5>
        <div class="space-y-2 text-sm">
            <div>
                <span class="font-medium text-gray-700">Occupation:</span>
                <span class="text-gray-900">{{ $user->occupation ?? 'Not specified' }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Organization:</span>
                <span class="text-gray-900">{{ $user->organization_name ?? 'Not specified' }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Designation:</span>
                <span class="text-gray-900">{{ $user->designation ?? 'Not specified' }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Work Location:</span>
                <span class="text-gray-900">{{ $user->work_location ?? 'Not specified' }}</span>
            </div>
        </div>
    </div>

    <!-- Family Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h5 class="font-semibold text-gray-900 mb-3">Family Information</h5>
        <div class="space-y-2 text-sm">
            <div>
                <span class="font-medium text-gray-700">Marital Status:</span>
                <span class="text-gray-900">{{ ucfirst($user->marital_status) }}</span>
            </div>
            @if($user->marital_status === 'married')
                <div>
                    <span class="font-medium text-gray-700">Spouse Name:</span>
                    <span class="text-gray-900">{{ $user->spouse_name ?? 'Not specified' }}</span>
                </div>
            @endif
            <div>
                <span class="font-medium text-gray-700">Children:</span>
                <span class="text-gray-900">{{ $user->number_of_children }}</span>
            </div>
            @if($user->children_names_ages)
                <div>
                    <span class="font-medium text-gray-700">Children Details:</span>
                    <span class="text-gray-900">{{ $user->children_names_ages }}</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Event Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h5 class="font-semibold text-gray-900 mb-3">Event Information</h5>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-medium text-gray-700">Accompanying Guests:</span>
                <span class="text-gray-900">{{ $user->accompanying_guests }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">T-shirt Size:</span>
                <span class="text-gray-900">{{ $user->tshirt_size ?? 'Not specified' }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700">Willing to Volunteer:</span>
                <span class="text-gray-900">{{ $user->willing_to_volunteer ? 'Yes' : 'No' }}</span>
            </div>
        </div>
        @if($user->favorite_memory)
            <div class="mt-3">
                <span class="font-medium text-gray-700">Favorite Memory:</span>
                <p class="text-gray-900 mt-1">{{ $user->favorite_memory }}</p>
            </div>
        @endif
    </div>

    <!-- Payment Information -->
    @if($user->orders->count() > 0)
    <div class="bg-gray-50 rounded-lg p-4">
        <h5 class="font-semibold text-gray-900 mb-3">Payment Information</h5>
        <div class="space-y-2">
            @foreach($user->orders as $order)
                <div class="flex items-center justify-between p-3 bg-white rounded-lg border">
                    <div class="text-sm">
                        <div class="font-medium text-gray-900">Order #{{ $order->id }}</div>
                        <div class="text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</div>
                    </div>
                    <div class="text-right">
                        <div class="font-semibold text-gray-900">৳{{ number_format($order->amount) }}</div>
                        <div class="text-sm">
                            @if($order->status === 'paid')
                                <span class="text-green-600">Paid</span>
                            @elseif($order->status === 'pending')
                                <span class="text-yellow-600">Pending</span>
                            @else
                                <span class="text-red-600">Unpaid</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Registration Date -->
    <div class="text-center text-sm text-gray-500">
        <p>Registered on {{ $user->created_at->format('F d, Y \a\t g:i A') }}</p>
    </div>
</div>
