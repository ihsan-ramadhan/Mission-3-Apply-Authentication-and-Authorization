<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="min-h-96 flex items-center justify-center">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-16 text-center text-3xl font-extrabold text-gray-900">
                Campus App
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Masuk ke akun Anda untuk mengakses dashboard
            </p>
        </div>
        
        <div class="bg-white py-8 px-6 shadow-lg rounded-lg">
            <form method="POST" action="/login" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">
                        Username
                    </label>
                    <div class="mt-1">
                        <input type="text" id="username" name="username" required 
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input type="password" id="password" name="password" required 
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                </div>
                
                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>