@extends('welcome')


@section('home')



    <div class="container">
        <h1 class="title">Top brands in 2025</h1>
        <div class="add-btn-container">
            <button id="addButton" class="add-btn">Add brand</button>
        </div>
        <div id="brand-list" class="brand-list">Loading...</div>

        @include('layouts/partials/_add')
        @include('layouts/partials/_edit')
    </div>

    


    <script>
        
        const brandList = document.getElementById("brand-list");

        async function loadBrands() {
        try {
            const response = await fetch("http://localhost:8000/api/brands", {
            headers: {
                "CF-IPCountry": "FR" 
            }
            });
            const brands = await response.json();
            brandList.innerHTML = "";

            if (brands.length === 0) {
            brandList.innerHTML = "<p>No brands found for your region.</p>";
            return;
            }

            brands.forEach(brand => {
            const card = document.createElement("div");
            card.className = "card";
            card.innerHTML = `
                 <div class="card-top">
                        <div class="card-rank">${brand.brand_id}</div>
                    </div>

                    <div class="card-middle">
                        <div class="brand-name">${brand.brand_name}</div>
                        <div class="rating" id="rating-display-${brand.brand_id}"></div>
                    </div>

                    <div class="card-bonus">
                         <img src="${brand.brand_image}" alt="${brand.brand_name}" class="card-logo" />
                    </div>

                    <div class="card-actions">
                        <button class="edit-btn">Update</button>
                        <button class="delete-btn">Delete</button>
                    </div>
            `;
            brandList.appendChild(card);

            displayRating(brand.rating, brand.brand_id);

            const editBtn = card.querySelector(".edit-btn");
            const deleteBtn = card.querySelector(".delete-btn");


            editBtn.addEventListener("click", () => {
                openModalEdit(brand);
            });

             deleteBtn.addEventListener("click", async function () {
                if (confirm("Are you sure you want to remove this mark ?")) {
                    const response = await fetch(`http://localhost:8000/api/brands/${brand.brand_id}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json"
                        }
                    });

                    if (response.ok) {
                        alert("Brand successfully removed !");
                        loadBrands();
                    } else {
                        alert("Deletion error !");
                        console.error(await response.json());
                    }
                }
            });
        });

        } catch (err) {
            brandList.innerHTML = "<p>Error loading brand.</p>";
            console.error(err);
        }
        }

        loadBrands();

    </script>

@stop