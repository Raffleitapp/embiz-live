@extends('layouts.dashboard')

@section('page-title', 'Create Investment Broadcast')

@section('header-icon')
<i class='bx bx-megaphone text-gray-600 text-xl'></i>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Create Investment Broadcast</h1>
                
                <form id="investmentBroadcastForm" class="space-y-6">
                    @csrf
                    
                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" 
                               id="subject" 
                               name="subject" 
                               required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                               placeholder="Enter investment opportunity title">
                    </div>
                    
                    <!-- Target Audience -->
                    <div>
                        <label for="target_audience" class="block text-sm font-medium text-gray-700 mb-2">Target Audience</label>
                        <select id="target_audience" 
                                name="target_audience" 
                                required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Select audience</option>
                            <option value="all">All Members</option>
                            <option value="founding_members">Founding Members Only</option>
                            <option value="investors">Investors Only</option>
                        </select>
                    </div>
                    
                    <!-- Investment Amount -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label for="investment_amount" class="block text-sm font-medium text-gray-700 mb-2">Investment Amount Required</label>
                            <input type="number" 
                                   id="investment_amount" 
                                   name="investment_amount" 
                                   step="0.01" 
                                   min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                   placeholder="Enter amount needed">
                        </div>
                        <div>
                            <label for="investment_currency" class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                            <select id="investment_currency" 
                                    name="investment_currency" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="GBP">GBP</option>
                                <option value="CAD">CAD</option>
                                <option value="AUD">AUD</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Investment Details</label>
                        <textarea id="message" 
                                  name="message" 
                                  required 
                                  rows="10" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                  placeholder="Describe the investment opportunity in detail..."></textarea>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="window.history.back()" 
                                class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                            Send Broadcast
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('investmentBroadcastForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    fetch('/messages/create-investment-broadcast', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            window.location.href = '/messages';
        } else {
            alert('Error creating broadcast');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error creating broadcast');
    });
});
</script>
@endsection
