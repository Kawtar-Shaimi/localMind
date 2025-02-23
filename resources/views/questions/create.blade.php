@extends('layouts.app')

@section('content')
<form class="max-w-2xl mx-auto bg-white p-8 rounded-3xl shadow-2xl border border-gray-300 space-y-6">
  <h2 class="text-3xl font-extrabold text-gray-900 text-center">Ask a Question</h2>
  
  <div>
    <label for="title" class="block text-sm font-semibold text-gray-800">Title</label>
    <input type="text" id="title" name="title" placeholder="Enter your question title" 
           class="w-full mt-2 p-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300">
  </div>
  
  <div>
    <label for="description" class="block text-sm font-semibold text-gray-800">Description</label>
    <textarea id="description" name="description" rows="4" placeholder="Provide more details" 
              class="w-full mt-2 p-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none transition-all duration-300"></textarea>
  </div>
  
  <div>
    <label for="tags" class="block text-sm font-semibold text-gray-800">Tags</label>
    <input type="text" id="tags" name="tags" placeholder="e.g., Laravel, PHP, TailwindCSS" 
           class="w-full mt-2 p-4 border border-gray-300 rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-300">
  </div>
  
  <div class="flex items-center space-x-3">
    <input type="checkbox" id="anonymous" name="anonymous" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
    <label for="anonymous" class="text-sm font-medium text-gray-700">Post Anonymously</label>
  </div>
  
  <button type="submit" class="w-full bg-gray-700 text-black font-semibold py-4 rounded-2xl shadow-lg ">
    Submit Question
  </button>
</form>

<script>
  document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault();
    const title = document.getElementById("title").value.trim();
    const description = document.getElementById("description").value.trim();
    
    if (!title || !description) {
      alert("Please fill in both the title and description fields.");
      return;
    }
    
    alert("Your question has been submitted successfully!");
    this.reset();
  });
</script>
@endsection
