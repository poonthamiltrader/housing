const basePath = window.location.origin + "/git_housing/housing/";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#user-form");
    if (form) {
        form.addEventListener("submit", handleSubmit);
    } else {
        console.error('Element "#user-form" not found.');
    }

    const stateElement = document.querySelector("#state_id");
    if (stateElement) {
        stateElement.addEventListener("change", handleStateChange);
    } else {
        console.error('Element "#state_id" not found.');
    }

    const cityElement = document.querySelector("#city_id");
    if (cityElement) {
        cityElement.addEventListener("change", handleCityChange);
    } else {
        console.error('Element "#city_id" not found.');
    }
});

const fetchData = async (url, options) => {
    try {
        const response = await fetch(url, options);
        if (!response.ok) {
            const data = await response.json();
            throw new Error(data.message || response.statusText);
        }
        return response;
    } catch (error) {
        console.error(`Fetch error: ${error.message}`);
        throw error;
    }
};

const addEditModal = async (id, module_name, module_function, formmethod) => {
    const url = id
        ? `${basePath}${module_name}/${id}/${module_function}`
        : `${basePath}${module_name}/${module_function}`;

    try {
        const response = await fetchData(url, {
            method: formmethod,
            headers: { "Content-Type": "text/html" },
        });
        const html = await response.text();
        const modalContent = document.querySelector("#modal-content");
        if (modalContent) {
            modalContent.innerHTML = html;
            $("#modal-sm").modal("show");
            attachModalEventListeners();
        } else {
            console.error('Element "#modal-content" not found.');
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "An error occurred.",
        });
    }
};

const updateSelectOptions = (selectElement, options, dropname) => {
    const fragment = document.createDocumentFragment();

    const defaultOption = document.createElement("option");
    defaultOption.textContent = `Select ${dropname}`;
    fragment.appendChild(defaultOption);

    if (options.length > 0) {
        options.forEach((option) => {
            const opt = document.createElement("option");
            opt.value = option.id;
            opt.textContent = option.name;
            fragment.appendChild(opt);
        });
    }

    selectElement.innerHTML = "";
    selectElement.appendChild(fragment);
};

const handleStateChange = async (event) => {
    const stateId = event.target.value;
    const cityElement = document.querySelector("#city_id");
    const areaElement = document.querySelector("#area_id");

    cityElement.innerHTML = '<option value="">Select City</option>';

    if (areaElement) {
        areaElement.innerHTML = '<option value="">Select Area</option>';
    }

    if (stateId === "") return;

    try {
        const response = await fetchData(`${basePath}getStateCityData`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ state_id: stateId }),
        });
        const result = await response.json();
        console.log(result);

        const cityOptions =
            result.status == "success"
                ? result.data
                : [{ id: "", name: "No data found" }];
        updateSelectOptions(cityElement, cityOptions, "City");
    } catch (error) {
        console.error(error);
    }
};

const handleCityChange = async (event) => {
    const cityId = event.target.value;
    const areaElement = document.querySelector("#area_id");

    if (areaElement) {
        areaElement.innerHTML = '<option value="">Select Area</option>';
    }

    if (cityId === "") return;

    try {
        const response = await fetchData(`${basePath}getCityAreaData`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ city_id: cityId }),
        });
        const result = await response.json();
        console.log(result);
        
        const areaOptions =
            result.status == "success"
                ? result.data
                : [{ id: "", name: "No data found" }];
        updateSelectOptions(areaElement, areaOptions, "Area");
    } catch (error) {
        console.error(error);
    }
};

const attachModalEventListeners = () => {
    const form = document.querySelector("#user-form");
    if (form) {
        form.addEventListener("submit", handleSubmit);
    } else {
        console.error('Element "#user-form" not found.');
    }

    const eventListeners = [
        { selector: "#state_id", event: "change", handler: handleStateChange },
        { selector: "#city_id", event: "change", handler: handleCityChange },
    ];

    eventListeners.forEach(({ selector, event, handler }) => {
        const element = document.querySelector(selector);
        if (element) {
            element.addEventListener(event, handler);
        } else {
            console.error(`Element "${selector}" not found.`);
        }
    });
};

const showToast = (message, status) => {
    var Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    Toast.fire({
        icon: status,
        title: message,
    });
};

const handleSubmit = async (event) => {
    event.preventDefault();
    const submitButton = event.target;
    submitButton.disabled = true;

    const form = document.querySelector("#user-form");
    if (!form) {
        console.error('Element "#user-form" not found.');
        submitButton.disabled = false;
        return;
    }

    const url = form.action;
    const formMethod = form.method.toUpperCase();
    const formData = new FormData(form);
    const csrfToken = document.querySelector('input[name="_token"]').value;

    try {
        const response = await fetch(url, {
            method: formMethod,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            body: formData,
            redirect: "manual",
        });

        if (!response.ok) {
            const data = await response.json();
            document.querySelectorAll(".error").forEach((el) => el.remove());
            if (response.status === 422) {
                for (const [key, value] of Object.entries(data.errors)) {
                    const input = document.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.insertAdjacentHTML(
                            "afterend",
                            `<span class="error">${value}</span>`
                        );
                    }
                }
            } else if (response.status === 500) {
                showToast("Error!", "Internal Server Error", "error");
            }
        } else {
            if (response.redirected) {
                console.warn("Request was redirected");
            } else {
                const data = await response.json();
                showToast(data.message, "success");
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        }
    } catch (error) {
        console.error(error);
        showToast("Error!", "An error occurred. Please try again.", "error");
    } finally {
        submitButton.disabled = false;
    }
};

const deleteEntity = async (id, entityType) => {
    Swal.fire({
        title: "Are you sure?",
        text: `You want to delete this ${entityType}.`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Delete!",
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${basePath}${entityType}/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                });

                if (response.ok) {
                    const data = await response.json();
                    showToast(data.message, "success");
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    const errorData = await response.json();
                    showToast(
                        "An error occurred while deleting the ${entityType}.",
                        "error"
                    );
                }
            } catch (error) {
                showToast(
                    "An error occurred while deleting the ${entityType}.",
                    "error"
                );
            }
        }
    });
};


function initializeDataTable(selector, ajaxUrl, columns, order = [[1, "asc"]]) {
    $(function () {
        $(selector).addClass('table-striped');

        new DataTable(selector, {
            order: order,
            ajax: {
                url: ajaxUrl,
                type: "GET",
                dataSrc: function (json) {
                    return json.aaData;
                },
                error: function (xhr, error, thrown) {
                    console.log("Error in AJAX request:", xhr.responseText);
                },
            },
            columns: columns,
            paging: true,
            pageLength: 10,
            ordering: false,
            serverSide: true,
            processing:true,
            stripeClasses: ['odd', 'even'],
        });
    });
}

