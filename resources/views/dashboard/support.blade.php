@extends('layouts.dashboard')

@section('page-title', 'Support & Help')

@section('header-icon')
<i class="bx bx-help-circle text-gray-600 text-lg sm:text-xl"></i>
@endsection

@section('header-actions')
<button class="bg-teal-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-teal-700 transition-colors flex items-center space-x-2 text-sm sm:text-base w-full sm:w-auto justify-center" onclick="openTicketModal()">
    <i class='bx bx-plus'></i>
    <span>New Ticket</span>
</button>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-4 sm:space-y-6">
            <!-- Quick Help -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Help</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="#" class="p-4 border border-gray-200 rounded-lg hover:border-teal-300 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                                    <i class='bx bx-book text-teal-600 text-xl'></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 text-sm">User Guide</div>
                                    <div class="text-xs text-gray-500">Complete platform guide</div>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#" class="p-4 border border-gray-200 rounded-lg hover:border-teal-300 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class='bx bx-video text-blue-600 text-xl'></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 text-sm">Video Tutorials</div>
                                    <div class="text-xs text-gray-500">Step-by-step videos</div>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#" class="p-4 border border-gray-200 rounded-lg hover:border-teal-300 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class='bx bx-question-mark text-purple-600 text-xl'></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 text-sm">FAQ</div>
                                    <div class="text-xs text-gray-500">Frequently asked questions</div>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#" class="p-4 border border-gray-200 rounded-lg hover:border-teal-300 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class='bx bx-chat text-green-600 text-xl'></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 text-sm">Live Chat</div>
                                    <div class="text-xs text-gray-500">Chat with support</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Support Tickets -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Support Tickets</h3>
                    <div class="space-y-3">
                        @foreach($tickets as $ticket)
                        <div class="p-3 sm:p-4 border border-gray-200 rounded-lg">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2">
                                        <div class="font-medium text-gray-900 text-sm">{{ $ticket['subject'] }}</div>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                            @if($ticket['status'] === 'Open') bg-red-100 text-red-800
                                            @elseif($ticket['status'] === 'In Progress') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ $ticket['status'] }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                            @if($ticket['priority'] === 'High') bg-red-100 text-red-800
                                            @elseif($ticket['priority'] === 'Medium') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ $ticket['priority'] }}
                                        </span>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Created: {{ $ticket['created_at']->format('M d, Y') }} • 
                                        Updated: {{ $ticket['updated_at']->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="px-3 py-1 text-xs border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition-colors">
                                        View
                                    </button>
                                    @if($ticket['status'] !== 'Resolved')
                                    <button class="px-3 py-1 text-xs bg-teal-600 text-white rounded hover:bg-teal-700 transition-colors">
                                        Reply
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-4 sm:space-y-6">
            <!-- Contact Info -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <i class='bx bx-envelope text-gray-400'></i>
                            <div>
                                <div class="text-sm font-medium text-gray-900">Email Support</div>
                                <div class="text-xs text-gray-500">support@embiz.com</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <i class='bx bx-phone text-gray-400'></i>
                            <div>
                                <div class="text-sm font-medium text-gray-900">Phone Support</div>
                                <div class="text-xs text-gray-500">+1 (555) 123-4567</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <i class='bx bx-time text-gray-400'></i>
                            <div>
                                <div class="text-sm font-medium text-gray-900">Support Hours</div>
                                <div class="text-xs text-gray-500">Mon-Fri 9AM-6PM EST</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Response Times -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Response Times</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">Critical</div>
                            <div class="text-sm font-medium text-red-600">< 1 hour</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">High</div>
                            <div class="text-sm font-medium text-orange-600">< 4 hours</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">Medium</div>
                            <div class="text-sm font-medium text-yellow-600">< 24 hours</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">Low</div>
                            <div class="text-sm font-medium text-gray-600">< 3 days</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">System Status</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">All Systems</div>
                            <div class="flex items-center space-x-1">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-green-600">Operational</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">API</div>
                            <div class="flex items-center space-x-1">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-green-600">Operational</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">Database</div>
                            <div class="flex items-center space-x-1">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-green-600">Operational</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="text-sm text-teal-600 hover:text-teal-700">View Status Page →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Ticket Modal -->
<div id="ticketModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Create Support Ticket</h3>
                <button onclick="closeTicketModal()" class="text-gray-400 hover:text-gray-600">
                    <i class='bx bx-x text-xl'></i>
                </button>
            </div>
            
            <form action="{{ route('dashboard.create-support-ticket') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <input type="text" 
                           id="subject" 
                           name="subject" 
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                        <select id="priority" 
                                name="priority" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                            <option value="Low">Low</option>
                            <option value="Medium" selected>Medium</option>
                            <option value="High">High</option>
                            <option value="Critical">Critical</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select id="category" 
                                name="category" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                            <option value="Technical">Technical</option>
                            <option value="Account">Account</option>
                            <option value="Billing">Billing</option>
                            <option value="Feature Request">Feature Request</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" 
                              name="description" 
                              rows="5"
                              required
                              placeholder="Please describe your issue in detail..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" 
                            onclick="closeTicketModal()"
                            class="px-4 py-2 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                        Create Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openTicketModal() {
    document.getElementById('ticketModal').classList.remove('hidden');
}

function closeTicketModal() {
    document.getElementById('ticketModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('ticketModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeTicketModal();
    }
});
</script>
@endsection
