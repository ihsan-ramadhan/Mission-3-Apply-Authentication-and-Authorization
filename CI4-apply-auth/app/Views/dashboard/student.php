<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Student Dashboard</h1>
        <p class="mt-2 text-gray-600">Manage your course enrollments and view available courses</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Available Courses -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Available Courses</h2>
            
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credits</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($available_courses)): ?>
                            <?php foreach ($available_courses as $course): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= $course['course_name'] ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?= $course['credits'] ?> Credits
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php if (isset($course['is_enrolled']) && $course['is_enrolled']): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Enrolled
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Available
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <?php if (!isset($course['is_enrolled']) || !$course['is_enrolled']): ?>
                                        <button onclick="enrollCourse(<?= $course['course_id'] ?>)" 
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700">
                                            Enroll
                                        </button>
                                    <?php else: ?>
                                        <button onclick="unenrollCourse(<?= $course['course_id'] ?>)" 
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700">
                                            Unenroll
                                        </button>
                                    <?php endif; ?>
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

        <!-- Enrolled Courses -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">My Enrolled Courses</h2>
            
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credits</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Enrolled</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($enrolled_courses)): ?>
                            <?php foreach ($enrolled_courses as $course): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= $course['course_name'] ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?= $course['credits'] ?> Credits
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= date('d/m/Y', strtotime($course['enroll_date'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="unenrollCourse(<?= $course['course_id'] ?>)" 
                                            class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700">
                                        Unenroll
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                    No enrolled courses yet
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if (!empty($enrolled_courses)): ?>
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Total Credits</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>You are currently enrolled in <strong><?= array_sum(array_column($enrolled_courses, 'credits')) ?> credits</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function enrollCourse(courseId) {
    if (confirm('Are you sure you want to enroll in this course?')) {
        window.location.href = '/course/enroll/' + courseId;
    }
}

function unenrollCourse(courseId) {
    if (confirm('Are you sure you want to unenroll from this course?')) {
        window.location.href = '/course/unenroll/' + courseId;
    }
}
</script>
<?= $this->endSection() ?>