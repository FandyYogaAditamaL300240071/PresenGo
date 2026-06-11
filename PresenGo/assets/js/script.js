// KONFIRMASI HAPUS

function konfirmasiHapus(link)
{
    const modalElement =
        document.getElementById("deleteConfirmModal");

    const confirmButton =
        document.getElementById("deleteConfirmButton");

    if (
        !link ||
        !link.href ||
        !modalElement ||
        !confirmButton ||
        typeof bootstrap === "undefined"
    )
    {
        return confirm(
            "Yakin ingin menghapus data ini?"
        );
    }

    confirmButton.href =
        link.href;

    bootstrap
        .Modal
        .getOrCreateInstance(modalElement)
        .show();

    return false;
}

// PREVIEW PASSWORD

function togglePassword(id)
{
    const input =
        document.getElementById(id);

    if (input.type === "password")
    {
        input.type = "text";
    }
    else
    {
        input.type = "password";
    }
}

// AUTO HILANG ALERT

setTimeout(() =>
{
    const alert =
        document.querySelector(".alert");

    if (alert)
    {
        alert.style.transition =
            "0.5s";

        alert.style.opacity = "0";

        setTimeout(() =>
        {
            alert.remove();
        }, 500);
    }

}, 3000);

// SEARCH TABLE

function cariData(inputId, tableId)
{
    const input =
        document
        .getElementById(inputId)
        .value
        .toLowerCase();

    const table =
        document.getElementById(tableId);

    const rows =
        table.getElementsByTagName("tr");

    for(let i = 1; i < rows.length; i++)
    {
        const text =
            rows[i].textContent
            .toLowerCase();

        rows[i].style.display =
            text.includes(input)
            ? ""
            : "none";
    }
}

// LOADING BUTTON

function loadingButton(button)
{
    if (!button)
    {
        return;
    }

    if (
        button.form &&
        !button.form.checkValidity()
    )
    {
        return;
    }

    if (button.dataset.loading === "true")
    {
        return;
    }

    button.dataset.loading = "true";

    setTimeout(() =>
    {
        if (button.tagName === "INPUT")
        {
            button.value =
                "Memproses...";
        }
        else
        {
            button.innerHTML =
                "Memproses...";
        }

        button.classList.add("disabled");
        button.setAttribute(
            "aria-disabled",
            "true"
        );
    }, 0);
}

document.addEventListener(
    "submit",
    (event) =>
    {
        const form =
            event.target;

        if (!form || !form.querySelector)
        {
            return;
        }

        loadingButton(
            form.querySelector(
                "button[type='submit'], input[type='submit']"
            )
        );
    }
);
