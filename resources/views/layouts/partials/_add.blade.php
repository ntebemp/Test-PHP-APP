
<div id="modal" class="modal hidden">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <h2 id="modalTitle">Add a new brand</h2>
        <form id="add-brand-form" class="form-fields">

            <label for="brand_name">Brand name :</label>
            <input type="text" id="add_brand_name" name="brand_name" placeholder="Ex: Cashed Casino" required>

            <label for="brand_image">Logo :</label>
            <input type="url" id="add_brand_image" name="brand_image" placeholder="https://example.com/logo.png" required>

            <label for="rating">Rating :</label>
            <input type="number" id="add_rating" name="rating" min="0" max="5" step="0.1" placeholder="rating (Beetween 0 & 5)" 
                required>

            <label for="country_code">Country :</label>
            <select name="country_code" id="add_country_code" required>
                <option value="">-- Select a country--</option>
                <option value="FR">France (FR)</option>
                <option value="EN">English (EN)</option>
                <option value="ES">Spanish (ES)</option>
                <option value="DE">GERMANY (DE)</option>
                <option value="ZH">CHINA (ZH)</option>
            </select>
            
                <div class="form-actions">
                <button type="submit" class="validate-btn">Save</button>
            </div>
        </form>
    </div>
</div>


<script>
document.getElementById("add-brand-form").addEventListener("submit", async function (e) {
  e.preventDefault();

  const name = document.getElementById("add_brand_name").value;
  const image = document.getElementById("add_brand_image").value;
  const rating = parseInt(document.getElementById("add_rating").value);

  const response = await fetch("http://localhost:8000/api/brands", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "CF-IPCountry": document.getElementById("add_country_code").value
    },
    body: JSON.stringify({
      brand_name: name,
      brand_image: image,
      rating: rating,
    })
  });

  if (response.ok) {
    alert("Brand successfully added!");
    document.getElementById("add-brand-form").reset();
    loadBrands(); 
  } else {
    alert("Error while adding !");
    console.error(await response.json());
  }
});


</script>

