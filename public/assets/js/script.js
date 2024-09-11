const basePath = window.location.origin + "/housing/";

document
    .querySelector("#state_id")
    .addEventListener("change", async (event) => {
        const stateId = event.target.value;

        const cityElement = document.querySelector("#city_id");
        const areaElement = document.querySelector("#area_id");
        cityElement.innerHTML = '<option value="">Select City</option>';
        areaElement.innerHTML = '<option value="">Select Area</option>';

        if (stateId !== "") {
            try {
                const response = await fetch(`${basePath}/City/StateCity`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ state_id: stateId }),
                });
                const result = await response.json();

                if (result.status === 200) {
                    result.data.city.forEach((city) => {
                        cityElement.insertAdjacentHTML(
                            "beforeend",
                            `<option value="${city.id}">${city.name}</option>`
                        );
                    });
                } else if (result.status === 404) {
                    cityElement.insertAdjacentHTML(
                        "beforeend",
                        '<option value="">No data found</option>'
                    );
                }
            } catch (error) {
                console.error(error);
            }
        }
    });

document.querySelector("#city_id").addEventListener("change", async (event) => {
    const cityId = event.target.value;
    const areaElement = document.querySelector("#area_id");
    areaElement.innerHTML = '<option value="">Select Area</option>';

    if (cityId !== "") {
        try {
            const response = await fetch(`${basePath}/Area/CityArea`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ city_id: cityId }),
            });
            const result = await response.json();

            if (result.status === 200) {
                result.data.area.forEach((area) => {
                    areaElement.insertAdjacentHTML(
                        "beforeend",
                        `<option value="${area.id}">${area.name}</option>`
                    );
                });
            } else if (result.status === 404) {
                areaElement.insertAdjacentHTML(
                    "beforeend",
                    '<option value="">No data found</option>'
                );
            }
        } catch (error) {
            console.error(error);
        }
    }
});

document
    .querySelector("#submit-button")
    .addEventListener("click", async (event) => {
        event.preventDefault();
        const submitButton = event.target;
        submitButton.disabled = true;

        const url = document.querySelector("#user-form").action;
        const formData = new URLSearchParams(
            new FormData(document.querySelector("form"))
        ).toString();

        try {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: formData,
            });

            if (response.ok) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Form submitted successfully",
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location.reload();
                    }
                });
            } else {
                const data = await response.json();
                document
                    .querySelectorAll(".error")
                    .forEach((el) => el.remove());

                if (response.status === 422) {
                    for (const [key, value] of Object.entries(data.errors)) {
                        const input = document.querySelector(`[name="${key}"]`);
                        input.insertAdjacentHTML(
                            "afterend",
                            `<span class="error">${value}</span>`
                        );
                    }
                } else if (response.status === 500) {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Internal Server Error",
                    });
                }
            }
        } catch (error) {
            console.error(error);
        } finally {
            submitButton.disabled = false;
        }
    });
