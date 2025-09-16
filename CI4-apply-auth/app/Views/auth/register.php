<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <h2 style="text-align: center;">Registrasi - Campus App</h2>
    
    <form method="POST" action="/register" id="registerForm">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="full_name">Nama Lengkap:</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required onchange="toggleEntryYear()">
                <option value="">Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="student">Student</option>
            </select>
        </div>
        
        <div class="form-group" id="entryYearGroup" style="display: none;">
            <label for="entry_year">Tahun Masuk:</label>
            <input type="number" id="entry_year" name="entry_year" min="2020" max="2030">
        </div>
        
        <button type="submit" style="width: 100%;">Daftar</button>
    </form>
    
    <p style="text-align: center; margin-top: 20px;">
        Sudah punya akun? <a href="/login">Login disini</a>
    </p>
</div>

<script>
function toggleEntryYear() {
    const role = document.getElementById('role').value;
    const entryYearGroup = document.getElementById('entryYearGroup');
    const entryYearInput = document.getElementById('entry_year');
    
    if (role === 'student') {
        entryYearGroup.style.display = 'block';
        entryYearInput.required = true;
    } else {
        entryYearGroup.style.display = 'none';
        entryYearInput.required = false;
    }
}
</script>