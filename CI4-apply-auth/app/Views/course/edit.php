<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="max-w-md mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Edit Course</h2>
            <p class="mt-1 text-sm text-gray-600">Update course information</p>
        </div>
        
        <form method="POST" action="/course/edit/<?= $course['course_id'] ?>" class="space-y-6">
            <div>
                <label for="course_name" class="block text-sm font-medium text-gray-700">Course Name</label>
                <div class="mt-1">
                    <input type="text" id="course_name" name="course_name" value="<?= $course['course_name'] ?>" required 
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
            </div>
            
            <div>
                <label for="credits" class="block text-sm font-medium text-gray-700">Credits</label>
                <div class="mt-1">
                    <input type="number" id="credits" name="credits" min="1" max="6" value="<?= $course['credits'] ?>" required 
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
                <p class="mt-1 text-xs text-gray-500">Credits must be between 1 and 6</p>
            </div>
            
            <div class="flex space-x-3">
                <button type="submit" 
                        class="flex-1 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                    Update Course
                </button>
                <a href="/dashboard" 
                   class="flex-1 flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>