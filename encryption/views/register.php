<?php include __DIR__ . '/templates/header.php'; ?>

<h2>Registration Form</h2>

<?php if (!empty($errors)): ?>
    <div style="color:red;">
        <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p style="color:green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="POST" action="index.php?page=register_submit">

    <label>ID Number*:</label><br>
    <input type="text" name="id_number" placeholder="xxxx-xxxx" required><br><br>

    <label>First Name*:</label><br>
    <input type="text" name="first_name" required><br><br>

    <label>Middle Name <span style="color:red;">optional</span>:</label><br>
    <input type="text" name="middle_name"><br><br>

    <label>Last Name*:</label><br>
    <input type="text" name="last_name" required><br><br>

    <label>Extension <span style="color:red;">optional</span>:</label><br>
    <input type="text" name="extension"><br><br>

    <label>Birthdate*:</label><br>
    <input type="date" name="birthdate" required><br><br>

    <label>Username*:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password*:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Confirm Password*:</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <h3>Address Information</h3>

    <label>Purok/Street*:</label><br>
    <input type="text" name="purok_street" required><br><br>

    <label>Barangay*:</label><br>
    <input type="text" name="barangay" required><br><br>

    <label>Municipal/City*:</label><br>
    <input type="text" name="city_municipality" required><br><br>

    <label>Province*:</label><br>
    <input type="text" name="province" required><br><br>

    <label>Country*:</label><br>
    <input type="text" name="country" required><br><br>

    <label>Zip Code*:</label><br>
    <input type="text" name="zip_code" required pattern="[0-9]{4,6}"><br><br>

    <h3>Authentication Questions</h3>

    <?php for ($i = 1; $i <= 3; $i++): ?>
        <label>Question <?= $i ?>*:</label><br>
        <select name="question_<?= $i ?>" required>
            <?php foreach ($questions as $q): ?>
                <option value="<?= $q['question_id'] ?>"><?= htmlspecialchars($q['question_text']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Answer <?= $i ?>*:</label><br>
        <input type="text" name="answer_<?= $i ?>" required><br><br>
    <?php endfor; ?>

    <button type="submit">Register</button>
</form>

<?php include __DIR__ . '/templates/footer.php'; ?>
