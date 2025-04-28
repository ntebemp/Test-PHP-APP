
<div id="modal-edit" class="modal hidden">
    <div class="modal-content">
        <span id="closeModalEdit" class="close">&times;</span>
        <h2 id="modalTitleEdit">Edit a brand</h2>
        <form id="edit-brand-form" class="form-fields">
            
            <input type="hidden" id="brand_id" name="brand_id">
            
            <label for="brand_name">Brand name :</label>
            <input type="text" id="edit_brand_name" name="brand_name" placeholder="Ex: Cashed Casino" required>

            <label for="brand_image">Brand image :</label>
            <input type="url" id="edit_brand_image" name="brand_image" placeholder="https://example.com/logo.png" required>

            <label for="rating">Rating :</label>
            <input type="number" id="edit_rating" name="rating" min="0" max="5" step="0.1" placeholder="Rating (Between 0 & 5)" required>
            
            <label for="country_code">Country :</label>
            <select name="country_code" id="edit_country_code" required>
                <option value="">-- Select a country --</option>
                <option value="FR">France (FR)</option>
                <option value="EN">English (EN)</option>
                <option value="ES">Spanish (ES)</option>
                <option value="DE">Allemagne (DE)</option>
                <option value="ZH">Chine (ZH)</option>
            </select>
            
            <div class="form-actions">
                <button type="submit" class="validate-btn">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById("edit-brand-form").addEventListener("submit", async function (e) {
    e.preventDefault();

    const brandId = document.getElementById("brand_id").value;
    const name = document.getElementById("edit_brand_name").value;
    const image = document.getElementById("edit_brand_image").value;
    const rating = parseInt(document.getElementById("edit_rating").value);

    const response = await fetch(`http://localhost:8000/api/brands/${brandId}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "CF-IPCountry": document.getElementById("edit_country_code").value
        },
        body: JSON.stringify({
            brand_name: name,
            brand_image: image,
            rating: rating,
        })
    });

    if (response.ok) {
        alert("Brand successfully updated !");
        document.getElementById("edit-brand-form").reset();
        loadBrands(); 
        closeModalEdit(); 
    } else {
        alert("Update error !");
        console.error(await response.json());
    }
});


function openModalEdit(brand) {
    document.getElementById("modal-edit").classList.remove("hidden");
    document.getElementById("brand_id").value = brand.brand_id;
    document.getElementById("edit_brand_name").value = brand.brand_name;
    document.getElementById("edit_brand_image").value = brand.brand_image;
    document.getElementById("edit_rating").value = brand.rating;

  
    const countrySelect = document.getElementById("edit_country_code");
    countrySelect.value = brand.country_code || ''; 
    
   
    if (!Array.from(countrySelect.options).some(option => option.value === brand.country_code)) {
        countrySelect.value = 'FR'; 
    }
    
}

document.getElementById("closeModalEdit").addEventListener("click", closeModalEdit);


function closeModalEdit() {
    document.getElementById("modal-edit").classList.add("hidden");
}


</script>
