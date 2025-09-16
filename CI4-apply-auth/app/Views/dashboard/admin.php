<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="mt-2 text-gray-600">Manage courses and students from this dashboard</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Courses Management -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Manage Courses</h2>
                <a href="/course/create" 
                   class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Course
                </a>
            </div>
            
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credits</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($courses)): ?>
                            <?php foreach ($courses as $course): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $course['course_id'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $course['course_name'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?= $course['credits'] ?> Credits
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="/course/edit/<?= $course['course_id'] ?>" 
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <button onclick="deleteCourse(<?= $course['course_id'] ?>)" 
                                            class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                    No courses available
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Students Management -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Manage Students</h2>
                <a href="/student/create" 
                   class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Student
                </a>
            </div>
            
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $student): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $student['student_id'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $student['full_name'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $student['username'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $student['entry_year'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="/student/view/<?= $student['student_id'] ?>" 
                                       class="text-blue-600 hover:text-blue-900">View</a>
                                    <a href="/student/edit/<?= $student['student_id'] ?>" 
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <button onclick="deleteStudent(<?= $student['student_id'] ?>)" 
                                            class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                    No students available
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function deleteCourse(courseId) {
    if (confirm('Are you sure you want to delete this course?')) {
        window.location.href = '/course/delete/' + courseId;
    }
}

function deleteStudent(studentId) {
    if (confirm('Are you sure you want to delete this student? Enrollment data will also be deleted!')) {
        window.location.href = '/student/delete/' + studentId;
    }
}
</script>
<?= $this->endSection() ?>