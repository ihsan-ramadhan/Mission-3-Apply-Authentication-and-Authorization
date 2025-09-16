<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="max-w-md mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Edit Student</h2>
            <p class="mt-1 text-sm text-gray-600">Update student information</p>
        </div>
        
        <form method="POST" action="/student/edit/<?= $student['student_id'] ?>" class="space-y-6">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <div class="mt-1">
                    <input type="text" id="username" name="username" value="<?= $student['username'] ?>" required 
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1">
                    <input type="password" id="password" name="password" placeholder="Leave empty to keep current password"
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
            </div>
            
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <div class="mt-1">
                    <input type="text" id="full_name" name="full_name" value="<?= $student['full_name'] ?>" required 
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
            </div>
            
            <div>
                <label for="entry_year" class="block text-sm font-medium text-gray-700">Entry Year</label>
                <div class="mt-1">
                    <input type="number" id="entry_year" name="entry_year" min="2020" max="2030" value="<?= $student['entry_year'] ?>" required 
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
            </div>
            
            <div class="flex space-x-3">
                <button type="submit" 
                        class="flex-1 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                    Update Student
                </button>
                <a href="/student" 
                   class="flex-1 flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>