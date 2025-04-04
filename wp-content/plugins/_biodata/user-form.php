<div class="container mt-4">
    <form method="POST" enctype="multipart/form-data" id="custom-form" class="p-4 border rounded shadow bg-light">
        <h2 class="mb-4 text-center">Personal Information</h2>

        <div class="mb-3">
            <label class="form-label">Profile Image:</label>
            <input type="file" name="image" class="form-control" id="image-upload">
        </div>

        <div class="image-preview mb-3">
            <img id="image-preview" src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" style="display: block; height: 200px; object-fit: contain; width: 200px;">
        </div>

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Gender:</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" name="gender" value="Male" checked class="form-check-input"> Male
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="gender" value="Female" class="form-check-input"> Female
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Date of Birth:</label>
            <input type="date" name="dob" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Time of Birth:</label>
            <input type="time" name="time_of_birth" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Place of Birth:</label>
            <input type="text" name="place_of_birth" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">height:</label>
            <input type="text" name="height" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">job occupation:</label>
            <input type="text" name="job_occupation" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Rashi:</label>
            <select name="rashi" id="rashi" class="form-control">
                <option value="">Select Rashi</option>
                <option value="Aries (Mesha)">Aries (Mesha)</option>
                <option value="Taurus (Vrishabha)">Taurus (Vrishabha)</option>
                <option value="Gemini (Mithuna)">Gemini (Mithuna)</option>
                <option value="Cancer (Kark)">Cancer (Kark)</option>
                <option value="Leo (Simha)">Leo (Simha)</option>
                <option value="Virgo (Kanya)">Virgo (Kanya)</option>
                <option value="Libra (Tula)">Libra (Tula)</option>
                <option value="Scorpio (Vrishchik)">Scorpio (Vrishchik)</option>
                <option value="Sagittarius (Dhanu)">Sagittarius (Dhanu)</option>
                <option value="Capricorn (Makara)">Capricorn (Makara)</option>
                <option value="Aquarius (Kumbha)">Aquarius (Kumbha)</option>
                <option value="Pisces (Meena)">Pisces (Meena)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact Number:</label>
            <input type="text" name="contact_number" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Address:</label>
            <textarea name="address" class="form-control" rows="3"></textarea>
        </div>

        <h2 class="p-4 text-center mb-0">Family Information</h2>

        <div class="mb-3">
            <label class="form-label">Father name:</label>
            <input type="text" name="father_name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Father Occupation:</label>
            <input type="text" name="father_occupation" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Mother name:</label>
            <input type="text" name="mother_name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Mother Occupation:</label>
            <input type="text" name="mother_occupation" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Total Brothers:</label>
            <input type="text" name="total_brothers" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Total Sisters:</label>
            <input type="text" name="total_sisters" class="form-control">
        </div>

        <button type="submit" name="custom_form_submit" class="btn btn-primary w-100">Submit</button>
    </form>

</div>

<script>
    jQuery('#image-upload').change(function(event) {
        var input = event.target;
        var file = input.files[0];
        var allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/webp"];

        if (file) {
            if (!allowedTypes.includes(file.type)) {
                jQuery('#image-error').removeClass('d-none'); // Show error message
                jQuery('#image-upload').val(''); // Clear file input
                jQuery('#image-preview').attr('src', 'http://localhost/houzez/resume/wp-content/uploads/sites/2/2025/04/placeholder-1.png'); // Reset preview
            } else {
                jQuery('#image-error').addClass('d-none'); // Hide error message
                var reader = new FileReader();
                reader.onload = function(e) {
                    jQuery('#image-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });
</script>